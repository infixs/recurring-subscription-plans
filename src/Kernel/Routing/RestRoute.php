<?php
namespace InfixsRSP\Routing;

use InfixsRSP\Config\App;
use InfixsRSP\Http\Request;
use InfixsRSP\Support\Str;
use InfixsRSP\WP;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

class RestRoute
{
    private static $instance = [];

    private $name;

    private $var_name;

    private $url;

    private $args;

    private $args_rules;

    private $action;

    private $action_instance;

    private $method;

    public static function get( String $url, $action = null )
    {
        $slug = Str::toSlug($url) . ':get';
        $instance = static::getInstance( $slug );

        $instance->var_name = Str::urlToName( $url );
        
        preg_match_all('/\{(.+?)\}/', $url, $args);

        $instance->args = $args[1];

        foreach( $args[1] as $id ){
            $instance->args_rules[$id] = "(?P<{$id}>.+)";
        }

        $instance->url = preg_replace( '/^\//', '', $url );

        $instance->action = $action;
        $instance->method = 'get';

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

    /**
     * Add rule for args
     *
     * @param array $rules
     * @return RestRoute
     */
    public function where( array $rules )
    {
        foreach($rules as $key => $value){
            if( isset($this->args_rules[$key]) )
                $this->args_rules[$key] = "(?P<{$key}>{$value})";
        }
        
        return $this;
    }

    public static function post( String $url, $action = null )
    {
        $slug = Str::toSlug($url);
        $instance = static::getInstance( $slug );

        $instance->var_name = Str::urlToName( $url );

        $instance->url = preg_replace( '/^\//', '', $url );

        $instance->action = $action;
        $instance->method = 'post';

        return $instance;
    }

    public function get_rest_url()
    {
        return site_url() . '/wp-json/' . App::SHORT_NAME . '/v1/' . $this->url;
    }

    public function get_rest_rules_url()
    {
        $args = array_map(function($arg){
            return "/\{{$arg}\}/";
        }, $this->args);

        $url = preg_replace($args, $this->args_rules, $this->url);

        return $url;
    }


    public function register_routes()
    {
        $action_instance = new $this->action[0];
        $this->action_instance = $action_instance;

        $args = array_map(function($arg){
            return "/\{{$arg}\}/";
        }, $this->args);

        $url = preg_replace($args, $this->args_rules, $this->url);

        register_rest_route( App::SHORT_NAME . '/v1', '/' . $url, array(
            'methods' => strtoupper( $this->method ),
            'callback' => [$action_instance, $this->action[1]],
            'permission_callback' => function($request){	  
                return true;//is_user_logged_in();
            }
        ));

    }

    public static function getInstance( $slug )
    {
        if( !isset( self::$instance[$slug] ) ){
            self::$instance[$slug] = new self;
        }

        WP::add_action( 'rest_api_init', self::$instance[$slug], 'register_routes' );

        return self::$instance[$slug];
    }

    /**
     * Get Instance By Route Name
     *
     * @param string $name
     * @return RestRoute
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