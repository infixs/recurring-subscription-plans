<?php

use Infixs\Routing\Route;
use RecurringSubscriptionPlans\Controllers\Front\SubscriptionController;
use RecurringSubscriptionPlans\Controllers\Front\SubscriptionPaymentController;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

Route::get('/subscription', [SubscriptionController::class, 'index']);
Route::post('/subscription', [SubscriptionController::class, 'store']);

Route::get('/subscription/payment', [SubscriptionPaymentController::class, 'index']);
Route::post('/subscription/payment', [SubscriptionPaymentController::class, 'store']);