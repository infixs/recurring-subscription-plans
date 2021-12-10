<?php
namespace RecurringSubscriptionPlans;

use InfixsRSP\WP;
use RecurringSubscriptionPlans\Database\Migration;
use RecurringSubscriptionPlans\Providers\RouteServiceProvider;

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
		$this->pluginUrl  = \INFIXS_RSP_PLUGIN_URL;
		$this->pluginPath = \INFIXS_RSP_PLUGIN_PATH;
		$this->assetsUrl  = $this->pluginUrl . '/assets';

		$this->pluginName    = \INFIXS_RSP_PLUGIN_NAME;
		$this->pluginVersion = \INFIXS_RSP_PLUGIN_VERSION;

        Migration::check_update( $this->pluginVersion );

		RouteServiceProvider::boot();

		WP::add_action('init', $this, 'init' );
		WP::add_action('plugins_loaded', $this, 'after_load' );
    }

	/**
	 * Wordpress Init
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function init()
	{
		
	}

	/**
	 * Load plugin text domain
	 *
	 * @return void
	 */
	public function load_plugin_textdomain() {
		$locale = determine_locale();
		$domain = \INFIXS_RSP_PLUGIN_NAME;

		$locale = apply_filters( 'plugin_locale', $locale, $domain );

		if ( is_textdomain_loaded( $domain ) ) {
			unload_textdomain( $domain );
		}

		$mofile = sprintf( '%s-%s.mo', $domain, $locale );

		$domain_path = path_join( INFIXS_RSP_PLUGIN_PATH, 'languages' );
		$loaded = load_textdomain( $domain, path_join( $domain_path, $mofile ) );
		
		if ( ! $loaded ) {
			$domain_path = path_join( WP_LANG_DIR, 'plugins' );
			load_textdomain( $domain, path_join( $domain_path, $mofile ) );
		}
		
		load_plugin_textdomain( 'recurring-subscription-plans', false, INFIXS_RSP_PLUGIN_PATH . 'languages' );
	}

	/**
	 * After load function
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function after_load()
	{
		$this->load_plugin_textdomain();
	}
}