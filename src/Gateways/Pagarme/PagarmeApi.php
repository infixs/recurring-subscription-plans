<?php
namespace RecurringSubscriptionPlans\Gateways\Pagarme;

use InfixsRSP\Routing\Routes;
use InfixsRSP\Support\Date;
use InfixsRSP\Support\Str;
use InfixsRSP\Support\Validation\ValidatorData;

defined( 'ABSPATH' ) || exit;

class PagarmeApi {

	/**
	 * API URL.
	 *
	 * @var string
	 */
	protected $api_url = 'https://api.pagar.me/1/';

	/**
	 * Gateway class.
	 *
	 * @var Gateway
	 */
	protected $gateway;

	/**
	 * Get API URL.
	 *
	 * @return string
	 */
	public function get_api_url() {
		return $this->api_url;
	}

	/**
	 * Constructor.
	 *
	 * @param Gateway $gateway Gateway instance.
	 */
	public function __construct( $gateway = null ) {
		$this->gateway = $gateway;
	}

	/**
	 * Do requests in the Pagar.me API.
	 *
	 * @param  string $endpoint API Endpoint.
	 * @param  string $method   Request method.
	 * @param  array  $data     Request data.
	 * @param  array  $headers  Request headers.
	 *
	 * @return array            Request response.
	 */
	protected function do_request( $endpoint, $method = 'POST', $data = array(), $headers = array() ) {
		$params = array(
			'method'  => $method,
			'timeout' => 60,
		);

		if ( ! empty( $data ) ) {
			$params['body'] = $data;
		}

		// Pagar.me user-agent and api version.
		$x_pagarme_useragent = 'rsp-pagarme-gateway/' . \INFIXS_RSP_PLUGIN_VERSION;

		$x_pagarme_useragent .= ' wordpress/' . get_bloginfo( 'version' );
		$x_pagarme_useragent .= ' php/' . phpversion();

		$params['headers'] = [
			'User-Agent' => $x_pagarme_useragent,
			'X-PagarMe-User-Agent' => $x_pagarme_useragent,
			'X-PagarMe-Version' => '2017-07-17',
		];

		if ( ! empty( $headers ) ) {
			$params['headers'] = array_merge( $params['headers'], $headers );
		}

		return wp_safe_remote_post( $this->get_api_url() . $endpoint, $params );
	}

	public function do_subscription( $data ) {
		
		$endpoint = 'subscriptions';

		$response = $this->do_request( $endpoint, 'POST', $data );

		$response = json_decode( $response['body'], true );

		return $response;
	}

	/**
	 * Generate the transaction data.
	 *
	 * @param  array $data  Order data.
	 *
	 * @return array Transaction data.
	 */
	public function generate_transaction_data( $data ) {
		// Set the request data.

		$document_number = Str::onlyNumber( $data['document_number'] );

		preg_match( '/\(([0-9]{2})\)(.+)/', $data['phone'], $matches );

		$phone_code = $matches[1];
		$phone_number = Str::onlyNumber( $matches[2] );

		$date = preg_replace( '/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/', '$3-$2-$1', $data['birthdate'] );

		$gendata = array(
			'api_key' => $this->gateway->api_key,
			'plan_id' => $data['plan_id'],
			'payment_method' => 'credit_card',
			'card_number' => Str::onlyNumber( $data['cardnumber'] ),
			'card_holder_name' => $data['ccname'],
			'card_expiration_date' => Str::onlyNumber( $data['exp-date'] ),
			'card_cvv' => $data['cvv'],
			'postback_url' => Routes::api('postback'),
			'customer' => [
			  'email' => $data['email'],
			  'name' => $data['firstname'] . ' ' . $data['lastname'],
			  'document_number' => $document_number,
			  'address' => [
				'street' => $data['address'],
				'street_number' => $data['address_number'],
				'complementary' => $data['address_2'],
				'neighborhood' => $data['neighborhood'],
				'zipcode' => Str::onlyNumber( $data['zipcode'] )
			  ],
			  'phone' => [
				'ddd' => $phone_code,
				'number' => $phone_number
			  ],
			  'gender' => 'other',
			  'born_at' => $date,
			],
			'metadata' => [
			  'plan_id' => 1
			]
		);

		// Add filter for Third Party plugins.
		return apply_filters( 'rsp_pagarme_transaction_data', $gendata, $data );
	}


	public function create_subscription( $plan_id, $customer_data )
	{
		global $wpdb;

		/*$plans = [
            1 => '637088',
            2 => '637089'
        ];*/ //Test ambient

		$plans = [
            1 => '1424299',
            2 => '1578797'
        ];

        $customer_data['plan_id'] = $plans[$plan_id];
		
		$data = $this->generate_transaction_data( $customer_data );

		$subscription = $this->do_subscription( $data );
		
		$validator = new ValidatorData();

		if( isset( $subscription['errors'] ) ){

			foreach( $subscription['errors'] as $key => $error ){
				$validator->addFailure( $key, $error['message'] );
			}
		}else{
			//Success

			$wpdb->insert( $wpdb->prefix .  \INFIXS_RSP_PLUGIN_PREFIX . 'subscribers', [
				'user_id' => 0,
				'plan_id' => $plan_id,
				'payment_method' => 'credit_card',
				'email' => $data['customer']['email'],
				'first_name' => $customer_data['firstname'],
				'phone_number' => Str::onlyNumber($customer_data['phone']),
				'gender' => $customer_data['gender'],
				'last_name' => $customer_data['lastname'],
				'birth_date' => Date::toFormat('d/m/Y', 'Y-m-d', $customer_data['birthdate']),
				'document_number' => $data['customer']['document_number'],
				'status' => $subscription['status'],
				'zip_code' => $customer_data['zipcode'],
				'address' => $customer_data['address'],
				'address_number' => $customer_data['address_number'],
				'address2' => $customer_data['address_2'],
				'state' => $customer_data['state'],
				'neighborhood' => $customer_data['neighborhood'],
				'city' => $customer_data['city'],
				'gateway' => $this->gateway->id
			] );

			$subscriber_id = $wpdb->insert_id;

			$wpdb->insert( $wpdb->prefix .  \INFIXS_RSP_PLUGIN_PREFIX . 'subscriber_cards', [
				'subscriber_id' => $subscriber_id,
				'last_digits' => Str::substr( $data['card_number'], -4),
				'first_digits' => Str::substr( $data['card_number'], 0, 6),
				'holder_name' => $data['card_holder_name'],
				'expiration_date' => $data['card_expiration_date'],
				'card_hash' => $subscription['card']['id'],
				'brand' => $subscription['card']['brand']
			] );

			$card_id = $wpdb->insert_id;

			$wpdb->update( $wpdb->prefix .  \INFIXS_RSP_PLUGIN_PREFIX . 'subscribers', [
				'default_card' => $card_id
			],[
				'id' => $subscriber_id
			] );
			
		}

		return $validator;
	}

	/**
	 * Check if Pagar.me response is validity.
	 *
	 * @param  array $ipn_response IPN response data.
	 *
	 * @return bool
	 */
	public function check_fingerprint( $ipn_response ) {

	}

	/**
	 * IPN handler.
	 */
	public function ipn_handler() {

	}

	/**
	 * Process successeful IPN requests.
	 *
	 * @param array $posted Posted data.
	 */
	public function process_successful_ipn( $posted ) {

	}

	/**
	 * Process the order status.
	 *
	 * @param WC_Order $order  Order data.
	 * @param string   $status Transaction status.
	 */
	public function process_order_status( $order, $status ) {

	}

}