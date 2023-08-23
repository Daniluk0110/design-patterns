<?php
/**
 * В компании работают джун, мидл и сеньёр.
 * Если джун или мидл не способен справится с задачей - передаёт дальше.
 */
abstract class Handler
{
    private null|Handler $successor;

    public function __construct(null|Handler $successor)
    {
        $this->successor = $successor;
    }

    final public function handle(TaskInterface $task): ?array
    {
        $processed = $this->processing($task);

        if ($processed === null && $this->successor) {
            $processed = $this->successor->handle($task);
        }

        return $processed;
    }

    abstract public function processing(TaskInterface $task): ?array;
}

interface TaskInterface
{
    public function getArray();
}

class DevTask implements TaskInterface
{
    private array $arr = [1, 2, 3];

    public function getArray(): array
    {
        return $this->arr;
    }
}

class Junior extends Handler
{
    public function processing(TaskInterface $task): ?array
    {
        return null;
    }
}

class Middle extends Handler
{
    public function processing(TaskInterface $task): ?array
    {
        return null;
    }
}

class Senior extends Handler
{
    public function processing(TaskInterface $task): ?array
    {
        return $task->getArray();
    }
}

$task = new DevTask();

$senior = new Senior(null);
$middle = new Middle($senior);
$junior = new Junior($middle);

var_dump($junior->handle($task));