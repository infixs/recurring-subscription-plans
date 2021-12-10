<?php
namespace InfixsRSP\Http;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

class Response
{
    /**
     * Respose array to json
     *
     * @param array $response
     * @return string
     */
    public static function json( $response )
    {
        return wp_send_json( $response );
    }
}