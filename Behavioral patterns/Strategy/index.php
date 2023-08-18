<?php

interface Definer
{
    public function define($arg);
}

class Data
{
    private Definer $definer;

    public function setArg(bool|int|string $arg): void
    {
        $this->arg = $arg;
    }
    private int|string|bool $arg;

    public function __construct(Definer $definer)
    {
        $this->definer = $definer;
    }

    public function executeStrategy(): string
    {
        return $this->definer->define($this->arg);
    }
}

class IntDefiner implements Definer
{

    public function define($arg): string
    {
        return $arg . ' from int strategy';
    }
}

class StringDefiner implements Definer
{

    public function define($arg): string
    {
        return $arg . ' from string strategy';
    }
}

class BoolDefiner implements Definer
{

    public function define($arg): string
    {
        return $arg . ' from bool strategy';
    }
}


$data = new Data(new IntDefiner());
$data->setArg('some arg for first');

$data2 = new Data(new StringDefiner());
$data2->setArg('some arg for first');

$data3 = new Data(new BoolDefiner());
$data3->setArg('some arg for first');


var_dump($data->executeStrategy());
var_dump($data2->executeStrategy());
var_dump($data3->executeStrategy());