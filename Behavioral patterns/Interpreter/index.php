<?php

abstract class Expression
{
    abstract public function interpret(Context $context): bool;
}

class Context
{
    private array $worker = [];

    public function setWorker(string $worker): void
    {
        $this->worker[] = $worker;
    }

    public function lookUp($key): bool
    {
        if (isset($this->worker[$key])) {
            return $this->worker[$key];
        }

        return false;
    }
}

class VariableExp extends Expression
{
    private int $key;

    public function __construct(int $intKey)
    {
        $this->key = $intKey;
    }

    public function interpret(Context $context): bool
    {
        return $context->lookUp($this->key);
    }
}

class AndExp extends Expression
{
    private int $keyOne;
    private int $keyTwo;

    public function __construct(int $keyOne, int $keyTwo)
    {
        $this->keyOne = $keyOne;
        $this->keyTwo = $keyTwo;
    }

    public function interpret(Context $context): bool
    {
        return $context->lookUp($this->keyOne) && $context->lookUp($this->keyTwo);
    }
}

class OrExp extends Expression
{
    private int $keyOne;
    private int $keyTwo;

    public function __construct(int $keyOne, int $keyTwo)
    {
        $this->keyOne = $keyOne;
        $this->keyTwo = $keyTwo;
    }

    public function interpret(Context $context): bool
    {
        return $context->lookUp($this->keyOne) || $context->lookUp($this->keyTwo);
    }
}

$context = new Context();
$context->setWorker('Bob');
$context->setWorker('Boris');
$context->setWorker('Anna');

$varExp = new VariableExp(1);
$andExp = new AndExp(2, 4);
$orExp = new OrExp(2, 1);

var_dump($varExp->interpret($context)); //true
var_dump($andExp->interpret($context)); //false
var_dump($orExp->interpret($context)); //true