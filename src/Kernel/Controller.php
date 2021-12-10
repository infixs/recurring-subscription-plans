<?php
namespace InfixsRSP;

use InfixsRSP\WP;
use InfixsRSP\Support\Str;
use InfixsRSP\Config\App;

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
        $default_vue_base_url =  App::BASE_URL . 'assets/vue/';
        $default_vue_url =  $default_vue_base_url . 'dist/';
        $manifest = $this->getManifest( App::BASE_PATH . 'assets/vue/dist/' . 'manifest.json' );

        $vue_script_name = 'src/' . $vue_name . '.js';
        if( ! isset( $manifest[ $vue_script_name  ] ) )
            return;

        $handle = App::SHORT_NAME . '-' . $vue_name;
        $main_script_file = $default_vue_url . $manifest[ $vue_script_name ]['file'];

        WP::load_admin_script( $handle . '-module', $main_script_file, ['wp-i18n'], App::VERSION, true, 'module' );
        WP::load_admin_script( $handle, $default_vue_base_url . 'i18n/' . $vue_name . '.js', ['wp-i18n'], App::VERSION, true );
        WP::set_script_translations( $handle, App::TEXT_DOMAIN, App::LANGUAGES_PATH );
        
        if( isset( $manifest[$vue_script_name]['imports'] ) ){
            $i = 1;
            foreach( $manifest[$vue_script_name]['imports'] as $imports )
            {
                $file = $default_vue_url . $manifest[$imports]['file'];
                WP::load_admin_script( $handle . '-import-' . $i, $file, ['wp-i18n'], App::VERSION, true, 'modulepreload' );
                $i++;
            }
        }

        

        add_action( 'admin_head', function() use ($manifest, $default_vue_url, $vue_script_name){
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

    public function redirect( $url, $query = [], $str = false )
    {
        if( $str )
            return add_query_arg( $query, home_url( $url ) );
        else
            wp_redirect(  add_query_arg( $query, home_url( $url ) ) );
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