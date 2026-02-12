<?php

interface Worker
{
    public function work(): void;
}

class ObjectManager
{
    private Worker $worker;

    public function __construct(Worker $worker)
    {
        $this->worker = $worker;
    }

    public function goWork(): void
    {
        $this->worker->work();
    }
}

class Developer implements Worker
{
    public function work(): void
    {
        printf('Developer is working now');
    }
}

class NullWorker implements Worker
{
    public function work(): void
    {
    }
}

$developer = new Developer();
$nullableDeveloper = new NullWorker();

$objectManager = new ObjectManager($developer);
$nullObjectManager = new ObjectManager($nullableDeveloper);

$objectManager->goWork();
$nullObjectManager->goWork();
