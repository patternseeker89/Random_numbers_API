<?php

namespace RandomNumbersAPI\Components\Users;

use RandomNumbersAPI\Components\Users\UsersRepositoryInterface;
use \RedBeanPHP\R as ORM;
use RedBeanPHP\OODBBean;

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

    public function getUserByLogin(string $login): ?OODBBean
    {
        $user = $this->orm::findOne('users', ' login = ? ', [$login]);

        return $user;
    }
    
    public function saveUser(OODBBean $user): void {
        $this->orm::store($user);
    }

}
