<?php
namespace RandomNumbersAPI\Components\Users;

use RandomNumbersAPI\Components\Users\UsersRepositoryInterface;

/**
 * Description of UsersComponent
 *
 * @author porfirovskiy
 */
class UsersComponent {
    
    const TOKEN_TTL = 60;

    private $repository;
    
    public function __construct(UsersRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function auth(string $login, string $password): ?string
    {
        $user = $this->repository->getUserByLogin($login);
        
        if (password_verify($password, $user->password_hash)) {
            if ($this->isTokenExpired($user->expired_at)) {
                $user->token = $this->generateToken();  
                $user->expired_at = $this->getTokenTTL();
                //var_dump($user);die();
                $this->repository->saveUser($user);
            }
            
            return $user->token;
        }
        
        return null;
    }
    
    private function getTokenTTL(): string
    {
        $dateTime = new \DateTime('now');
        $dateTime->add(new \DateInterval('PT' . self::TOKEN_TTL . 'S'));
        
        return $dateTime->format('Y-m-d H:i:s');
    }
    
    private function generateToken(): string
    {
        $randomString = bin2hex(random_bytes(32));

        return md5($randomString);
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
