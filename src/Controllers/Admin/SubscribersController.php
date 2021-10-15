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
        return $this->viewVue( 'main', 'admin.subscribers', compact('valores') );
    }

    public function store()
    {
        return $this->view( 'admin.vue.subscribers' );
    }
}