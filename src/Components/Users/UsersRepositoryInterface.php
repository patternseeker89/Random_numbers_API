<?php

namespace RandomNumbersAPI\Components\Users;

use \RedBeanPHP\OODBBean;

/**
 * Interface for UsersComponent repositories
 *
 * @author porfirovskiy
 */
interface UsersRepositoryInterface {
    public function getUserByLogin(string $login): ?OODBBean;
    public function saveUser(OODBBean $user): void;
    public function getUserByToken(string $token): ?OODBBean;
}
