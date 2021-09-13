<?php
namespace RecurringSubscriptionPlans;

use RecurringSubscriptionPlans\Database\Migration;
use RecurringSubscriptionPlans\WP\Helper as WP;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

/**
 * Recurring Subscription Plans
 *
 * @package RecurringSubscriptionPlans
 * @since   1.0.0
 * @version 1.0.0
 */
class Core {
	/**
	 * The unique identifier of this plugin.
	 *
	 * @since 1.0.0
	 * @var string $pluginName
	 */
	public $pluginName;

	/**
	 * The current version of the plugin.
	 *
	 * @since 1.1.0
	 * @var string $pluginVersion
	 */
	public $pluginVersion;

	/**
	 * Path to plugin directory.
	 * 
	 * @since 1.1.0
	 * @var string $pluginPath Without trailing slash.
	 */
	public $pluginPath;

	/**
	 * URL to plugin directory.
	 * 
	 * @since 1.1.0
	 * @var string $pluginUrl Without trailing slash.
	 */
	public $pluginUrl;

	/**
	 * URL to plugin assets directory.
	 * 
	 * @since 1.1.0
	 * @var string $assetsUrl Without trailing slash.
	 */
	public $assetsUrl;

	/**
	 * Plugin settings.
	 * 
	 * @since 1.1.0
	 * @var array
	 */
	protected $settings;

	/**
	 * Startup plugin.
	 * 
	 * @since 1.1.0
	 * @return void
	 */

    /**
     * Initialize the plugin public actions.
     */
    public function __construct() {
		//WP::show_errors();
		$this->pluginUrl  = \INFIXS_RSP_PLUGIN_URL;
		$this->pluginPath = \INFIXS_RSP_PLUGIN_PATH;
		$this->assetsUrl  = $this->pluginUrl . '/assets';

		$this->pluginName    = \INFIXS_RSP_PLUGIN_NAME;
		$this->pluginVersion = \INFIXS_RSP_PLUGIN_VERSION;

        Migration::check_update( $this->pluginVersion );

		WP::add_action('plugins_loaded', $this, 'after_load' );
    }
}