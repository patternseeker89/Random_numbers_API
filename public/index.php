<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', function() {
    return 'Hello world';
});

SimpleRouter::get('/not-found', function() {
    return 'Not found';
});

SimpleRouter::error(function(Request $request, \Exception $exception) {
    echo 'error';
});

// Start the routing
SimpleRouter::start();