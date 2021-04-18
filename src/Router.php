<?php

namespace RandomNumbersAPI;

use Pecee\SimpleRouter\SimpleRouter;
use RandomNumbersAPI\Controllers\ApiController;

/**
 * Description of Router
 *
 * @author porfirovskiy
 */
class Router extends SimpleRouter {
    
    private static function setRoutesList(): void
    {
        self::post('/api/auth', [ApiController::class, 'auth']);
        self::get('/api/generate', [ApiController::class, 'generate']);
        self::get('/api/retrieve/{id?}', [ApiController::class, 'retrieve']);
    }
    
    public static function start(): void
    {
        self::setRoutesList();
        parent::start();
    }

}
