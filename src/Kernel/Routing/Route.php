<?php
namespace InfixsRSP\Routing;

use InfixsRSP\Http\Request;
use InfixsRSP\Support\Str;
use InfixsRSP\WP;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

class Route
{
    private static $instance = [];

    private $name;

    private $var_name;

    private $url;

    private $action;

    private $action_instance;

    private $method;

    public static function get( String $url, $action = null )
    {
        $slug = Str::toSlug($url) . ':get';
        $instance = static::getInstance( $slug );

        $instance->var_name = Str::urlToName( $url );
        $instance->url = preg_replace( '/^\//', '', $url );

        $instance->action = $action;
        $instance->method = 'get';

        WP::add_filter('query_vars', $instance, 'query_vars' );

        return $instance;
    }

    public static function post( String $url, $action = null )
    {
        $slug = Str::toSlug($url);
        $instance = static::getInstance( $slug );

        $instance->var_name = Str::urlToName( $url );
        $instance->url = preg_replace( '/^\//', '', $url );

        $instance->action = $action;
        $instance->method = 'post';

        WP::add_filter('query_vars', $instance, 'query_vars' );

        return $instance;
    }

    public function name( $name )
    {
        $this->name = $name;
    }

    public function get_name()
    {
        return $this->name;
    }

    public function get_url()
    {
        return $this->url;
    }

    public function query_vars( $vars )
    {
        if( !in_array( $this->var_name, $vars ) )
            $vars[] = $this->var_name;

        return $vars;
    }

    public function register_routes()
    {
        $rule = '^' . $this->url . '/?$';
        $rules = get_option( 'rewrite_rules' );
        
        add_rewrite_rule(
            $rule,
            'index.php?' . $this->var_name . '=1',
            'top' 
        );
        //Fazer uma vez apaneas
        flush_rewrite_rules();   
    }

    public function parse_request( $wp )
    {
        if(isset($wp->query_vars[$this->var_name]) && $this->method == Str::lower( $_SERVER['REQUEST_METHOD'] ) ){
            if( is_array( $this->action ) ){
                //Create controller instance
                $action_instance = new $this->action[0];
                $this->action_instance = $action_instance;
                call_user_func( [$action_instance, $this->action[1]], new Request );
            }
            else
            {
                call_user_func($this->action);
            }
        }
    }

    public static function getInstance( $slug )
    {
        if( !isset( self::$instance[$slug] ) ){
            self::$instance[$slug] = new self;
        }

        WP::add_action( 'init', self::$instance[$slug], 'register_routes' );
        WP::add_action( 'parse_request',  self::$instance[$slug], 'parse_request');
        //WP::add_filter( 'template_include', self::$instance[$slug], 'get_template' );

        return self::$instance[$slug];
    }

    /**
     * Get Instance By Route Name
     *
     * @param string $name
     * @return Route
     */
    public static function getInstanceByName( $name )
    {
        foreach( self::$instance as $instance ){
            if( $instance->name == $name )
                return $instance;
        }
        return false;
    }
}