<?php

namespace RandomNumbersAPI\Helpers;

/**
 * Description of HeadersHandler
 *
 * @author porfirovskiy
 */
class HeadersHandler {
    
    const AUTORIZATION_HEADER = 'Authorization';
    
    public function getBearerToken(): string
    {
        $headers = getallheaders();
        if (isset($headers[self::AUTORIZATION_HEADER])) {
            if (preg_match('/Bearer\s(\S+)/', $headers[self::AUTORIZATION_HEADER], $matches)) {
                return $matches[1];
            }
        }

        return '';
    }

}
