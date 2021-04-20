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
 * Controller class for api http methods
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
        $randomValuesHelper = new RandomValues();
        
        $repository = new UsersMysqlRepository($orm);
        $this->usersComponent = new UsersComponent($repository, $randomValuesHelper);
        
        $repository = new NumbersMysqlRepository($orm);
        $this->numbersComponent = new NumbersComponent($repository, $randomValuesHelper);
        
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
        $this->usersComponent->getAccess($user);
        
        $result = $this->numbersComponent->generate($user->id);
        
        echo json_encode($result);
    }

    public function retrieve(): void
    {
        $bearerToken = $this->headersHandler->getBearerToken();
        $id = $this->inputHandler->get('id');

        $user = $this->usersComponent->getUserByToken($bearerToken);
        $this->usersComponent->getAccess($user);
        
        $value = $this->numbersComponent->retrieve($id);
        
        if (is_null($value)) {
            header('HTTP/1.0 404 Not Found');
            exit();
        }

        echo json_encode(['value' => $value]);
    }
}
