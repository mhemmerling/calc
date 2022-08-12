<?php
declare(strict_types=1);

namespace App\Tests\Service\Calculator;

use App\Service\Calculator\CalculatorService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class CalculatorServiceTest extends KernelTestCase
{
    protected CalculatorService $calculatorService;

    protected function setUp(): void
    {
        $this->calculatorService = new CalculatorService();
    }

    /**
     * @test
     * @dataProvider validAddCalculations
     */
    public function shouldAddValuesTest(float $param1, float $param2, float $result): void
    {
        self::assertEquals($result, $this->calculatorService->add($param1, $param2));
    }

    /**
     * @test
     * @dataProvider validSubstractCalculations
     */
    public function shouldSubstractValuesTest(float $param1, float $param2, float $result): void
    {
        self::assertEquals($result, $this->calculatorService->substract($param1, $param2));
    }

    /**
     * @test
     * @dataProvider validMultiplyCalculations
     */
    public function shouldMultiplyValuesTest(float $param1, float $param2, float $result): void
    {
        self::assertEquals($result, $this->calculatorService->multiply($param1, $param2));
    }

    /**
     * @test
     * @dataProvider validDivideCalculations
     */
    public function shouldDivideValuesTest(float $param1, float $param2, float $result): void
    {
        self::assertEquals($result, $this->calculatorService->divide($param1, $param2));
    }

    /**
     * @test
     */
    public function shouldThrowExceptionOnDivideByZeroTest(): void
    {
        self::expectError();

        $this->calculatorService->divide(10, 0);
    }

    public function validAddCalculations()
    {
        return [
            [2, 2, 4],
            [1.12, 3.1415, 4.2615],
            [6, 8, 14],
        ];
    }

    public function validSubstractCalculations()
    {
        return [
            [2, 2, 0],
            [1.12, 3.1415, -2.0215],
            [8, 6, 2],
        ];
    }

    public function validMultiplyCalculations()
    {
        return [
            [2, 2, 4],
            [1.12, 3.1415, 3.5184800000000007],
            [8, 6, 48],
        ];
    }

    public function validDivideCalculations()
    {
        return [
            [2, 2, 1],
            [1.12, 3.1415, 0.35651758713990134],
            [10, 5, 2],
        ];
    }

}