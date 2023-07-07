<?php

interface Worker
{
    public function work();
}

class Developer implements Worker
{
    public function work()
    {
        printf('Im Developer');
    }
}

class Designer implements Worker
{
    public function work()
    {
        printf('Im designer');
    }
}

class WorkerFactory
{
    public static function make($workerTitle): ?Worker
    {
        $Classname = strtoupper($workerTitle);

        // Можно сделать ещё мапинг массива подходящих классов.
        if (class_exists($Classname)) {
            return new $Classname();
        }

        return null;
    }
}

$developer = WorkerFactory::make('developer');

$developer->work();