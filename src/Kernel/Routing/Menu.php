<?php
namespace InfixsRSP\Routing;

use InfixsRSP\Http\Request;
use InfixsRSP\Support\Str;
use InfixsRSP\WP;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

class Menu
{
    protected static $instance = [];

    protected $page_title;

    protected $menu_title;

    protected $capability;

    protected $slug;

    protected $function;

    protected $icon;

    protected $position;

    protected $parent_menu;

    /**
     * Get method function
     *
     * @since 1.0.0
     * @param array $function
     * @return \Infixs\Routing\MenuPage
     */
    public function get( $function )
    {
        global $pagenow;

        $method = Str::lower( $_SERVER['REQUEST_METHOD'] );
        
        if( is_admin() && $pagenow == 'admin.php' && isset( $_GET['page'] ) && $_GET['page'] == $this->slug && $method == 'get' ){
            $this->function['get'] = $function;
            $action_instance = new $this->function['get'][0];
            call_user_func( [$action_instance, $this->function['get'][1]], new Request );
        }
        
        return $this;
    }

    /**
     * Post method function
     *
     * @since 1.0.0
     * @param array $function
     * @return \Infixs\Routing\MenuPage
     */
    public function post( $function )
    {
        global $pagenow;

        $method = Str::lower( $_SERVER['REQUEST_METHOD'] );
        
        if( is_admin() && $pagenow == 'admin.php' && isset( $_GET['page'] ) && $_GET['page'] == $this->slug && $method == 'post' ){
            $this->function['post'] = $function;
            $action_instance = new $this->function['post'][0];
            call_user_func( [$action_instance, $this->function['post'][1]], new Request );
        }
        
        return $this;
    }

    /**
     * Parse request function
     *
     * @since 1.0.0
     * @return void
     */
    public function parse_request()
    {
        $method = Str::lower( $_SERVER['REQUEST_METHOD'] );
        if( isset( $this->function[$method] ) ){
            do_action( 'infixs_routing_menu_page_' . $method . '_' . $_GET['page'] );
        }else{
            echo "Page Not Found";
        }
    }

    /**
     * Get instance function
     *
     * @since 1.0.0
     * @param string $slug
     * @return \Infixs\Routing\MenuPage
     */
    public static function getInstance( $slug )
    {
        if( !isset( self::$instance[$slug] ) ){
            $class = get_called_class();
            self::$instance[$slug] = new $class;
        }

        return self::$instance[$slug];
    }
}