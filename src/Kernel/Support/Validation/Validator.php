<?php
namespace Infixs\Support\Validation;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

class Validator
{
    public static function make( $data, $rules )
    {
        $validator = new ValidatorData();
        foreach( $rules as $key => $values ){
            $rules_array = explode( '|', $values );
            foreach( $rules_array as $rule ){
                switch( $rule ){
                    case 'required':
                        if( ! isset( $data[$key] ) || empty( $data[$key] ) ){
                            $validator->addFailure( $key, "O campo {$key} é obrigatório" );
                        }
                    break;
                }
            }
        }

        return $validator;
    }
}