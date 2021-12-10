<?php
namespace InfixsRSP\Http;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

class Request
{
    private $method;

    private $data;

    /**
     * Create request
     *
     * @param array $params
     */
    public function __construct( $params = [] )
    {
        $this->method = $_SERVER['REQUEST_METHOD'];

        if( isset($_REQUEST) )
        foreach( $_REQUEST as $key => $value ){
            $this->data[$key] = $value;
        }

        if( !empty($params) )
        foreach( $params as $key => $value ){
            $this->data[$key] = $value;
        }
    }   

    /**
     * Get param function
     *
     * @since 1.0.0
     * @param string $input
     * @return mixed
     */
    public function input( string $input )
    {
        return isset($this->data[$input]) ? $this->data[$input] : null;
    }

    /**
     * Same input
     *
     * @since 1.0.0
     * @param string $input
     * @return void
     */
    public function get_param( string $input )
    {
        return isset($this->data[$input]) ? $this->data[$input] : null;
    }

    /**
     * Return old input value
     *
     * @since 1.0.0
     * @param string $input
     * @return void
     */
    public function old( string $input ){
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