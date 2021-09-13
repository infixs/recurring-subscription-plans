<?php

use Infixs\Routing\Route;
use RecurringSubscriptionPlans\Controllers\Front\SubscriptionController;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

Route::get('/subscription', [SubscriptionController::class, 'index']);