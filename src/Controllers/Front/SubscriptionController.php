<?php
namespace RecurringSubscriptionPlans\Controllers\Front;

use InfixsRSP\Controller;
use InfixsRSP\Http\Redirect;
use InfixsRSP\Http\Request;
use InfixsRSP\Http\Response;
use InfixsRSP\Support\Date;
use InfixsRSP\Support\Str;
use InfixsRSP\Support\Validation\Validator;
use RecurringSubscriptionPlans\Database\Models\Plan;
use RecurringSubscriptionPlans\Helpers\Subscription;

defined( 'ABSPATH' ) || exit;
class SubscriptionController extends Controller
{
    public $inputNames;


    public function __construct()
    {
        $this->inputNames = [
            'zipcode' => __( 'Zip Code', 'recurring-subscription-plans' ),
            'address' => __( 'Address', 'recurring-subscription-plans' ),
            'address_number' => __( 'Address Number', 'recurring-subscription-plans' ),
            'address_2' => __( 'Address 2', 'recurring-subscription-plans' ),
            'neighborhood' => __( 'Neighborhood', 'recurring-subscription-plans' ),
            'city' => __( 'City', 'recurring-subscription-plans' ),
            'ccname' => __( 'Name on Card', 'recurring-subscription-plans' ),
            'cardnumber' => __( 'Credit Card Number', 'recurring-subscription-plans' ),
            'exp-date' => __( 'Expiration Date', 'recurring-subscription-plans' ),
            'cvv' => __( 'Security Code', 'recurring-subscription-plans' ),
        ];
    }

    /**
     * Index function with get method
     *
     * @since 1.0.0
     * @return string
     */
    public function index( Request $request )
    {        
        $plan_id = (int) $request->input('plan');
        $plan = Plan::getPlan($plan_id, ['name', 'price']);
        $plan = $plan ? $plan : null;

        if( $request->input('step' ) == '2' ){
            return $this->view( 'front.subscription-payment', compact('plan') );
        }

        return $this->view( 'front.subscription', compact('plan') );
    }

    /**
     * Store function with post method
     *
     * @since 1.0.0
     * @return string
     */
    public function store( Request $request )
    {
        if( $request->input('sendregister' ) == '1' ){
            $this->registerForm( $request );
        }elseif( $request->input('sendcard' ) == '1' ){
            $this->cardForm( $request );
        }else{
            $this->basicForm( $request );
        }
    }

    public function basicForm( Request $request ){

        global $wpdb;

        $validate = Validator::make( $_POST, [
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required|cellphone',
            'document_number' => 'required|document_number',
            'birthdate' => 'required|date',
            'email' => 'required|email',
            'gender' => 'required',
            //'password' => 'required',
            //'password_confirm' => 'required'
        ]);

        $plan_id = (int) $request->input('plan');
        $plan = Plan::getPlan($plan_id, ['name', 'price']);
        $plan = $plan ? $plan : null;

        $validate = apply_filters('rsp_subscription_basic_form_validate', $validate, $request);
        $validate = apply_filters('rsp_subscription_form_validate', $validate, $request);

        if( !$validate->fails() && !$request->input('backstep') )
        {

			$wpdb->insert( $wpdb->prefix .  \INFIXS_RSP_PLUGIN_PREFIX . 'leads', [
				'plan_id' => $plan_id,
				'payment_method' => 'credit_card',
				'email' => $request->input('email'),
				'first_name' => $request->input('firstname'),
				'phone_number' => Str::onlyNumber( $request->input('phone') ),
				'gender' => $request->input('gender'),
				'last_name' => $request->input('lastname'),
				'birth_date' => Date::toFormat('d/m/Y', 'Y-m-d', $request->input('birthdate')),
				'document_number' => $request->input('document_number')
			] );

            return $this->view( 'front.subscription-payment', compact('validate', 'plan') );
        }

        return $this->view( 'front.subscription', compact('validate', 'plan') );
    }

    public function cardForm( Request $request ){

        $validate = null;
        
        
        $validate = Validator::make( $_POST, [
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required|cellphone',
            'document_number' => 'required|document_number',
            'birthdate' => 'required|date',
            'email' => 'required|email',
            'ccname' => 'required',
            'cardnumber' => 'required',
            'exp-date' => 'required',
            'gender' => 'required',
            'cvv' => 'required',
        ], null, $this->inputNames);
        

        $plan_id = (int) $request->input('plan');
        $plan = Plan::getPlan($plan_id, ['name', 'price']);
        $plan = $plan ? $plan : null;

        $validate = apply_filters('rsp_subscription_form_validate', $validate, $request);

        if( !$validate->fails() && !$request->input('backstep') ){
            return $this->view( 'front.subscription-address', compact('validate', 'plan') );
        }

        return $this->view( 'front.subscription-payment', compact('validate', 'plan') );
    }

    public function registerForm( Request $request ){

        $validate = null;
        
        
        $validate = Validator::make( $_POST, [
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required|cellphone',
            'document_number' => 'required|document_number',
            'birthdate' => 'required|date',
            'email' => 'required|email',
            'ccname' => 'required',
            'cardnumber' => 'required',
            'gender' => 'required',
            'exp-date' => 'required',
            'cvv' => 'required',
            'zipcode' => 'required',
            'address' => 'required',
            'address_number' => 'required',
            'address_2' => 'required',
            'state' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
        ], null, $this->inputNames);

        $plan_id = (int) $request->input('plan');
        $plan = Plan::getPlan($plan_id, ['name', 'price']);
        $plan = $plan ? $plan : null;

        $validate = apply_filters('rsp_subscription_form_validate', $validate, $request);

        if( !$validate->fails() ){
            $validate = Subscription::makeSubscription( $plan_id, $request->all() );

            if( !$validate->fails() ){
                Redirect::route('myaccount');
            }
        }

        return $this->view( 'front.subscription-address', compact('validate', 'plan') );
    }
}