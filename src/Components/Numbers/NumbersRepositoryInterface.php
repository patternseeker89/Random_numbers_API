<?php

namespace RandomNumbersAPI\Components\Numbers;

/**
 * Description of UsersRepositoryInterface
 *
 * @author porfirovskiy
 */
interface NumbersRepositoryInterface {
    public function save(string $id, int $value, int $userId): void;
    public function retrieve(string $id): ?int;
}
