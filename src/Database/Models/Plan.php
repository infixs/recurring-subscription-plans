<?php
namespace RecurringSubscriptionPlans\Database\Models;

class Plan
{

    /**
     * Get plan by id
     *
     * @param integer $plan_id
     * @return void
     */
    public static function getPlan( int $plan_id, array $columns = null ){
        global $wpdb;

        $table = $wpdb->prefix . \INFIXS_RSP_PLUGIN_PREFIX . 'plans';

        $columns = isset($columns) ? implode(", ", $columns) : "*";

        return $wpdb->get_row( $wpdb->prepare( "SELECT {$columns} FROM {$table} WHERE id = %d", $plan_id ) );
    }
}