<?php
namespace InfixsRSP\Routing;

use InfixsRSP\Http\Request;
use InfixsRSP\Support\Str;
use InfixsRSP\WP;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

class MenuPage
{
    private static $instance = [];

    private $page_title;

    private $menu_title;

    private $capability;

    private $slug;

    private $function;

    private $icon;

    private $position;

    /**
     * Add menu page
     *
     * @since 1.0.0
     * @param string $menu_title
     * @param string $capability
     * @param string $slug
     * @param string $icon
     * @param string $position
     * @return \Infixs\Routing\MenuPage
     */
    public static function add( $menu_title, $capability, $slug, $icon = '', $position = null )
    {
        $instance = static::getInstance( $slug );

        $instance->page_title = $menu_title;
        $instance->menu_title = $menu_title;
        $instance->capability = $capability;
        $instance->slug = $slug;
        $instance->icon = $icon;
        $instance->position = $position;

        WP::add_action('admin_menu', $instance, 'register_menu_page' );

        return $instance;
    }

    public function getSlug()
    {
        return $this->slug;
    }

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
     * Register menu page
     *
     * @since 1.0.0
     * @return void
     */
    public function register_menu_page()
    {
        add_menu_page( 
            $this->page_title, 
            $this->menu_title, 
            $this->capability,
            $this->slug, 
            [$this, 'parse_request'],
            $this->icon,
            $this->position
        );
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
            self::$instance[$slug] = new self;
        }

        return self::$instance[$slug];
    }
}