<?php
namespace Infixs\Support\Validation;

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
                            $validator->addFailure( $key, "O campo " . $validator->getAttributeName( $key ) . " é obrigatório" );
                        }
                    break;
                }
            }
        }

        return $validator;
    }
}