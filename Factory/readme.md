# Паттерн Factory на PHP

## Описание
Паттерн Фабрика является **порождающим** паттерном проектирования, который предоставляет интерфейс для создания объектов, но оставляет подклассам решение о том, какие классы инстанцировать. Таким образом, Фабрика делегирует создание объектов своим подклассам, а несет ответственность за общий процесс создания объектов.

_Благодаря этому, код производства можно расширять, не трогая основной. Так, чтобы добавить поддержку нового продукта, вам нужно создать новый подкласс и определить в нём фабричный метод, возвращая оттуда экземпляр нового продукта._

## **_Пример использования в PHP_**

- Создайте интерфейс Product, который определяет общий интерфейс для всех продуктов:
```php
<?php

interface Product {
    public function operation(): string;
}
```

Реализуйте несколько классов-продуктов, которые реализуют интерфейс Product:
```php
<?php

class ConcreteProductA implements Product {
    public function operation(): string {
        return "ConcreteProductA";
    }
}

class ConcreteProductB implements Product {
    public function operation(): string {
        return "ConcreteProductB";
    }
}
```

Создайте интерфейс Creator, который объявляет метод для создания продуктов:
```php
<?php

interface Creator {
    public function factoryMethod(): Product;
}
```

Реализуйте несколько классов-создателей, которые реализуют интерфейс Creator и возвращают различные продукты:
```php
<?php

class ConcreteCreatorA implements Creator {
    public function factoryMethod(): Product {
        return new ConcreteProductA();
    }
}

class ConcreteCreatorB implements Creator {
    public function factoryMethod(): Product {
        return new ConcreteProductB();
    }
}
```

Теперь вы можете использовать паттерн Factory для создания продуктов, не завися от их конкретных классов:
```php
<?php

// Пример использования
function clientCode(Creator $creator) {
    $product = $creator->factoryMethod();
    return $product->operation();
}

// Создание продукта A с помощью Creator A
$creatorA = new ConcreteCreatorA();
echo clientCode($creatorA); // Output: ConcreteProductA

// Создание продукта B с помощью Creator B
$creatorB = new ConcreteCreatorB();
echo clientCode($creatorB); // Output: ConcreteProductB
```

## Преимущества

* Изолирует код, который создает объекты, от кода, который использует объекты.
* Позволяет гибко добавлять новые типы продуктов и создателей без изменения существующего кода.
* Поддерживает принцип открытости/закрытости (Open/Closed Principle).

## Недостатки

* Увеличивает количество классов в системе, что может усложнить структуру проекта.
* Создание сложных продуктов может потребовать много подклассов создателей и продуктов, что может привести к избыточности кода.