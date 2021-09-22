<?php
namespace Infixs;

use Infixs\WP;
use Infixs\Support\Str;
use Infixs\Config\App;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

class Controller
{ 
    private $name;
    
    private $vars;

    public function view( $name, $vars = [] )
    {
        if( !is_admin() ){
            $GLOBALS += $vars;
            $this->name = $name;
            WP::add_filter( 'template_include', $this, 'get_template' );
        }else{
            global $pagenow;

            if( is_admin() && $pagenow == 'admin.php' && isset( $_GET['page'] ) ){
                
                $this->vars = $vars;
                $this->name = $name;
                $method = Str::lower( $_SERVER['REQUEST_METHOD'] );
                WP::add_action( 'infixs_routing_menu_page_' . $method . '_' . $_GET['page'], $this, 'load_template' );
            }
        }
    }

    public function viewVue( $vue_name, $name, $vars )
    {
        $default_vue_url =  App::BASE_URL . 'assets/vue/';
        $manifest = $this->getManifest( App::BASE_PATH . 'assets/vue/' . 'manifest.json' );

        $vue_script_name = 'src/' . $vue_name . '.js';
        if( ! isset( $manifest[ $vue_script_name  ] ) )
            return;

        WP::load_script()


        add_action( 'admin_head', function() use ($manifest, $default_vue_url, $vue_script_name){
            printf('<script type="module" crossorigin src="%s"></script>', $default_vue_url . $manifest[ $vue_script_name ]['file'] );

            if( isset( $manifest[$vue_script_name]['imports'] ) ){
                foreach( $manifest[$vue_script_name]['imports'] as $imports )
                {
                    printf('<link rel="modulepreload" href="%s">', $default_vue_url . $manifest[$imports]['file'] );
                }
            }

            if( isset( $manifest[$vue_script_name]['css'] ) ){
                foreach( $manifest[$vue_script_name]['css'] as $imports )
                {
                    printf('<link rel="stylesheet" href="%s">', $default_vue_url . $imports );
                }
            }
        }, 1 );

        $this->view( $name, $vars );
    }

    public function getManifest( $file )
    {
        $content = file_get_contents( $file );
        return json_decode($content, true);
    }

    public function redirect( $url, $query = [] )
    {
        wp_redirect( esc_url( add_query_arg( $query, home_url( $url ) ) ) );
    }

    public function load_template(){
        extract($this->vars);
        include \INFIXS_RSP_TEMPLATE_PATH . preg_replace( '/\./', '/', $this->name ) . '.php';
    }

    public function get_template()
    {    
        return \INFIXS_RSP_TEMPLATE_PATH . preg_replace( '/\./', '/', $this->name ) . '.php';
    }
}