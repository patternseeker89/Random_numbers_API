<?php

namespace RandomNumbersAPI\Controllers;

/**
 * Description of ApiController
 *
 * @author porfirovskiy
 */
class ApiController {

    public function auth(): void
    {
        var_dump($login, $_POST);
        echo 11 . $login;
    }
    
    public function generate(): void
    {
        echo 11;
    }
    
    public function retrieve(string $id = ''): void
    {
        var_dump($id, $_POST);
        echo $id;
    }
}
