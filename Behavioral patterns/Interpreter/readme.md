# Паттерн Interpreter (Интерпретатор) на PHP

# Описание

Паттерн **Interpreter** (**Интерпретатор**) — это **поведенческий** паттерн проектирования, который позволяет интерпретировать (переводить и выполнять) предложения определенного языка, представляя их в виде структуры данных. Он часто используется для создания языковых анализаторов и компиляторов.

# Пример использования в PHP

* Определите грамматику вашего языка в виде классов, представляющих терминальные и нетерминальные символы:
```php
<?php

interface Expression
{
    public function interpret(): int;
}

class Number implements Expression
{
    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function interpret(): int
    {
        return $this->value;
    }
}

class Add implements Expression
{
    private $left;
    private $right;

    public function __construct(Expression $left, Expression $right)
    {
        $this->left = $left;
        $this->right = $right;
    }

    public function interpret(): int
    {
        return $this->left->interpret() + $this->right->interpret();
    }
}
```

* Теперь вы можете создавать предложения и интерпретировать их с помощью паттерна Interpreter:
```php
<?php

// Пример использования
$expression = new Add(new Number(10), new Add(new Number(5), new Number(3)));
$result = $expression->interpret(); // Output: 18
```

## Преимущества

* Позволяет создавать сложные языки и грамматики и интерпретировать их.
* Упрощает создание анализаторов и компиляторов.

## Недостатки

* Может привести к созданию большого количества классов, особенно для сложных грамматик.