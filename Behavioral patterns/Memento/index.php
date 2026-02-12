<?php

class Memento
{
    private State $state;

    public function __construct(State $state)
    {
        $this->state = $state;
    }

    public function getState(): State
    {
        return $this->state;
    }
}

class State
{
    public const CREATED = 'created';
    public const PROCESS = 'process';
    public const TESTED = 'tested';
    public const DONE = 'done';

    private string $state;

    public function __construct(string $state)
    {
        $this->state = $state;
    }

    public function __toString(): string
    {
        return $this->state;
    }
}

class Task
{
    private State $state;

    public function create(): void
    {
        $this->state = new State(State::CREATED);
    }

    public function process(): void
    {
        $this->state = new State(State::PROCESS);
    }

    public function test(): void
    {
        $this->state = new State(State::TESTED);
    }

    public function done(): void
    {
        $this->state = new State(State::DONE);
    }

    public function getState(): State
    {
        return $this->state;
    }

    public function saveToMemento(): Memento
    {
        return new Memento($this->state);
    }

    public function restoreFromMemento(Memento $memento): void
    {
        $this->state = $memento->getState();
    }
}

$task = new Task();
$task->create();

$memento = $task->saveToMemento();

var_dump($memento->getState());
var_dump($task->getState() === $memento->getState());

$task->process();
$memento = $task->saveToMemento();
var_dump($memento->getState());

$task->test();
$memento = $task->saveToMemento();
var_dump($memento->getState());

$task->done();
$memento = $task->saveToMemento();
var_dump($memento->getState());
