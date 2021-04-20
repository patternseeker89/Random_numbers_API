<?php

namespace RandomNumbersAPI\Helpers;

/**
 * Class create some random values
 *
 * @author porfirovskiy
 */
class RandomValues {
    
    const BYTES_LENGTH = 32;

    public function generateRandomString(): string
    {
        $randomString = bin2hex(random_bytes(self::BYTES_LENGTH));

        return md5($randomString);
    }
    
    public function generateRandomNumber(int $min, int $max): int
    {
        return random_int($min, $max);
    }
    
}
