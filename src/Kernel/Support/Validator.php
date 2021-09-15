<?php
namespace Infixs\Support;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

class Validator
{
    public static function make( $date, $rules )
    {
        $message = "";
        $htmlErrors = "";
        $fail = false;
        $isValid = true;

        foreach( $rules as $name => $values ){
            $rules_array = explode( '|', $values );
            foreach( $rules_array as $rule ){
                if( ! isset( $_POST[$name] ) )
                    continue;

                switch( $rule ){
                    case 'required':
                        if( empty( $_POST[$name] ) ){
                            $message .= "O campo {$name} é obrigatório\r\n";
                            $isValid = false;
                            $fail = true;
                            $htmlErrors .= "O campo {$name} é obrigatório<br>";
                        }
                    break;
                }
            }
        }
        return [
            'message' => $message,
            'isValid' => $isValid,
            'htmlErrors' => $htmlErrors
        ];
    }

}