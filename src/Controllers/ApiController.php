<?php

namespace RandomNumbersAPI\Controllers;

use RandomNumbersAPI\Components\Users\UsersComponent;
use RandomNumbersAPI\Components\Users\UsersMysqlRepository;
use RandomNumbersAPI\OrmAdapter;
use RandomNumbersAPI\Router;
use RandomNumbersAPI\Helpers\HeadersHandler;

/**
 * Description of ApiController
 *
 * @author porfirovskiy
 */
class ApiController {
    
    private $inputHandler;
    
    private $usersComponent;
    
    private $headersHandler;

    public function __construct()
    {
        $orm = (new OrmAdapter())->get();
        $repository = new UsersMysqlRepository($orm);
        $this->usersComponent = new UsersComponent($repository);
        
        $this->inputHandler = Router::request()->getInputHandler();
        $this->headersHandler = new HeadersHandler();
        
    }

    public function auth(): void
    {
        $login = $this->inputHandler->post('login');
        $password = $this->inputHandler->post('pass');
        
        $auth = $this->usersComponent->auth($login->value, $password->value);
        
        //var_dump($login, $login->value, $auth);
    }

    public function generate(): void
    {
        $bearerToken = $this->headersHandler->getBearerToken();
        echo 11;
    }

    public function retrieve(): void
    {
        
        $id = $this->inputHandler->get('id');
        var_dump($id->value);
        echo $id;
    }
}
