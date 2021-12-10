<?php

use InfixsRSP\Routing\Route;
use InfixsRSP\Routing\MenuPage;
use InfixsRSP\Routing\SubmenuPage;
use RecurringSubscriptionPlans\Controllers\Front\SubscriptionController;
use RecurringSubscriptionPlans\Controllers\Front\SubscriptionPaymentController;
use RecurringSubscriptionPlans\Controllers\Admin\SubscribersController;
use RecurringSubscriptionPlans\Controllers\Front\MyaccountController;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

Route::get('/subscription', [SubscriptionController::class, 'index'])->name('subscription');
Route::post('/subscription', [SubscriptionController::class, 'store']);

Route::get('/my-subscription', [MyaccountController::class, 'index'])->name('myaccount');

$subsMenu = MenuPage::add( __('Subscribers', 'recurring-subscription-plans'), 'edit_posts', 'rsp-subscribers', 'dashicons-groups', 55 )
    ->get([SubscribersController::class, 'index'])
    ->post([SubscribersController::class, 'store']);

/*SubmenuPage::add( $subsMenu, __('Settings', 'recurring-subscription-plans'), 'edit_posts', 'rsp-settings', 55 )
    ->get([SubscribersController::class, 'index'])
    ->post([SubscribersController::class, 'store']);*/