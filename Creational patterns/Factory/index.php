<?php

class Worker
{
    public function __construct(private ?string $name = null)
    {
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}

class WorkerFactory
{
    public static function make(): Worker
    {
        return new Worker();
    }
}

$worker = WorkerFactory::make();
$worker->setName('Test Name');
var_dump($worker->getName());
