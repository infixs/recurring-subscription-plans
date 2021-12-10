<?php
namespace InfixsRSP\Support;

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

    public static function onlyNumber( String $string ){
        return preg_replace( '/[^0-9]/', '', $string );
    }

    public static function format( String $type, String $value )
    { 
        switch( $type )
        {
            case 'document_number':
                if( preg_match('/(\d{3}).?(\d{3}).?(\d{3})-?(\d{2})/', $value, $matches) )
				    $value = $matches[1] . '.' . $matches[2] . '.' . $matches[3] . '-' . $matches[4] ;
            break;
            case 'name':
                $value = trim($value);
                $value = strtolower($value);
                $value = ucfirst($value);
            break;
        }

        return $value;
    }

    /**
     * Returns the portion of string specified by the start and length parameters.
     *
     * @param  string  $string
     * @param  int  $start
     * @param  int|null  $length
     * @return string
     */
    public static function substr($string, $start, $length = null)
    {
        return mb_substr($string, $start, $length, 'UTF-8');
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