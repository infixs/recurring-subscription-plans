<?php
namespace Infixs;

use Infixs\WP;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

class Controller
{ 
    private $name;

    public function view( $name, $vars = [] )
    {
        if( !is_admin() ){
            $GLOBALS += $vars;
            $this->name = $name;
            WP::add_filter( 'template_include', $this, 'get_template' );
        }else{
            extract( $vars );
            $this->name = $name;
            include \INFIXS_RSP_TEMPLATE_PATH . preg_replace( '/\./', '/', $name ) . '.php';
        }
    }

    public function redirect( $url, $query = [] )
    {
        wp_redirect( esc_url( add_query_arg( $query, home_url( $url ) ) ) );
    }

    public function get_template()
    {    
        return \INFIXS_RSP_TEMPLATE_PATH . preg_replace( '/\./', '/', $this->name ) . '.php';
    }
}