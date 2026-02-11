<?php

interface Worker
{
    public function work(): void;
}

class Developer implements Worker
{
    public function work(): void
    {
        printf('Im Developer');
    }
}

class Designer implements Worker
{
    public function work(): void
    {
        printf('Im designer');
    }
}

class WorkerFactory
{
    public static function make(string $workerTitle): ?Worker
    {
        $className = ucfirst(strtolower($workerTitle));

        // Можно сделать ещё мапинг массива подходящих классов.
        if (class_exists($className)) {
            return new $className();
        }

        return null;
    }
}

$developer = WorkerFactory::make('developer');

$developer->work();
