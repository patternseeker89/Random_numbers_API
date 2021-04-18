<?php

namespace RandomNumbersAPI;

use \RedBeanPHP\R AS RedBeanOrm;

/**
 * 
 */
class OrmAdapter {

    private function configurate(): void
    {
        RedBeanOrm::setup('mysql:host=localhost;dbname=random_numbers', 'user1', '123');

        if(!RedBeanOrm::testConnection()) {
            throw new Exception('No DB connection!');
        }
    }

    public function get(): RedBeanOrm
    {
        $this->configurate();

        return new RedBeanOrm();
    }
}
