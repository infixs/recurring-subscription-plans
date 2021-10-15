<?php

use Infixs\Routing\Route;
use Infixs\Routing\MenuPage;
use RecurringSubscriptionPlans\Controllers\Front\SubscriptionController;
use RecurringSubscriptionPlans\Controllers\Front\SubscriptionPaymentController;
use RecurringSubscriptionPlans\Controllers\Admin\SubscribersController;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

Route::get('/subscription', [SubscriptionController::class, 'index']);
Route::post('/subscription', [SubscriptionController::class, 'store']);

MenuPage::add( __('Subscribers', 'recurring-subscription-plans'), 'edit_posts', 'rsp-subscribers', 'dashicons-groups', 55 )
    ->get([SubscribersController::class, 'index'])
    ->post([SubscribersController::class, 'store']);
