<?php

interface Worker
{
    public function countSalary(): float|int;
}

abstract class WorkerDecorator implements Worker
{
    public Worker $worker;

    public function __construct(Worker $worker)
    {
        $this->worker = $worker;
    }
}

class Developer implements Worker
{
    public function CountSalary(): float|int
    {
        return 20 * 3000;
    }
}

class DeveloperOvertime extends WorkerDecorator
{
    public function countSalary(): float|int
    {
        return $this->worker->countSalary() + $this->worker->countSalary() * 0.2;
    }
}

class DeveloperOverOvertime extends WorkerDecorator
{
    public function countSalary(): float|int
    {
        return $this->worker->countSalary() + $this->worker->countSalary() * 0.4;
    }
}

$developer = new Developer();
$developerOverTime = new DeveloperOvertime($developer);
$developerOverOverTime = new DeveloperOverOvertime($developer);

var_dump($developer->countSalary());
var_dump($developerOverTime->countSalary());
var_dump($developerOverOverTime->countSalary());