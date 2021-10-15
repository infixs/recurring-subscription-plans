<?php
namespace Infixs\Routing;

use Infixs\Config\App;
use Infixs\Http\Request;
use Infixs\Support\Str;
use Infixs\WP;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

class RestRoute
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

        return $instance;
    }


    public function register_routes()
    {
        $action_instance = new $this->action[0];
        $this->action_instance = $action_instance;

        register_rest_route( App::SHORT_NAME . '/v1', '/' . $this->url, array(
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
}