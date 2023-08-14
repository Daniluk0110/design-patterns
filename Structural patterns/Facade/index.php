<?php

class WorkerFacade
{
    private Developer $developer;
    private Designer $designer;

    public function __construct(Developer $developer, Designer $designer)
    {
        $this->developer = $developer;
        $this->designer = $designer;
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
        printf('start developer' . PHP_EOL);
    }
}

class Designer
{
    public function startDesign(): void
    {
        printf('stop design' . PHP_EOL);
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