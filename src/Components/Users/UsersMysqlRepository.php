<?php

namespace RandomNumbersAPI\Components\Users;

use RandomNumbersAPI\Components\Users\UsersRepositoryInterface;
use \RedBeanPHP\R as ORM;

/**
 * Description of UsersMysqlRepository
 *
 * @author porfirovskiy
 */
class UsersMysqlRepository implements UsersRepositoryInterface {
    
    private $orm;
    
    public function __construct(ORM $orm)
    {
        $this->orm = $orm;
    }

    public function getToken(string $login): ?string
    {
        $user = ORM::findOne('users', ' login = ? ', [$login]);

        return $user->token;
    }

}
