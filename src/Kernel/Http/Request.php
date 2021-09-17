<?php
namespace Infixs\Http;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

class Request
{
    private $method;

    private $data;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];

        if( isset($_REQUEST) )
        foreach( $_REQUEST as $key => $value ){
            $this->data[$key] = $value;
        }
    }   

    /**
     * Get param function
     *
     * @param string $input
     * @return void
     */
    public function input( string $input )
    {
        return isset($this->data[$input]) ? $this->data[$input] : null;
    }

    /**
     * Return all requests parameters.
     *
     * @param string $input
     * @return void
     */
    public function all()
    {
        return $this->data;
    }
}