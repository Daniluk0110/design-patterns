# Описание

Паттерн **Abstract Factory** (**Абстрактная фабрика**) — это порождающий паттерн проектирования, который предоставляет интерфейс для создания семейств взаимосвязанных или взаимозависимых объектов без указания их конкретных классов. Этот паттерн позволяет создавать объекты с определенными характеристиками, сохраняя при этом гибкость и уровень абстракции.

# Пример использования в PHP

Определите интерфейсы для создания абстрактных продуктов и абстрактных фабрик:
```php
<?php

interface AbstractProductA {
    public function usefulFunctionA(): string;
}

interface AbstractProductB {
    public function usefulFunctionB(): string;
}

interface AbstractFactory {
    public function createProductA(): AbstractProductA;
    public function createProductB(): AbstractProductB;
}
```

Реализуйте конкретные классы продуктов:
```php
<?php

class ConcreteProductA1 implements AbstractProductA {
    public function usefulFunctionA(): string {
        return "The result of the product A1.";
    }
}

class ConcreteProductA2 implements AbstractProductA {
    public function usefulFunctionA(): string {
        return "The result of the product A2.";
    }
}

class ConcreteProductB1 implements AbstractProductB {
    public function usefulFunctionB(): string {
        return "The result of the product B1.";
    }
}

class ConcreteProductB2 implements AbstractProductB {
    public function usefulFunctionB(): string {
        return "The result of the product B2.";
    }
}
```

Реализуйте конкретные классы фабрик, которые создают семейства продуктов:
```php
<?php

class ConcreteFactory1 implements AbstractFactory {
    public function createProductA(): AbstractProductA {
        return new ConcreteProductA1();
    }

    public function createProductB(): AbstractProductB {
        return new ConcreteProductB1();
    }
}

class ConcreteFactory2 implements AbstractFactory {
    public function createProductA(): AbstractProductA {
        return new ConcreteProductA2();
    }

    public function createProductB(): AbstractProductB {
        return new ConcreteProductB2();
    }
}
```

Теперь вы можете использовать паттерн Abstract Factory для создания семейств объектов:
```php
<?php

// Пример использования
function clientCode(AbstractFactory $factory) {
    $productA = $factory->createProductA();
    $productB = $factory->createProductB();

    echo $productA->usefulFunctionA() . "\n";
    echo $productB->usefulFunctionB() . "\n";
}

$factory1 = new ConcreteFactory1();
clientCode($factory1);
// Output:
// The result of the product A1.
// The result of the product B1.

$factory2 = new ConcreteFactory2();
clientCode($factory2);
// Output:
// The result of the product A2.
// The result of the product B2.
```

## Преимущества

Позволяет создавать семейства взаимосвязанных объектов без указания их конкретных классов.
Поддерживает принцип инверсии зависимостей.

## Недостатки

Увеличивает сложность кода, так как требует создания большого числа интерфейсов и классов.