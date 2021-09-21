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
        return $this->view( 'admin.subscribers' );
    }

    public function store()
    {
        echo "ok";
        return $this->view( 'admin.subscribers' );
    }
}