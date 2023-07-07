<?php

interface Worker
{
    public function work(): void;
}

class Developer implements Worker
{
    public function work(): void
    {
        printf('Im Developer!');
    }
}

class Designer implements Worker
{
    public function work(): void
    {
        printf('Im Designer!');
    }
}

class Tester implements Worker
{
    public function work(): void
    {
        printf('Im Tester!');
    }
}

interface WorkerFactory
{
    public static function make();
}

class DeveloperFactory implements WorkerFactory
{
    public static function make(): Worker
    {
        return new Developer();
    }
}

class DesignerFactory implements WorkerFactory
{
    public static function make(): Worker
    {
        return new Designer();
    }
}

class TesterFactory implements WorkerFactory
{
    public static function make(): Worker
    {
        return new Tester();
    }
}

$developerFactory = DeveloperFactory::make();
$designerFactory = DesignerFactory::make();
$testerFactory = TesterFactory::make();

$designerFactory->work();
$designerFactory->work();
$testerFactory->work();

