<?php
/**
 * Recurring Subscription Plans
 *
 * @link              https://infixs.io/wordpress/plugins/recurring-subscription-plans/
 * @since             1.0.0
 * @package           RecurringSubscriptionPlans
 *
 * @wordpress-plugin
 * Plugin Name:       		Recurring Subscription Plans
 * Plugin URI:        		https://infixs.io/wordpress/plugins/recurring-subscription-plans/
 * Description:       		Make recurring charges from your subscribers.
 * Version:           		1.0.0
 * Requires at least: 		5.2
 * Requires PHP:      		7.0
 * WC requires at least:	3.0
 * WC tested up to:      	4.9
 * Author:            		Infixs
 * Author URI:        		https://infixs.io
 * Text Domain:       		recurring-subscription-plans
 * License:           		GPLv3
 * License URI:       		https://www.gnu.org/licenses/gpl-3.0.txt
 */

defined( 'ABSPATH' ) || exit;

//Define globals
define( 'INFIXS_RSP_PLUGIN_NAME', 'recurring-subscription-plans' );
define( 'INFIXS_RSP_PLUGIN_NICE_NAME', 'Recurring Subscription Plans' );
define( 'INFIXS_RSP_PLUGIN_VERSION', '1.0.0' );
define( 'INFIXS_RSP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'INFIXS_RSP_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'INFIXS_RSP_BASE_NAME', plugin_basename( __FILE__ ) );
define( 'INFIXS_RSP_DIR_NAME', dirname(plugin_basename( __FILE__ )) );
define( 'INFIXS_RSP_PLUGIN_PREFIX', 'infixs_rsp_' );

require INFIXS_RSP_PLUGIN_PATH . 'vendor/autoload.php';

/**
 * Global function-holder. Works similar to a singleton's instance().
 *
 * @since 1.0.0
 *
 * @return RecurringSubscriptionPlans\Core
 */
function RecurringSubscriptionPlans() {
	/**
	 * @var \RecurringSubscriptionPlans\Core
	 */
	static $core;

	if ( ! isset( $core ) ) {
		$core = new \RecurringSubscriptionPlans\Core();
	}

	return $core;
}

RecurringSubscriptionPlans();
