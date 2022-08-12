<?php
declare(strict_types=1);

namespace App\Service\Calculator;

final class CalculatorService
{

    public function add(float $param1, float $param2): float
    {
        return $param1 + $param2;
    }

    public function substract(float $param1, float $param2): float
    {
        return $param1 - $param2;
    }

    public function multiply(float $param1, float $param2): float
    {
        return $param1 * $param2;
    }

    public function divide(float $param1, float $param2): float
    {
        return $param1 / $param2;
    }
}