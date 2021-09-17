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

    public static function lower( String $string )
    {
        return strtolower( $string );
    }

    public static function toMoney( String $string )
    {
        return 'R$ ' . number_format( $string, 2, ',', '.' );
    }

    /**
     * Determine if a given string contains a given substring.
     *
     * @param  string  $haystack
     * @param  string|string[]  $needles
     * @return bool
     */
    public static function contains($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ($needle !== '' && mb_strpos($haystack, $needle) !== false) {
                return true;
            }
        }

        return false;
    }
}