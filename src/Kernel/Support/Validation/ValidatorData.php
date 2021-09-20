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
}