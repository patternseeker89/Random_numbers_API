<?php

namespace RandomNumbersAPI\Components\Users;

/**
 * Description of UsersRepositoryInterface
 *
 * @author porfirovskiy
 */
interface UsersRepositoryInterface {
    public function getToken(string $login): ?string;
}
