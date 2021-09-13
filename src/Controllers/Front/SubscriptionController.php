<?php
namespace RecurringSubscriptionPlans\Controllers\Front;

use Infixs\Controller;

class SubscriptionController extends Controller
{
    public function index()
    {
        return $this->view('front.subscription');
    }
}