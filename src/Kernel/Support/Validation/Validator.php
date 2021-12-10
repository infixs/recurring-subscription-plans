<?php
namespace InfixsRSP\Support\Validation;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

class Validator
{
    public static function make( $data, $rules, $messages = null, $attribute_names = [] )
    {
        $validator = new ValidatorData();
        $validator->setAttributeNames( $attribute_names );
        
        foreach( $rules as $key => $values ){
            $rules_array = explode( '|', $values );
            foreach( $rules_array as $rule ){
                switch( $rule ){
                    case 'required':
                        if( ! isset( $data[$key] ) || empty( $data[$key] ) ){
                            $validator->addFailure( $key, sprintf( __( "Field %s is required", "recurring-subscription-plans" ), $validator->getAttributeName( $key ) ) );
                        }
                    break;
                    case 'date':
                        if( !self::date( $data[$key] ) ){
                            $validator->addFailure( $key, sprintf( __( "Invalid date", "recurring-subscription-plans" ), $validator->getAttributeName( $key ) ) );
                        }                  
                    break;
                    case 'email':
                        if( !filter_var( $data[$key], FILTER_VALIDATE_EMAIL) ){
                            $validator->addFailure( $key, sprintf( __( "Invalid email", "recurring-subscription-plans" ), $validator->getAttributeName( $key ) ) );
                        }                  
                    break;
                    case 'document_number':
                        if( !self::brazilian_document_number( $data[$key] ) ){
                            $validator->addFailure( $key, sprintf( __( "Invalid document number", "recurring-subscription-plans" ), $validator->getAttributeName( $key ) ) );
                        }                  
                    break;
                    case 'cellphone':
                        if( !self::cellphone( $data[$key] ) ){
                            $validator->addFailure( $key, sprintf( __( "Invalid cellphone number", "recurring-subscription-plans" ), $validator->getAttributeName( $key ) ) );
                        }                  
                    break;
                }
            }
        }

        return $validator;
    }

    /**
     * Validate date rule
     *
     * @param string $date
     * @return boolean
     */
    public static function date($date)
    {
        switch( get_locale() ){
            case 'pt_BR':
                return preg_match('/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/(19|20)\d\d$/', $date);
            break;
            case 'en_US':
                return preg_match('/^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])/', $date);
            break;
        }
    }

    /**
     * Validate cellphone rule
     *
     * @param string $cellphone
     * @return boolean
     */
    public static function cellphone($cellphone)
    {
        switch( get_locale() ){
            case 'pt_BR':
                return preg_match('/^\(?[0-9]{2}\)?\s?[0-9]{5}\-?[0-9]{4}$/', trim($cellphone));
            break;
        }
    }

    /**
     * Validate brasilian document number
     *
     * @param string $document_number
     * @return boolean
     */
    public static function brazilian_document_number($document_number, $allow_empty = true)
    {
        if( empty($document_number) && $allow_empty )
            return true;
        $document_number = preg_replace( '/[^0-9]/is', '', $document_number );
            
        if (strlen($document_number) != 11) {
            return false;
        }
    
        if (preg_match('/(\d)\1{10}/', $document_number)) {
            return false;
        }
    
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $document_number[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($document_number[$c] != $d) {
                return false;
            }
        }
        return true;
    }
}