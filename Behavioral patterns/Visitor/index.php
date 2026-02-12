<?php

interface WorkerVisitor
{
    public function visitDeveloper(Worker $developer): void;
    public function visitDesigner(Worker $designer): void;
}

class RecorderVisitor implements WorkerVisitor
{
    private array $visited = [];

    public function getVisited(): array
    {
        return $this->visited;
    }

    public function visitDeveloper(Worker $developer): void
    {
        $this->visited[] = $developer;
    }

    public function visitDesigner(Worker $designer): void
    {
        $this->visited[] = $designer;
    }
}

interface Worker
{
    public function work(): void;
    public function accept(WorkerVisitor $visitor): void;
}

class Developer implements Worker
{
    public function work(): void
    {
        printf('developer is working' . PHP_EOL);
    }

    public function accept(WorkerVisitor $visitor): void
    {
        $visitor->visitDeveloper($this);
    }
}

class Designer implements Worker
{
    public function work(): void
    {
        printf('designer is working' . PHP_EOL);
    }

    public function accept(WorkerVisitor $visitor): void
    {
        $visitor->visitDesigner($this);
    }
}

$visitor = new RecorderVisitor();
$developer = new Developer();
$designer = new Designer();

$developer->accept($visitor);
$designer->accept($visitor);

var_dump($visitor->getVisited()); // array

foreach ($visitor->getVisited() as $worker) {
    $worker->work();
    // output: developer is working
    // output: designer is working
}
