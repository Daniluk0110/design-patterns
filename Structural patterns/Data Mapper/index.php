<?php

class Worker
{
    public function __construct(private string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function make(array $args): Worker
    {
        return new self($args['name']);
    }
}

class WorkerMapper
{
    private WorkerStorageAdapter $workerStorageAdapter;

    public function __construct(WorkerStorageAdapter $workerStorageAdapter)
    {
        $this->workerStorageAdapter = $workerStorageAdapter;
    }

    public function findById(int $id): Worker|string
    {
        $res = $this->workerStorageAdapter->find($id);

        if ($res === null) {
            return "Worker with this id doesn't exist";
        }

        return $this->make($res);
    }

    private function make(array $args): Worker
    {
        return Worker::make($args);
    }
}

class WorkerStorageAdapter
{
    private array $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function find(int $id): ?array
    {
        if (isset($this->data[$id])) {
            return $this->data[$id];
        }

        return null;
    }
}

$data = [
    1 => [
        'name' => 'Boris',
    ],
];

$workerStorageAdapter = new WorkerStorageAdapter($data);

$workerMapper = new WorkerMapper($workerStorageAdapter);

$worker = $workerMapper->findById(1);

var_dump($worker->getName());
