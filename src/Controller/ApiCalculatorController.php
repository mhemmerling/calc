<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\Calculator\CalculatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use InvalidArgumentException;
use Throwable;

class ApiCalculatorController extends AbstractController
{
    private const METHOD_ADD = 'add';
    private const METHOD_SUBSTRACT = 'substract';
    private const METHOD_MULTIPLY = 'multiply';
    private const METHOD_DIVIDE = 'divide';

    private const ALL_METHODS = [
        self::METHOD_ADD,
        self::METHOD_SUBSTRACT,
        self::METHOD_MULTIPLY,
        self::METHOD_DIVIDE,
    ];

    private CalculatorService $calculatorService;

    public function __construct(CalculatorService $calculatorService)
    {
        $this->calculatorService = $calculatorService;
    }

    public function index(): JsonResponse
    {
        return $this->json([
            'error' => 'Select calculation method, allowed types are: ' . implode(', ', self::ALL_METHODS),
        ]);
    }

    public function calculate($method, $param1, $param2): JsonResponse
    {
        try {
            $this->validateInput($method, $param1, $param2);
            $param1 = floatval($param1);
            $param2 = floatval($param2);

            switch ($method) {
                case self::METHOD_ADD:
                    $result = $this->calculatorService->add($param1, $param2);
                    break;
                case self::METHOD_SUBSTRACT:
                    $result = $this->calculatorService->substract($param1, $param2);
                    break;
                case self::METHOD_MULTIPLY:
                    $result = $this->calculatorService->multiply($param1, $param2);
                    break;
                case self::METHOD_DIVIDE:
                    $result = $this->calculatorService->divide($param1, $param2);
                    break;
                default:
                    $result = null;
            }

            return $this->json([
                'method' => $method,
                'param1' => $param1,
                'param2' => $param2,
                'result' => $result,
            ]);
        } catch (Throwable $throwable) {
            return $this->json(['error' => $throwable->getMessage()]);
        }
    }

    private function validateInput($method, $param1, $param2): void
    {
        if (!in_array($method, self::ALL_METHODS)) {
            throw new InvalidArgumentException(
                'Invalid calculation method, allowed types are: ' . implode(', ', self::ALL_METHODS)
            );
        }

        if (!is_numeric($param1) || !is_numeric($param2)) {
            throw new InvalidArgumentException(
                'Calculation values must me numeric'
            );
        }
    }
}
