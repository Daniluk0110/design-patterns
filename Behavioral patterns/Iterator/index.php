<?php

class WorkerList
{
    private array $list = [];
    private int $index = 0;

    public function getIndex(): int
    {
        return $this->index;
    }

    public function setIndex(int $index): void
    {
        $this->index = $index;
    }

    public function getList(): array
    {
        return $this->list;
    }

    public function setList(array $list): void
    {
        $this->list = $list;
    }

    public function getItem($key): ?Worker
    {
        if ($this->list[$key]) {
            return $key;
        }

        return null;
    }

    public function next(): void
    {
        if ($this->index < (count($this->list) -1)) {
            $this->index++;
        }
    }

    public function prev(): void
    {
        if ($this->index != 0) {
            $this->index--;
        }
    }

    public function refresh(): void
    {
        $this->index = 0;
    }

    public function getByIndex(): Worker
    {
        return $this->list[$this->index];
    }
}

class Worker
{
    private string $name = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

$worker = new Worker('Boris');
$worker2 = new Worker('Alex');
$worker3 = new Worker('Max');

$workerList = new WorkerList();
$workerList->setList([$worker, $worker2, $worker3]);

var_dump($workerList->getByIndex()->getName()); // Boris

$workerList->next();
var_dump($workerList->getByIndex()->getName()); // Alex

$workerList->next();
var_dump($workerList->getByIndex()->getName()); // Max

$workerList->prev();
var_dump($workerList->getByIndex()->getName()); // Alex