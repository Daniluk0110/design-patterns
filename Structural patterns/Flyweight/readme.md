# Паттерн Flyweight (Приспособленец, Кэш) на PHP

_Cмысл паттерна в том, что бы разгрузить память. Если объект есть, вы его используете. Если объекта нет, то вы его создаёте._

![image](https://refactoring.guru/images/patterns/content/flyweight/flyweight.png)


# Описание

Паттерн **Flyweight** (**Приспособленец**) — это структурный паттерн проектирования, который позволяет эффективно разделить объекты на разделяемые (внутреннее состояние) и неразделяемые (внешнее состояние) части. Это позволяет уменьшить объем памяти, используемой объектами.

# Пример использования в PHP

* Создайте интерфейс Flyweight, который будет представлять общий интерфейс для всех разделяемых объектов:
```php
<?php

interface Flyweight
{
    public function operation(string $externalState): string;
}
```

* Реализуйте класс ConcreteFlyweight, который представляет разделяемый объект:
```php
<?php

class ConcreteFlyweight implements Flyweight
{
    private $internalState;

    public function __construct(string $internalState)
    {
        $this->internalState = $internalState;
    }

    public function operation(string $externalState): string
    {
        return "ConcreteFlyweight: Internal [$this->internalState] External [$externalState]";
    }
}
```

* Создайте класс FlyweightFactory, который будет создавать и хранить разделяемые объекты:
```php
<?php

class FlyweightFactory
{
    private $flyweights = [];

    public function getFlyweight(string $internalState): Flyweight
    {
        if (!isset($this->flyweights[$internalState]))
        {
            $this->flyweights[$internalState] = new ConcreteFlyweight($internalState);
        }

        return $this->flyweights[$internalState];
    }
}
```

* Теперь вы можете использовать паттерн Flyweight для уменьшения потребления памяти:
```php
<?php

// Пример использования
$factory = new FlyweightFactory();
$flyweight1 = $factory->getFlyweight("state1");
$flyweight2 = $factory->getFlyweight("state2");

echo $flyweight1->operation("external1") . PHP_EOL;
echo $flyweight2->operation("external2") . PHP_EOL;
```

## Преимущества

* Позволяет уменьшить объем памяти, используемой разделяемыми объектами.
* Подходит для создания большого количества похожих объектов с общими частями.

## Недостатки

* Введение разделяемых объектов может усложнить код, так как требует дополнительной логики для разделения внутреннего и внешнего состояния.
* Не подходит для объектов, у которых внутреннее состояние сильно изменяется.