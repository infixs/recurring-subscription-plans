<?php
namespace RecurringSubscriptionPlans\Controllers\Front;

use Infixs\Controller;
use Infixs\Support\Validator;

class SubscriptionPaymentController extends Controller
{
    public function index()
    {
        $validate = Validator::make( $_POST, [] );
        return $this->view('front.subscription-payment', compact('validate') );
    }

    public function store()
    {
        $validate = Validator::make( $_POST, [
            'ccname' => 'required',
            'cardnumber' => 'required',
            'exp-date' => 'required',
            'cvv' => 'required',
        ]);

        return $this->view('front.subscription-payment', compact('validate') );
    }
}