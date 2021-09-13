<?php
namespace RecurringSubscriptionPlans\Providers;

use Infixs\ServiceProvider;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

/**
 * RouteServiceProvider class
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * Boot function
     *
     * @return void
     */
    public static function boot()
    {
        include \INFIXS_RSP_PLUGIN_PATH . 'src/Routes/Web.php';
    }
}