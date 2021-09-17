<?php
namespace RecurringSubscriptionPlans\Database;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

/**
 * Class Database Migration
 */
class Migration 
{

	/**
	 * Undocumented function
	 *
	 * @param String $version Current Version of Plugin
	 * @return void
	 */
    public static function check_update( String $current_version )
	{
		//Get current installed version of plugin
		$installed_version = get_option( \INFIXS_RSP_PLUGIN_PREFIX . 'version' );

		//Verify if plugin is updating
		$is_updating = get_option( \INFIXS_RSP_PLUGIN_PREFIX . 'updating', 'no' );

		if( $is_updating == 'yes' ){
			echo __( 'The plugin ' . \INFIXS_RSP_PLUGIN_NICE_NAME . ' is updating, waiting for complete', \INFIXS_RSP_PLUGIN_NAME );
			die();
		}

		if( version_compare( $installed_version, $current_version, '<=' ) ){
			update_option( \INFIXS_RSP_PLUGIN_PREFIX . 'updating', 'yes' );
			ignore_user_abort(1);
			self::check_tables();
			update_option( \INFIXS_RSP_PLUGIN_PREFIX . 'updating', 'no' );
			update_option( \INFIXS_RSP_PLUGIN_PREFIX . 'version', $current_version);
		}
		
    }

    /**
     * Check tables
     *
     * @return void
     */
	public static function check_tables()
	{
		global $wpdb;
		
		$plugin_prefix = \INFIXS_RSP_PLUGIN_PREFIX;
			
		$result = array();
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		
		$wpdb_collate = $wpdb->collate;	
		
		$sql = "
		CREATE TABLE {$wpdb->prefix}{$plugin_prefix}subscribers (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			usuario_id bigint(20) NOT NULL,
			url text NOT NULL,
			slug varchar(255) NOT NULL,
			titulo text NOT NULL,
			descricao text NOT NULL,
			parametros text NOT NULL,
			created_at datetime DEFAULT CURRENT_TIMESTAMP,
			updated_at datetime ON UPDATE CURRENT_TIMESTAMP,
			PRIMARY KEY  (id)
		)
		COLLATE {$wpdb_collate}";
		$result[] = dbDelta( $sql );

		$sql = "
		CREATE TABLE {$wpdb->prefix}{$plugin_prefix}plans (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			name varchar(255) NOT NULL,
			slug varchar(255) NOT NULL,
			price decimal(10,2) NOT NULL,
			trial_days int DEFAULT 0,
			days int NOT NULL,
			created_at datetime DEFAULT CURRENT_TIMESTAMP,
			updated_at datetime ON UPDATE CURRENT_TIMESTAMP,
			PRIMARY KEY  (id)
		)
		COLLATE {$wpdb_collate}";
		$result[] = dbDelta( $sql );
        
    }
}