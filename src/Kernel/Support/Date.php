<?php
namespace InfixsRSP\Support;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

class Date
{
    /**
     * toAge function
     *
     * @param String $birthDate Y-m-d
     * @return String
     */
    public static function toAge( $birthDate )
    {
        if( !$birthDate )
            return false;

        $birthDate = explode("-", $birthDate);
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md")
            ? ((date("Y") - $birthDate[0]) - 1)
            : (date("Y") - $birthDate[0]));
        return $age;
    }

    /**
     * Convert date
     *
     * @param String $old_format
     * @param String $new_format
     * @param String $date
     * @return String
     */
    public static function toFormat( String $old_format, String $new_format, $date )
    {
        if(!$date)
            return false;
            
        $dateTime = \DateTime::createFromFormat($old_format, $date);
        if( !$dateTime ){
            return false;
        }
        $newDateString = $dateTime->format($new_format);

        return $newDateString;
    }
}