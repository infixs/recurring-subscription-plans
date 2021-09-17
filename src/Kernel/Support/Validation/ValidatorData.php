<?php
namespace Infixs\Support\Validation;

use Infixs\Support\MessageBag;

defined( 'ABSPATH' ) || exit;

class ValidatorData
{
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
    public function passes()
    {

    }

    public function fails()
    {

    }

    public function errors(){
        return $this->_errors;
    }
}