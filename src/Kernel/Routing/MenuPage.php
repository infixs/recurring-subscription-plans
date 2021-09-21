<?php
namespace Infixs\Routing;

use Infixs\Http\Request;
use Infixs\Support\Str;
use Infixs\WP;

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

    /**
     * Get method function
     *
     * @since 1.0.0
     * @param array $function
     * @return \Infixs\Routing\MenuPage
     */
    public function get( $function )
    {
        $this->function['get'] = $function;
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
        $this->function['post'] = $function;
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
            $action_instance = new $this->function[$method][0];
            call_user_func( [$action_instance, $this->function[$method][1]], new Request );
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