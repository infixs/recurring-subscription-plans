<?php
namespace RecurringSubscriptionPlans\Controllers\Front;

use Infixs\Controller;
use Infixs\Http\Request;
use Infixs\Support\Validator;
use RecurringSubscriptionPlans\Database\Models\Plan;

class SubscriptionPaymentController extends Controller
{
    public function index( Request $request )
    {
        $validate = Validator::make( $_POST, [] );

        $plan_id = (int) $request->input('plan');

        if( !$plan_id ){
            $this->redirect('/');
            die();
        }

        $plan = Plan::getPlan($plan_id, ['name', 'price']);

        return $this->view('front.subscription-payment', compact('validate', 'plan') );
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