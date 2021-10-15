<?php
namespace RecurringSubscriptionPlans\Gateways\Pagarme;

use RecurringSubscriptionPlans\Gateways\Gateway;
use RecurringSubscriptionPlans\Gateways\Pagarme\PagarmeApi;

defined( 'ABSPATH' ) || exit;

class PagarmeGateway extends Gateway {
	
	public $api;

	public $api_key;

	public function __construct()
	{
		$this->id = 'pagarme_gateway';
		$this->api_key = 'ak_test_R3vdcvHyzvB6lVuVA63phiFcYYG1MQ';
		$this->api = new PagarmeApi( $this );
	}
}