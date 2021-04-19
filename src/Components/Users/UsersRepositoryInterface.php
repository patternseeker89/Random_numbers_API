<?php

namespace RandomNumbersAPI\Components\Users;

use \RedBeanPHP\OODBBean;

/**
 * Description of UsersRepositoryInterface
 *
 * @author porfirovskiy
 */
interface UsersRepositoryInterface {
    public function getUserByLogin(string $login): ?OODBBean;
    public function saveUser(OODBBean $user): void;
}
