<?php

class Worker implements SplSubject
{
    private SplObjectStorage $observers;
    private string $name;

    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function changeName(string $name)
    {
        $this->name = $name;
        $this->notify();
    }
}

class WorkerObserver implements SplObserver
{
    private array $workers = [];

    public function getWorkers(): array
    {
        return $this->workers;
    }

    public function update(SplSubject $subject): void
    {
        $this->workers[] = clone $subject;
    }
}

$observer = new WorkerObserver();
$worker = new Worker();

$worker->attach($observer);
$worker->changeName('Boris');
$worker->changeName('Kate');
$worker->changeName('Denis');

var_dump($observer->getWorkers());