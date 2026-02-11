<?php

abstract class WorkerPrototype
{
    protected string $name;
    protected string $position;

    public function getPosition(): string
    {
        return $this->position;
    }

    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}

class Developer extends WorkerPrototype
{
    protected string $position = 'Developer';
}

$developer = new Developer();

$developer2 = clone $developer;
$developer2->setName('Daniil');

var_dump($developer2->getName());
