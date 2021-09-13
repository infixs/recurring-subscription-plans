<?php
namespace Infixs\Support;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

class Str
{
    /**
     * toSlug function
     *
     * @param String $string
     * @return String
     */
    public static function toSlug( String $string )
    {
        return preg_replace( ['/^\//', '/[^a-zA-Z]/i'], ['', '.'], $string);
    }

    public static function urlToName( String $string )
    {
        return preg_replace( ['/\/$/', '/^\//', '/[^a-zA-Z]/i'], ['', '', '_'], $string);
    }
}