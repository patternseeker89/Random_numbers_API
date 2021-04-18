<?php

namespace RandomNumbersAPI\Controllers;

use RandomNumbersAPI\Components\Users\UsersComponent;
use RandomNumbersAPI\Components\Users\UsersMysqlRepository;
use RandomNumbersAPI\OrmAdapter;
use Pecee\Http\Request;
use Pecee\SimpleRouter\SimpleRouter;

/**
 * Description of ApiController
 *
 * @author porfirovskiy
 */
class ApiController {
    
    private $inputHandler;
    
    private $usersComponent;

    public function __construct()
    {
        $orm = (new OrmAdapter())->get();
        $repository = new UsersMysqlRepository($orm);
        $this->usersComponent = new UsersComponent($repository);
        
        $this->inputHandler = SimpleRouter::request()->getInputHandler();
        
    }

    public function auth(): void
    {
        $login = $this->inputHandler->post('login');
        $auth = $this->usersComponent->auth($login->value);  
        var_dump($login, $login->value, $auth);
    }

    public function generate(): void
    {
        echo 11;
    }

    public function retrieve(): void
    {
        $id = $this->inputHandler->get('id');
        var_dump($id->value);
        echo $id;
    }
}
