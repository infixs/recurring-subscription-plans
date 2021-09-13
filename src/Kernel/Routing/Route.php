<?php
namespace Infixs\Routing;

use Infixs\Support\Str;
use Infixs\WP;

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

    public static function get( String $url, $action = null )
    {
        $slug = Str::toSlug($url);
        $instance = static::getInstance( $slug );

        $instance->var_name = Str::urlToName( $url );
        $instance->url = preg_replace( '/^\//', '', $url );

        $instance->action = $action;

        WP::add_filter('query_vars', $instance, 'query_vars' );

        return $instance;
    }

    public function query_vars( $vars )
    {
        $vars[] = $this->var_name;
        return $vars;
    }

    public function register_routes()
    {
        $rule = '^' . $this->url . '/?$';
        $rules = get_option( 'rewrite_rules' );

        if ( ! isset( $rules[$rule] ) ) { 
            add_rewrite_rule(
                $rule,
                'index.php?' . $this->var_name . '=1',
                'top' 
            );
            flush_rewrite_rules();   
        }
    }

    public function parse_request( $wp )
    {
        if(isset($wp->query_vars[$this->var_name])){
            if( is_array( $this->action ) ){
                $action_instance = new $this->action[0];
                $this->action_instance = $action_instance;
                call_user_func( [$action_instance, $this->action[1]] );
            }
            else
            {
                call_user_func($this->action);
            }
        }
    }

    public function get_template( $template )
    {
        if( is_array( $this->action ) ){
            $action_instance = new $this->action[0];
            $this->action_instance = $action_instance;
            call_user_func( [$action_instance, $this->action[1]] );
        }
        else
        {
            call_user_func($this->action);
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
}