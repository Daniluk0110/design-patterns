<?php

interface Mediator
{
    public function getWorker(): void;
}

abstract class Worker
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function sayHello(): void
    {
        printf('Hello');
    }

    public function work(): string
    {
        return $this->name . ' is working';
    }
}

class InfoBase
{
    public function printInfo(Worker $worker): void
    {
        printf($worker->work() . PHP_EOL);
    }
}

class WorkerInfoBaseMediator implements Mediator
{
    private Worker $worker;
    private InfoBase $infoBase;

    public function __construct(Worker $worker, InfoBase $infoBase)
    {
        $this->worker = $worker;
        $this->infoBase = $infoBase;
    }

    public function getWorker(): void
    {
        $this->infoBase->printInfo($this->worker);
    }
}

class Developer extends Worker
{

}

class Designer extends Worker
{

}

$developer = new Developer('Boris');
$designer = new Designer('Anna');
$infoBase = new InfoBase();

$workerInfoBaseMediator = new WorkerInfoBaseMediator($developer, $infoBase);
$workerInfoBaseMediator2 = new WorkerInfoBaseMediator($designer, $infoBase);

$workerInfoBaseMediator->getWorker();
$workerInfoBaseMediator2->getWorker();
