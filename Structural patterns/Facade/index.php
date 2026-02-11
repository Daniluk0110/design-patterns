<?php

class WorkerFacade
{
    public function __construct(private readonly Developer $developer, private readonly Designer $designer)
    {
    }

    public function startWork(): void
    {
        $this->developer->startDevelop();
        $this->designer->startDesign();
    }

    public function stopWork(): void
    {
        $this->developer->stopDevelop();
        $this->designer->stopDesign();
    }
}

class Developer
{
    public function startDevelop(): void
    {
        printf('start developer' . PHP_EOL);
    }

    public function stopDevelop(): void
    {
        printf('stop developer' . PHP_EOL);
    }
}

class Designer
{
    public function startDesign(): void
    {
        printf('start design' . PHP_EOL);
    }

    public function stopDesign(): void
    {
        printf('stop design' . PHP_EOL);
    }
}

$developer = new Developer();
$designer = new Designer();

$worker = new WorkerFacade($developer, $designer);

$worker->startWork();
$worker->stopWork();
