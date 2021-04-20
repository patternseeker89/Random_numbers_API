<?php

namespace RandomNumbersAPI\Tests;

use PHPUnit\Framework\TestCase;
use RandomNumbersAPI\Components\Users\UsersComponent;
use RandomNumbersAPI\Components\Users\UsersRepositoryInterface;
use RandomNumbersAPI\Helpers\RandomValues;

class UsersComponentTest extends TestCase
{
    protected $usersComponent;
    
    protected $repository;
    
    protected $randomValuesHelper;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(UsersRepositoryInterface::class);
        $this->randomValuesHelper = $this->createMock(RandomValues::class);
        
        $this->usersComponent = new UsersComponent($this->repository, $this->randomValuesHelper);
    }

    protected function tearDown(): void
    {
        unset($this->usersComponent);
    }
    
    /**
     * @dataProvider isTokenExpiredDataProvider
     * @param string $tokenDate
     * @param type $expectedResult
     */
    public function testIsTokenExpired(string $tokenDate, $expectedResult)
    {
        $result = $this->usersComponent->isTokenExpired($tokenDate);
        $this->assertSame($expectedResult, $result);
    }
        
    public function isTokenExpiredDataProvider()
    {
        $dateTime = new \DateTime('now');
        $dateTime->add(new \DateInterval('PT60S'));
        $futureDateTime = $dateTime->format('Y-m-d H:i:s');
        
        return [
            ['2020-01-05 23:00:19', true],
            ['2021-10-05 13:10:49', false],
            [(new \DateTime('now'))->format('Y-m-d H:i:s'), true],
            [$futureDateTime, false],
        ];
    }
}