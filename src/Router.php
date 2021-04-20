<?php

namespace RandomNumbersAPI;

use Pecee\SimpleRouter\SimpleRouter;
use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use RandomNumbersAPI\Controllers\ApiController;

/**
 * Class for routing api methods
 *
 * @author porfirovskiy
 */
class Router extends SimpleRouter {
    
    private static function setRoutesList(): void
    {
        self::post('/api/auth', [ApiController::class, 'auth']);
        self::get('/api/generate', [ApiController::class, 'generate']);
        self::get('/api/retrieve', [ApiController::class, 'retrieve']);

        self::setErrorRoute();
    }
    
    private static function setErrorRoute(): void
    {
        self::error(function(Request $request, \Exception $exception) {
            if($exception instanceof NotFoundHttpException && $exception->getCode() === 404) {
                header('HTTP/1.0 404 Not Found');
            } else {
                header('HTTP/1.0 400 Bad Request');
            }
            exit();
        });
    }
    
    public static function start(): void
    {
        self::setRoutesList();
        parent::start();
    }

}
