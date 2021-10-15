<?php
namespace RecurringSubscriptionPlans\Database\Models;

use Infixs\Model;

class Subscription extends Model
{
    public static $table_name = \INFIXS_RSP_PLUGIN_PREFIX . 'subscription';
}