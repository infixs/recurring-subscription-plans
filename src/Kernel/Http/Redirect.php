<?php
namespace InfixsRSP\Http;

use InfixsRSP\Routing\Routes;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

class Redirect
{
    public static function route( $name, int $status = 302 )
    {
        if( $route = Routes::find( $name ) ){
            wp_redirect( '/' . $route->url, $status );
            exit;
        }

        return false;
    }

    public static function to( $url, int $status = 302 )
    {
        wp_redirect( $url, $status );
        exit;
    }
}