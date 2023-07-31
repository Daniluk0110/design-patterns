# Паттерн Builder (Строитель) на PHP

# Описание

Паттерн **Builder** (Строитель) — это порождающий паттерн проектирования, который позволяет создавать сложные объекты, шаг за шагом, используя один и тот же строительный процесс. Этот паттерн отделяет конструирование сложного объекта от его представления, что позволяет создавать различные представления объекта, используя один и тот же строительный процесс.

## **_Пример использования в PHP_**
- Создайте интерфейс Builder, который определяет методы для пошагового создания объекта:
```php
<?php

interface Builder {
    public function buildPartA(): void;
    public function buildPartB(): void;
    public function getResult(): Product;
}
```

- Реализуйте классы, которые будут представлять конкретные строители. Каждый класс строителя реализует интерфейс Builder, и предоставляет методы для пошагового создания объекта:
```php
<?php

class ConcreteBuilder implements Builder {
    private $product;

    public function __construct() {
        $this->reset();
    }

    public function buildPartA(): void {
        $this->product->addPart('Part A');
    }

    public function buildPartB(): void {
        $this->product->addPart('Part B');
    }

    public function getResult(): Product {
        $result = $this->product;
        $this->reset();
        return $result;
    }

    public function reset(): void {
        $this->product = new Product();
    }
}
```

- Создайте класс Product, который представляет сложный объект, созданный с помощью строителя:
```php
<?php

class Product {
    private $parts = [];

    public function addPart(string $part): void {
        $this->parts[] = $part;
    }

    public function listParts(): void {
        echo "Product parts: " . implode(', ', $this->parts) . PHP_EOL;
    }
}
```

- Создайте класс Director, который управляет процессом создания объекта с помощью строителя:
```php
<?php

class Director {
    private $builder;

    public function setBuilder(Builder $builder): void {
        $this->builder = $builder;
    }

    public function buildMinimalProduct(): void {
        $this->builder->buildPartA();
    }

    public function buildFullProduct(): void {
        $this->builder->buildPartA();
        $this->builder->buildPartB();
    }
}
```

Теперь вы можете использовать паттерн Builder для создания сложных объектов шаг за шагом:
```php
<?php

// Пример использования
$director = new Director();
$builder = new ConcreteBuilder();

// Строитель, создающий минимальный продукт
$director->setBuilder($builder);
$director->buildMinimalProduct();
$product = $builder->getResult();
$product->listParts(); // Output: Product parts: Part A

// Строитель, создающий полный продукт
$director->setBuilder($builder);
$director->buildFullProduct();
$product = $builder->getResult();
$product->listParts(); // Output: Product parts: Part A, Part B
```

## Преимущества

* Упрощает процесс создания сложных объектов.
* Разделяет конструирование и представление объекта, позволяя создавать различные представления объекта.
* Изолирует код, который отвечает за создание объектов, от кода, который использует объекты. 

## Недостатки

* Может увеличить количество классов в системе, особенно если объект имеет много различных представлений.
* Необходимо правильно настроить строитель для каждого типа объекта, что может потребовать дополнительной работы и поддержки.