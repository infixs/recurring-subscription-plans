<?php
namespace InfixsRSP\Routing;

use InfixsRSP\Routing\Route;
use InfixsRSP\Routing\RestRoute;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

class Routes
{
    public static function find( $name )
    {
        if( $instance = Route::getInstanceByName( $name ) ){
            return (object) [
                'name' => $instance->get_name(),
                'url' => $instance->get_url()
            ];
        }

        return false;
    }

    public static function api( $api_route_name, $args = [] )
    {
        if( $instance = RestRoute::getInstanceByName( $api_route_name ) ){
            return $instance->get_rest_url();
        }

        return false;
    }
}