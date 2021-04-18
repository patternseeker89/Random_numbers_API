<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

//use Pecee\SimpleRouter\SimpleRouter;
//use RandomNumbersAPI\Controllers\ApiController;
use RandomNumbersAPI\Router;

//SimpleRouter::get('/', function() {
//    return 'Hello world';
//});
//
//SimpleRouter::get('/eee', function() {
//    return 'Not found';
//});
//
//echo ApiController::class;

//SimpleRouter::post('/api/auth', [ApiController::class, 'auth']);
//
//SimpleRouter::get('/api/generate', [ApiController::class, 'generate']);
//
//SimpleRouter::get('/api/retrieve/{id?}', [ApiController::class, 'retrieve']);

//SimpleRouter::controller('/q1', ApiController::class, ['as' => 'picture']);

//SimpleRouter::get('/q1', 'RandomNumbersAPI\Controllers\ApiController@auth', ['as' => 'page.notfound']);

//SimpleRouter::error(function(Request $request, \Exception $exception) {
//    echo 'error';
//});

// Start the routing
//SimpleRouter::start();
Router::start();