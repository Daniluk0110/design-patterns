<?php

class WorkerPool
{
    private array $freeWorkers = [];
    private array $busyWorkers = [];

    public function getWorker(): Worker
    {
        if (count($this->freeWorkers) == 0) {
            $worker = new Worker();
        } else {
            // Будет присвоен переменной и удалён из массива
            $worker = array_pop($this->freeWorkers);
        }

        $this->busyWorkers[spl_object_hash($worker)] = $worker;

        return $worker;
    }

    public function release(Worker $worker)
    {
        $key = spl_object_hash($worker);

        if (isset($this->busyWorkers[$key])) {
            unset($this->busyWorkers[$key]);
            $this->freeWorkers[$key] = $worker;
        }
    }

    /**
     * @return array
     */
    public function getFreeWorkers(): array
    {
        return $this->freeWorkers;
    }

    /**
     * @return array
     */
    public function getBusyWorkers(): array
    {
        return $this->busyWorkers;
    }
}

class Worker
{
    public function work(): void
    {
        printf('Imm working');
    }
}

$pool = new WorkerPool();

$worker = $pool->getWorker();
$worker2 = $pool->getWorker();
$worker3 = $pool->getWorker();

$pool->release($worker3);

var_dump($pool->getFreeWorkers());
var_dump($pool->getBusyWorkers());