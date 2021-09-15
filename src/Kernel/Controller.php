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
        $GLOBALS += $vars;
        $this->name = $name;
        WP::add_filter( 'template_include', $this, 'get_template' );
    }

    public function get_template()
    {    
        return \INFIXS_RSP_TEMPLATE_PATH . preg_replace( '/\./', '/', $this->name ) . '.php';
    }
}