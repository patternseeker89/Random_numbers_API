<?php
namespace RandomNumbersAPI\Components\Users;

use RandomNumbersAPI\Components\Users\UsersRepositoryInterface;

/**
 * Description of UsersComponent
 *
 * @author porfirovskiy
 */
class UsersComponent {

    private $repository;
    
    public function __construct(UsersRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function auth(string $login): ?string
    {
        return $this->repository->getToken($login);
    }
}
