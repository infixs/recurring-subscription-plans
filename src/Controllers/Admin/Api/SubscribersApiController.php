<?php
namespace RecurringSubscriptionPlans\Controllers\Admin\Api;

use InfixsRSP\Controller;
use InfixsRSP\Http\Response;
use InfixsRSP\Support\Date;
use InfixsRSP\Support\Str;

defined( 'ABSPATH' ) || exit;

class SubscribersApiController extends Controller
{
    public function get_subscriber( $request )
    {
        $subscriber_id = $request->get_param('id');

        global $wpdb;
        
        $table_prefix = $wpdb->prefix . \INFIXS_RSP_PLUGIN_PREFIX;
        $subscriber = $wpdb->get_row( 
            $wpdb->prepare(
            "SELECT 
                s.id, 
                s.first_name, 
                s.last_name, 
                s.birth_date, 
                s.document_number, 
                s.email,
                s.payment_method,
                s.zip_code,
                s.address,
                s.address_number,
                s.address2,
                s.state,
                s.city,
                s.neighborhood,
                s.phone_number,
                p.name as plan_name
            FROM 
                {$table_prefix}subscribers as s
            LEFT JOIN
                {$table_prefix}plans as p
            ON
                p.id = s.plan_id
            WHERE 
                s.id = %d
            ", $subscriber_id),
            ARRAY_A);

        $charges = $wpdb->get_results( 
            $wpdb->prepare(
            "SELECT 
                c.id,
                c.status,
                c.amount
            FROM 
                {$table_prefix}subscriber_charges as c
            WHERE 
                c.subscriber_id = %d
            ", $subscriber_id));

        $subscriber['charges'] = $charges;

        Response::json($subscriber);
    }

    public function get_subscribers()
    {
        global $wpdb;
        
        $table_prefix = $wpdb->prefix . \INFIXS_RSP_PLUGIN_PREFIX;
        $subscribers = $wpdb->get_results( 
            "SELECT 
                s.id, 
                s.first_name, 
                s.last_name, 
                s.birth_date, 
                s.document_number, 
                s.payment_method,
                p.name as plan_name
            FROM 
                {$table_prefix}subscribers as s
            LEFT JOIN
                {$table_prefix}plans as p
            ON
                p.id = s.plan_id
            ORDER BY
                s.created_at
            DESC
            ");

        $data = [];
        foreach( $subscribers as $subscriber ){
            array_push($data, [
                'id' => $subscriber->id,
                'name' => $subscriber->first_name . ' ' . $subscriber->last_name,
                'payment_method' => $subscriber->payment_method,
                'plan_name' => $subscriber->plan_name,
                'document_number' => Str::format('document_number', $subscriber->document_number ),
                'age' => Date::toAge($subscriber->birth_date),
                'address' => ''
            ]);
        }

        Response::json($data);
    }

    public function postback_payment()
    {
        
    }
}