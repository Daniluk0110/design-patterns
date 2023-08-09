# Паттерн Bridge (Мост) на PHP

Похоже на даптер.

![image](https://refactoring.guru/images/patterns/content/bridge/bridge.png)

# Описание

Паттерн **Bridge** (**Мост**) — это **_структурный_** паттерн проектирования, который позволяет разделять абстракцию и реализацию так, чтобы они могли изменяться независимо друг от друга. Этот паттерн помогает избежать создания большого количества подклассов для каждой комбинации абстракции и реализации.

# Пример использования в PHP

* Создайте интерфейс Implementation, который представляет абстракцию:

```php
<?php

interface Implementation
{
    public function operationImplementation(): string;
}
```

* Реализуйте несколько классов, которые будут представлять конкретные реализации:

```php
<?php

class ConcreteImplementationA implements Implementation
{
    public function operationImplementation(): string
    {
        return "ConcreteImplementationA";
    }
}

class ConcreteImplementationB implements Implementation
{
    public function operationImplementation(): string
    {
        return "ConcreteImplementationB";
    }
}
```

* Создайте абстрактный класс Abstraction, который будет работать с интерфейсом Implementation:

```php
<?php

abstract class Abstraction
{
    protected Implementation $implementation;

    public function __construct(Implementation $implementation)
    {
        $this->implementation = $implementation;
    }

    abstract public function operation(): string;
}
```

* Реализуйте классы, наследующие абстрактный класс Abstraction и предоставляющие конкретные реализации:

```php
<?php

class RefinedAbstraction extends Abstraction
{
    public function operation(): string
    {
        return "RefinedAbstraction: " . $this->implementation->operationImplementation();
    }
}
```

* Теперь вы можете использовать паттерн Bridge для связывания абстракции и реализации:

```php
<?php

// Пример использования
$implementationA = new ConcreteImplementationA();
$abstractionA = new RefinedAbstraction($implementationA);
echo $abstractionA->operation() . PHP_EOL; // Output: RefinedAbstraction: ConcreteImplementationA

$implementationB = new ConcreteImplementationB();
$abstractionB = new RefinedAbstraction($implementationB);
echo $abstractionB->operation() . PHP_EOL; // Output: RefinedAbstraction: ConcreteImplementationB
```

# Преимущества

* Позволяет разделять абстракцию и реализацию, что облегчает добавление новых абстракций и реализаций независимо друг от друга.
* Уменьшает количество подклассов, которые нужно создавать для каждой комбинации абстракции и реализации.
* Поддерживает принцип открытости/закрытости (Open/Closed Principle).

# Недостатки

* Усложняет структуру кода, так как требует введения дополнительных абстракций и реализаций.