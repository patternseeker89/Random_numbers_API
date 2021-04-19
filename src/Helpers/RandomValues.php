<?php

namespace RandomNumbersAPI\Helpers;

/**
 * Description of RandomValues
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
    
}
