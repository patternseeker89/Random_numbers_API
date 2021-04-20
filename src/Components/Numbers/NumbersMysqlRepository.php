<?php

namespace RandomNumbersAPI\Components\Numbers;

use RandomNumbersAPI\Components\Numbers\NumbersRepositoryInterface;
use \RedBeanPHP\R as ORM;

/**
 * Description of NumbersMysqlRepository
 *
 * @author porfirovskiy
 */
class NumbersMysqlRepository implements NumbersRepositoryInterface {
    
    private $orm;
    
    public function __construct(ORM $orm)
    {
        $this->orm = $orm;
    }

    public function save(string $id, int $value, int $userId): void
    {
        $this->orm::exec("insert into numbers(id, value, user_id) values (?, ?, ?)", [$id, $value, $userId]);
    }
    
    public function retrieve(string $id): ?int
    {
        $number = $this->orm::findOne('numbers', ' id = ? ', [$id]);
        if (!is_null($number)) {
            return $number->value;
        }
        
        return null;
    }
    
}
