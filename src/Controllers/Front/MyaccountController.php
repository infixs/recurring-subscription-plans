<?php
namespace RecurringSubscriptionPlans\Controllers\Front;

use InfixsRSP\Controller;
use InfixsRSP\Http\Request;
use InfixsRSP\Http\Redirect;

defined( 'ABSPATH' ) || exit;
class MyaccountController extends Controller
{
    /**
     * Index function with get method
     *
     * @since 1.0.0
     * @return string
     */
    public function index( Request $request )
    {        
        
        return $this->view( 'front.my-account' );
    }
}