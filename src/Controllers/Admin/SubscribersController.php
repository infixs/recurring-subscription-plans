<?php
namespace RecurringSubscriptionPlans\Controllers\Admin;

use Infixs\Controller;
use Infixs\Http\Request;
use Infixs\Support\Validation\Validator;
use RecurringSubscriptionPlans\Database\Models\Plan;

defined( 'ABSPATH' ) || exit;

class SubscribersController extends Controller
{
    public function index()
    {
        $valores = 'teste';
        return $this->viewVue( 'subscribers', 'admin.vue.subscribers', compact('valores') );
    }

    public function store()
    {
        return $this->view( 'admin.vue.subscribers' );
    }
}