<?php
namespace RandomNumbersAPI\Components\Users;

use RandomNumbersAPI\Components\Users\UsersRepositoryInterface;
use RandomNumbersAPI\Helpers\RandomValues;
use RedBeanPHP\OODBBean;

/**
 * Description of UsersComponent
 *
 * @author porfirovskiy
 */
class UsersComponent {
    
    const TOKEN_TTL = 60;

    private $repository;
    
    private $randomValuesHelper;
    
    public function __construct(UsersRepositoryInterface $repository, RandomValues $randomValuesHelper)
    {
        $this->repository = $repository;
        $this->randomValuesHelper = $randomValuesHelper;
    }
    
    public function auth(string $login, string $password): ?string
    {
        $user = $this->repository->getUserByLogin($login);
        
        if (!is_null($user) && password_verify($password, $user->password_hash)) {
            if ($this->isTokenExpired($user->expired_at)) {
                $user->token = $this->randomValuesHelper->generateRandomString();
                $user->expired_at = $this->getTokenTTL();
                $this->repository->saveUser($user);
            }
            
            return $user->token;
        }
        
        return null;
    }
    
    public function getUserByToken(string $token): ?OODBBean
    {
        return $this->repository->getUserByToken($token);
    }
    
    private function getTokenTTL(): string
    {
        $dateTime = new \DateTime('now');
        $dateTime->add(new \DateInterval('PT' . self::TOKEN_TTL . 'S'));
        
        return $dateTime->format('Y-m-d H:i:s');
    }
    
    public function isTokenExpired(string $tokenDate): bool
    {
        $currentDateObject = new \DateTime('now');
        $tokenDateObject = new \DateTime($tokenDate);
        
        if ($currentDateObject <= $tokenDateObject) {
            return false;
        }
        
        return true;
    }
}
