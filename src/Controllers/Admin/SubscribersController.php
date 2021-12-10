<?php
namespace RecurringSubscriptionPlans\Controllers\Admin;

use InfixsRSP\Controller;
use InfixsRSP\Http\Request;
use InfixsRSP\Support\Validation\Validator;
use RecurringSubscriptionPlans\Database\Models\Plan;
use InfixsRSP\WP;

defined( 'ABSPATH' ) || exit;

class SubscribersController extends Controller
{
    public function index()
    {
        return $this->viewVue( 'main', 'admin.subscribers', compact('valores') );
    }

    public function store()
    {
        return $this->view( 'admin.vue.subscribers' );
    }
}