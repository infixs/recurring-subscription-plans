<?php
namespace RecurringSubscriptionPlans\Helpers;

use RecurringSubscriptionPlans\Gateways\Pagarme\PagarmeGateway;

defined( 'ABSPATH' ) || exit;

class Subscription{
    public static function makeSubscription( $plan_id, $customer_data ){
        $pagarme = new PagarmeGateway();

        $validate = $pagarme->api->create_subscription( $plan_id, $customer_data );

        
        
        return $validate;
    }
}