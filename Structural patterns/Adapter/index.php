<?php

interface NativeWorker
{
    public function countSalary(): int|float;
}

interface OutsourceWorker
{
    public function countSalaryByHour(int|float $hours): int|float;
}

class NativeDeveloper implements NativeWorker
{

    public function countSalary(): float|int
    {
        return 100 * 22;
    }
}

class OutsourceDeveloper implements OutsourceWorker
{
    public function countSalaryByHour(int|float $hours): int|float
    {
        return $hours * 15;
    }
}

class OutsourceWorkerAdapter implements NativeWorker
{
    private OutsourceWorker $outsourceWorker;

    public function __construct(OutsourceWorker $outsourceWorker)
    {
        $this->outsourceWorker = $outsourceWorker;
    }

    public function countSalary(): int|float
    {
        return $this->outsourceWorker->countSalaryByHour(80);
    }
}

$nativeDeveloper = new NativeDeveloper();
$outsourceDeveloper = new OutsourceDeveloper();

$outsourceWorkerAdapter = new OutsourceWorkerAdapter($outsourceDeveloper);

var_dump($outsourceWorkerAdapter->countSalary());
