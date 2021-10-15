<?php
namespace Infixs\Support\Validation;

use Infixs\Support\MessageBag;

defined( 'ABSPATH' ) || exit;

class ValidatorData
{
    /**
     * Validation is passed or not
     *
     * @var boolean
     */
    protected $passed = true;

    /**
     * Attribute names
     *
     * @var arrray
     */
    protected $attribute_names = array();

    /**
     * Errors messages
     *
     * @var \Infixs\Support\MessageBag
     */
    protected $_errors;

    public function __construct()
    {   
        $this->_errors = new MessageBag();
    }

    /**
     * Determine if the data passed the validation rules.
     *
     * @return boolean
     */
    public function passes()
    {
        return $this->passed || false;
    }

    /**
     * Determine if the data fails the validation rules.
     *
     * @return void
     */
    public function fails()
    {
        return !$this->passed;
    }

    /**
     * Add a failed rule and error message to the collection.
     *
     * @param  string  $attribute
     * @param  string  $rule
     * @param  array  $parameters
     * @return void
     */
    public function addFailure($key, $message)
    {
        $this->errors()->add($key, $message);
        $this->passed = false;
    }

    /**
     * Get errors messages
     *
     * @return \Infixs\Support\MessageBag;
     */
    public function errors(){
        return $this->_errors;
    }

    /**
     * Set nice names for inputs
     *
     * @param array $niceNames
     * @return void
     */
    public function setAttributeNames( $niceNames )
    {
        $this->attribute_names = $niceNames;
    }

    public function getAttributeName( $key )
    {
        return isset( $this->attribute_names[$key] ) ? $this->attribute_names[$key] : $key;
    }
}