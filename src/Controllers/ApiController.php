<?php

namespace RandomNumbersAPI\Controllers;

use RandomNumbersAPI\Components\Users\UsersComponent;
use RandomNumbersAPI\Components\Numbers\NumbersComponent;
use RandomNumbersAPI\Components\Users\UsersMysqlRepository;
use RandomNumbersAPI\Components\Numbers\NumbersMysqlRepository;
use RandomNumbersAPI\OrmAdapter;
use RandomNumbersAPI\Router;
use RandomNumbersAPI\Helpers\HeadersHandler;
use RandomNumbersAPI\Helpers\RandomValues;

/**
 * Description of ApiController
 *
 * @author porfirovskiy
 */
class ApiController {
    
    private $inputHandler;
    
    private $usersComponent;
    
    private $headersHandler;
    
    private $numbersComponent;

    public function __construct()
    {
        $orm = (new OrmAdapter())->get();
        
        $repository = new UsersMysqlRepository($orm);
        $this->usersComponent = new UsersComponent($repository, new RandomValues());
        
        $repository = new NumbersMysqlRepository($orm);
        $this->numbersComponent = new NumbersComponent($repository, new RandomValues());
        
        $this->inputHandler = Router::request()->getInputHandler();
        $this->headersHandler = new HeadersHandler();
    }

    public function auth(): void
    {
        $login = $this->inputHandler->post('login');
        $password = $this->inputHandler->post('pass');
        
        $authToken = $this->usersComponent->auth($login->value, $password->value);
        if (is_null($authToken)) {
            header('HTTP/1.0 403 Forbidden');
            exit();
        }
        
        echo json_encode(['token' => $authToken]);
    }

    public function generate(): void
    {
        $bearerToken = $this->headersHandler->getBearerToken();
        
        $user = $this->usersComponent->getUserByToken($bearerToken);
        if (is_null($user)) {
            header('HTTP/1.0 403 Forbidden');
            exit();
        }

        $isTokenExpired = $this->usersComponent->isTokenExpired($user->expired_at);
        if ($isTokenExpired) {
            header('HTTP/1.0 401 Unauthorized');
            exit();
        }
        
        $result = $this->numbersComponent->generate($user->id);
        
        echo json_encode($result);
    }

    public function retrieve(): void
    {
        
        $id = $this->inputHandler->get('id');
        var_dump($id->value);
        echo $id;
    }
}
