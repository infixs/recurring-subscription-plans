<?php
namespace RecurringSubscriptionPlans\Gateways;

defined( 'ABSPATH' ) || exit;

abstract class Gateway
{
    /**
	 * ID of the class extending the settings API. Used in option names.
	 *
	 * @var string
	 */
	public $id = '';

    /**
	 * Payment method title for the frontend.
	 *
	 * @var string
	 */
	public $title;

	/**
	 * Payment method description for the frontend.
	 *
	 * @var string
	 */
	public $description;

    /**
	 * Gateway title.
	 *
	 * @var string
	 */
	public $method_title = '';

    /**
	 * Gateway description.
	 *
	 * @var string
	 */
	public $method_description = '';

	/**
	 * Icon for the gateway.
	 *
	 * @var string
	 */
	public $icon;    
}