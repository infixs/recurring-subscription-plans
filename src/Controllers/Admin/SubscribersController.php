<?php
namespace RecurringSubscriptionPlans\Controllers\Admin;

use Infixs\Controller;
use Infixs\Http\Request;
use Infixs\Support\Validation\Validator;
use RecurringSubscriptionPlans\Database\Models\Plan;
use Infixs\WP;

defined( 'ABSPATH' ) || exit;

class SubscribersController extends Controller
{
    public function index()
    {
        WP::load_admin_script( 'infixs-test', \INFIXS_RSP_PLUGIN_URL . 'assets/js/admin/subscribers.js', ['wp-i18n'], '1.0.0', true );
        WP::set_script_translations( 'infixs-test', 'recurring-subscription-plans', \INFIXS_RSP_PLUGIN_PATH . 'i18n/languages' );
        
 
        $valores = 'teste';
        return $this->viewVue( 'main', 'admin.subscribers', compact('valores') );
    }

    public function store()
    {
        return $this->view( 'admin.vue.subscribers' );
    }
}