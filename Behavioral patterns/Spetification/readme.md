## 🧪 Паттерн Specification на PHP  
_Спецификация_

## 🧠 Описание

Паттерн **Specification** (**Спецификация**) — это **_поведенческий_** паттерн проектирования, который позволяет описывать бизнес-правила и условия в виде объектов. Это позволяет создавать сложные составные условия, проверки и фильтры, а также изолировать логику проверок от основной бизнес-логики.

## ⚡ В двух словах
Каждое правило — это отдельный объект, их можно комбинировать.

## 🧩 Пример использования в PHP

- ✅ Определите интерфейс `Specification`, представляющий условия:
```php
<?php

interface Specification
{
    public function isSatisfiedBy(Item $item): bool;
}
```

- ✅ Создайте конкретные классы, реализующие интерфейс `Specification`, для описания условий:
```php
<?php

class PriceSpecification implements Specification
{
    private float $maxPrice;

    public function __construct(float $maxPrice)
    {
        $this->maxPrice = $maxPrice;
    }

    public function isSatisfiedBy(Item $item): bool
    {
        return $item->getPrice() <= $this->maxPrice;
    }
}

class ColorSpecification implements Specification
{
    private string $color;

    public function __construct(string $color)
    {
        $this->color = $color;
    }

    public function isSatisfiedBy(Item $item): bool
    {
        return $item->getColor() === $this->color;
    }
}
```
- ✅ Создайте класс `Item`, который будет подвергаться проверкам:
```php
<?php

class Item
{
    private $price;
    private $color;

    public function __construct(float $price, string $color)
    {
        $this->price = $price;
        $this->color = $color;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getColor(): string
    {
        return $this->color;
    }
}
```

- ✅ Теперь вы можете комбинировать условия с помощью паттерна Specification:
```php
<?php

$item = new Item(20.0, "red");

$specification = new PriceSpecification(30.0);

if ($specification->isSatisfiedBy($item)) {
    echo "Item meets price specification.\n";
} else {
    echo "Item doesn't meet price specification.\n";
}

$specification = new ColorSpecification("red");

if ($specification->isSatisfiedBy($item)) {
    echo "Item meets color specification.\n";
} else {
    echo "Item doesn't meet color specification.\n";
}
```

## ✅ Преимущества

- Позволяет описывать сложные бизнес-правила и условия в виде объектов.
- Улучшает читаемость и модульность кода.

## ⚠️ Недостатки

- В случае большого количества спецификаций может потребоваться создание большого количества классов.
