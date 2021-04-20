<?php

declare(strict_types=1);

namespace RandomNumbersAPI\Tests;

use PHPUnit\Framework\TestCase;
use RandomNumbersAPI\Components\Numbers\NumbersComponent;
use RandomNumbersAPI\Components\Numbers\NumbersRepositoryInterface;
use RandomNumbersAPI\Helpers\RandomValues;

class NumbersComponentTest extends TestCase
{
    protected $numbersComponent;
    
    protected $repository;
    
    protected $randomValuesHelper;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(NumbersRepositoryInterface::class);
        $this->randomValuesHelper = $this->createMock(RandomValues::class);
        
        $this->numbersComponent = new NumbersComponent($this->repository, $this->randomValuesHelper);
    }

    protected function tearDown(): void
    {
        unset(
            $this->numbersComponent,
            $this->repository,
            $this->randomValuesHelper
        );
    }
    
    /**
     * @dataProvider retrieveDataProvider
     * 
     * @param string $id
     * @param int|null $expectedResult
     * @return void
     */
    public function testRetrieve(string $id, ?int $expectedResult): void
    {
         $this->repository
            ->expects($this->once())    
            ->method('retrieve')
            ->with($id)
            ->willReturn($expectedResult);
        
        $result = $this->numbersComponent->retrieve($id);
        $this->assertSame($expectedResult, $result);
    }
        
    public function retrieveDataProvider(): array
    {
        return [
            ['a8f5f167f44f4964e6c998dee827110c', 7856],
            ['a467f167f44f4964e6c998dee827rty6', null]
        ];
    }
    
    /**
     * @dataProvider generateDataProvider
     * 
     * @param string $id
     * @param int $value
     * @param string $userId
     * @param array $expectedResult
     * @return void
     */
    public function testGenerate(string $id, int $value, int $userId, array $expectedResult): void
    {
        $this->randomValuesHelper
            ->expects($this->once())    
            ->method('generateRandomString')
            ->willReturn($id);
        
        $this->randomValuesHelper
            ->expects($this->once())    
            ->method('generateRandomNumber')
            ->willReturn($value);
        
         $this->repository
            ->expects($this->once())    
            ->method('save')
            ->with($id, $value, $userId);
        
        $result = $this->numbersComponent->generate($userId);
        $this->assertSame($expectedResult, $result);
    }
        
    public function generateDataProvider(): array
    {
        return [
            [
                'a8f5f167f44f4964e6c998dee827110c',
                123,
                1,
                ['id' => 'a8f5f167f44f4964e6c998dee827110c', 'value' => 123]
            ],
            [
                '998dee827110ca8f5f167f44f4964e6c',
                12356,
                12,
                ['id' => '998dee827110ca8f5f167f44f4964e6c', 'value' => 12356]
            ]
        ];
    }
}