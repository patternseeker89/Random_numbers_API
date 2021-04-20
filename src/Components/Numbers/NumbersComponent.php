<?php

namespace RandomNumbersAPI\Components\Numbers;

use RandomNumbersAPI\Helpers\RandomValues;

/**
 * Component for number entity
 *
 * @author porfirovskiy
 */
class NumbersComponent {
    
    const MIN_NUMBER = 1;
    const MAX_NUMBER = 100000;
    
    private $repository;
    
    private $randomValuesHelper;
    
    public function __construct(
        NumbersRepositoryInterface $repository,
        RandomValues $randomValuesHelper
    ) {
        $this->repository = $repository;
        $this->randomValuesHelper = $randomValuesHelper;
    }
    
    public function generate(int $userId): array
    {
        $id = $this->randomValuesHelper->generateRandomString();
        $value = $this->generateRandomNumber();

        $this->repository->save($id, $value, $userId);

        return ['id' => $id, 'value' => $value];
    }

    public function retrieve(string $id): ?int
    {
        return $this->repository->retrieve($id);
    }
    
    private function generateRandomNumber(): int
    {
        return random_int(self::MIN_NUMBER, self::MAX_NUMBER);
    }
}
