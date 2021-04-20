<?php

namespace RandomNumbersAPI\Components\Numbers;

/**
 * Interface for NumbersComponent repositories
 *
 * @author porfirovskiy
 */
interface NumbersRepositoryInterface {
    public function save(string $id, int $value, int $userId): void;
    public function retrieve(string $id): ?int;
}
