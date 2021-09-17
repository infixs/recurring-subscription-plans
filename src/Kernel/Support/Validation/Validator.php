<?php
namespace Infixs\Support\Validation;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

class Validator
{
    public static function make( $data, $rules )
    {
        $message = "";
        $htmlErrors = "";
        $fail = false;
        $isValid = true;

        $validator = new ValidatorData();
        foreach( $rules as $key => $values ){
            $rules_array = explode( '|', $values );
            foreach( $rules_array as $rule ){
                if( ! isset( $data[$key] ) )
                    continue;

                switch( $rule ){
                    case 'required':
                        if( empty( $data[$key] ) ){
                            $message .= "O campo {$key} é obrigatório\r\n";
                            $validator->errors()->add( $key, "O campo {$key} é obrigatório" );
                            $isValid = false;
                            $fail = true;
                            $htmlErrors .= "O campo {$key} é obrigatório<br>";
                        }
                    break;
                }
            }
        }

        return $validator;
        return [
            'message' => $message,
            'isValid' => $isValid,
            'htmlErrors' => $htmlErrors
        ];
    }
}