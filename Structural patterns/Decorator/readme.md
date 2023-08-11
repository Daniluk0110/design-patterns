# Паттерн Decorator на PHP

![image](https://refactoring.guru/images/patterns/content/decorator/decorator.png)

# Описание

Паттерн **Decorator** (**Декоратор**) — это структурный паттерн проектирования, который позволяет добавлять новое поведение объектам, не изменяя их код. Декоратор использует композицию объектов для динамического добавления функциональности в существующие объекты.

# Пример использования в PHP

* Создайте интерфейс Component, который представляет базовый компонент, к которому будут добавляться декораторы:
```php
<?php

interface Component
{
    public function operation(): string;
}
```

* Реализуйте конкретный компонент, к которому будут добавляться декораторы:
```php
<?php

class ConcreteComponent implements Component
{
    public function operation(): string
    {
        return "ConcreteComponent";
    }
}
```

* Создайте абстрактный класс Decorator, который будет представлять абстрактный декоратор:
```php
<?php

abstract class Decorator implements Component
{
    protected $component;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    abstract public function operation(): string;
}
```

* Реализуйте конкретные декораторы, которые добавляют функциональность к базовому компоненту:
```php
<?php

class ConcreteDecoratorA extends Decorator
{
    public function operation(): string
    {
        return "ConcreteDecoratorA(" . $this->component->operation() . ")";
    }
}

class ConcreteDecoratorB extends Decorator
{
    public function operation(): string
    {
        return "ConcreteDecoratorB(" . $this->component->operation() . ")";
    }
}
```

* Теперь вы можете использовать паттерн Decorator для добавления функциональности к объектам:
```php
<?php

// Пример использования
$component = new ConcreteComponent();
$decoratorA = new ConcreteDecoratorA($component);
$decoratorB = new ConcreteDecoratorB($decoratorA);

echo $decoratorB->operation(); // Output: ConcreteDecoratorB(ConcreteDecoratorA(ConcreteComponent))
```

## Преимущества

* Позволяет добавлять новое поведение объектам без изменения их кода.
* Обеспечивает гибкость и расширяемость, так как декораторы можно комбинировать в разных комбинациях.

## Недостатки

* Усложняет структуру кода, так как требует создания большого количества классов для каждой комбинации декораторов.
* Может сделать код менее читаемым и усложнить отслеживание порядка применения декораторов.