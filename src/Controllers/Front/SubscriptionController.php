<?php
namespace RecurringSubscriptionPlans\Controllers\Front;

use Infixs\Controller;
use Infixs\WP;

class SubscriptionController extends Controller
{
    public function index()
    {
        WP::add_action( 'wp_enqueue_scripts', $this, 'load_scripts' );

        return $this->view('front.subscription');
    }

    public function load_scripts()
    {
        wp_enqueue_style( 'bootstrap-5', \INFIXS_RSP_ASSETS_URL . 'bootstrap/css/bootstrap.min.css', [],  \INFIXS_RSP_PLUGIN_VERSION);
    }
}