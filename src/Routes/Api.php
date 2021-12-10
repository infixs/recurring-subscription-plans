<?php
use InfixsRSP\Routing\RestRoute;
use InfixsRSP\Routing\Routes;
use InfixsRSP\WP;
use RecurringSubscriptionPlans\Controllers\Admin\Api\SubscribersApiController;

//Prevent direct file call
defined( 'ABSPATH' ) || exit;

RestRoute::get('/subscribers', [SubscribersApiController::class, 'get_subscribers'])->name('api.subscribers');

RestRoute::get('/subscribers/{id}', [SubscribersApiController::class, 'get_subscriber'])->where(['id' => '\d+']);

RestRoute::post('/postback-payment', [SubscribersApiController::class, 'postback_payment'])->name('postback');