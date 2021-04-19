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
        $number = $this->orm::dispense('numbers');
        $number->id = $id;
        $number->value = $value;
        $number->user_id = $userId;
        
       
        
        $id1 = $this->orm::store($number);
         var_dump($id1);die();
    }
    
}
