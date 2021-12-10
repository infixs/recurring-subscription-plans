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

		if( version_compare( $installed_version, $current_version, '<' ) ){
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
			user_id bigint(20) NOT NULL,
			plan_id bigint(20) NOT NULL,
			payment_method varchar(80) NOT NULL,
			email varchar(255) NOT NULL,
			first_name varchar(255) NOT NULL,
			last_name varchar(255) NOT NULL,
			document_number varchar(255) NOT NULL,
			birth_date date DEFAULT NULL,
			gender varchar(10) DEFAULT NULL,
			phone_number varchar(20) DEFAULT NULL,
			status varchar(80) NOT NULL,
			gateway varchar(255) NOT NULL,
			default_card bigint(20) DEFAULT NULL,
			zip_code varchar(20) DEFAULT NULL,
			address varchar(150) DEFAULT NULL,
			address_number varchar(20) DEFAULT NULL,
			address2 varchar(150) DEFAULT NULL,
			state varchar(100) DEFAULT NULL,
			neighborhood varchar(100) DEFAULT NULL,
			city varchar(150) DEFAULT NULL,
			created_at datetime DEFAULT CURRENT_TIMESTAMP,
			updated_at datetime ON UPDATE CURRENT_TIMESTAMP,
			PRIMARY KEY  (id)
		)
		COLLATE {$wpdb_collate}";
		$result[] = dbDelta( $sql );

		$sql = "
		CREATE TABLE {$wpdb->prefix}{$plugin_prefix}subscriber_cards (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			subscriber_id bigint(20) NOT NULL,
			brand varchar(80) NOT NULL,
			last_digits varchar(4) NOT NULL,
			first_digits varchar(6) NOT NULL,
			expiration_date varchar(6) NOT NULL,
			holder_name varchar(255) NOT NULL,
			card_hash varchar(255) NOT NULL,
			created_at datetime DEFAULT CURRENT_TIMESTAMP,
			updated_at datetime ON UPDATE CURRENT_TIMESTAMP,
			PRIMARY KEY  (id)
		)
		COLLATE {$wpdb_collate}";
		$result[] = dbDelta( $sql );

		$sql = "
		CREATE TABLE {$wpdb->prefix}{$plugin_prefix}subscriber_charges (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			charge_number bigint(20) DEFAULT 1,
			subscriber_id bigint(20) NOT NULL,
			status varchar(80) NOT NULL,
			amount decimal(10,2) NOT NULL,
			paid_amount decimal(10,2) NOT NULL,
			card_last_digits int(4) DEFAULT NULL,
			created_at datetime DEFAULT CURRENT_TIMESTAMP,
			updated_at datetime ON UPDATE CURRENT_TIMESTAMP,
			PRIMARY KEY  (id)
		)
		COLLATE {$wpdb_collate}";
		$result[] = dbDelta( $sql );

		$sql = "
		CREATE TABLE {$wpdb->prefix}{$plugin_prefix}plans (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			gateway_plan_id bigint(20) NOT NULL,
			gateway varchar(255) NOT NULL,
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

		$sql = "
		CREATE TABLE {$wpdb->prefix}{$plugin_prefix}leads (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			ip varchar(80) NOT NULL,
			plan_id bigint(20) NOT NULL,
			payment_method varchar(80) NOT NULL,
			email varchar(255) NOT NULL,
			first_name varchar(255) NOT NULL,
			last_name varchar(255) NOT NULL,
			document_number varchar(255) NOT NULL,
			birth_date date DEFAULT NULL,
			phone_number varchar(20) DEFAULT NULL,
			gender varchar(10) DEFAULT NULL,
			created_at datetime DEFAULT CURRENT_TIMESTAMP,
			updated_at datetime ON UPDATE CURRENT_TIMESTAMP,
			PRIMARY KEY  (id)
		)
		COLLATE {$wpdb_collate}";
		$result[] = dbDelta( $sql );
        
    }
}