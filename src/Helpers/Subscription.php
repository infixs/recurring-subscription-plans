<?php
namespace RecurringSubscriptionPlans\Helpers;

use InfixsRSP\Support\Date;
use InfixsRSP\Support\Validation\ValidatorData;
use RecurringSubscriptionPlans\Gateways\Pagarme\PagarmeGateway;

defined( 'ABSPATH' ) || exit;

class Subscription{
    public static function makeSubscription( $plan_id, $customer_data ){
        $pagarme = new PagarmeGateway();

        $validate = $pagarme->api->create_subscription( $plan_id, $customer_data );

        $validate = apply_filters('rsp_subscription_after_payment', $validate, $plan_id, $customer_data);

        if( $validate->success() ){
            do_action('rsp_subscription_created');
        }
        
        return $validate;
    }
}