<?php

interface Worker
{
    public function closedHour(int $hours): void;

    public function countSalary(): int;
}

class WorkerOutsource implements Worker
{
    private array $hours = [];

    public function closedHour(int $hours): void
    {
        $this->hours[] = $hours;
    }

    public function countSalary(): int
    {
        return array_sum($this->hours) * 20;
    }
}

class WorkerProxy extends WorkerOutsource implements Worker
{
    private int $salary = 0;

    public function countSalary(): int
    {
        if ($this->salary === 0) {
            // Считает только в том случае если у нас 0.
            // Дальше этот метод дёргаться не будет.
            $this->salary = parent::countSalary();
        }

        return $this->salary;
    }
}

$workerProxy = new WorkerProxy();
$workerProxy->closedHour(10);
$salary = $workerProxy->countSalary();

$workerProxy->closedHour(2000);
$workerProxy->closedHour(3990);
$workerProxy->closedHour(4000);

$salary = $workerProxy->countSalary();

var_dump($salary); // Output: 400
