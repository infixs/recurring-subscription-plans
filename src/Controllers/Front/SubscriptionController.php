<?php
namespace RecurringSubscriptionPlans\Controllers\Front;

use Infixs\Controller;
use Infixs\Http\Request;
use Infixs\Http\Response;
use Infixs\Support\Validation\Validator;
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

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $nasc = $_POST['nasc'];
        $email = $_POST['email'];
        //$password = $_POST['password'];
        //$password_confirm = $_POST['password_confirm'];

        $validate = Validator::make( $_POST, [
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'cpf' => 'required',
            'nasc' => 'required',
            'email' => 'required',
            //'password' => 'required',
            //'password_confirm' => 'required'
        ]);

        $plan_id = (int) $request->input('plan');
        $plan = Plan::getPlan($plan_id, ['name', 'price']);
        $plan = $plan ? $plan : null;


        if( !$validate->fails() && !$request->input('backstep') )
        {
            return $this->view( 'front.subscription-payment', compact('validate', 'plan') );
        }

        return $this->view( 'front.subscription', compact('validate', 'plan') );
    }

    public function cardForm( Request $request ){

        $validate = null;
        
        
        $validate = Validator::make( $_POST, [
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'cpf' => 'required',
            'nasc' => 'required',
            'email' => 'required',
            'ccname' => 'required',
            'cardnumber' => 'required',
            'exp-date' => 'required',
            'cvv' => 'required',
        ], null, $this->inputNames);
        

        $plan_id = (int) $request->input('plan');
        $plan = Plan::getPlan($plan_id, ['name', 'price']);
        $plan = $plan ? $plan : null;

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
            'phone' => 'required',
            'cpf' => 'required',
            'nasc' => 'required',
            'email' => 'required',
            'ccname' => 'required',
            'cardnumber' => 'required',
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

        if( !$validate->fails() ){
            $validate = Subscription::makeSubscription( $plan_id, $request->all() );

            return $this->view( 'front.subscription-address', compact('validate', 'plan') );
        }

        return $this->view( 'front.subscription-address', compact('validate', 'plan') );
    }
}