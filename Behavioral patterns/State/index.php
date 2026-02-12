<?php

interface State
{
    public function toNext(Task $task): void;

    public function getState(): string;
}

class Task
{
    private State $state;

    public function getState(): State
    {
        return $this->state;
    }

    public function setState(State $state): void
    {
        $this->state = $state;
    }

    public static function make(): Task
    {
        $self = new self;
        $self->setState(new Created());

        return $self;
    }

    public function proceedToNext(): void
    {
        $this->state->toNext($this);
    }
}

class Created implements State
{
    public function toNext(Task $task): void
    {
        $task->setState(new Process());
    }

    public function getState(): string
    {
        return 'Created state';
    }
}

class Process implements State
{
    public function toNext(Task $task): void
    {
        $task->setState(new Test());
    }

    public function getState(): string
    {
        return 'Process state';
    }
}

class Test implements State
{
    public function toNext(Task $task): void
    {
        $task->setState(new Done());
    }

    public function getState(): string
    {
        return 'Test state';
    }
}

class Done implements State
{
    public function toNext(Task $task): void
    {
        // Empty
    }

    public function getState(): string
    {
        return 'Done state';
    }
}

$task = Task::make();
var_dump($task->getState()->getState()); // Created state

$task->proceedToNext();
var_dump($task->getState()->getState()); // Process state

$task->proceedToNext();
var_dump($task->getState()->getState()); // Test state

$task->proceedToNext();
var_dump($task->getState()->getState()); // Done state
