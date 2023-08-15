# Паттерн Fluent Interface на PHP

# Описание

Паттерн **Fluent Interface** (**Интерфейс методов-цепочек**) — это паттерн проектирования, который позволяет создавать цепочки методов на объекте, чтобы обеспечить более выразительный и читаемый код. Цепочки методов могут быть использованы для последовательного вызова нескольких методов объекта.

## Пример использования в PHP

* Создайте класс, на который вы хотите применить паттерн Fluent Interface:
```php
<?php

class QueryBuilder
{
    private $query;

    public function select(string $columns): self
    {
        $this->query = "SELECT $columns";
        return $this;
    }

    public function from(string $table): self
    {
        $this->query .= " FROM $table";
        return $this;
    }

    public function where(string $condition): self
    {
        $this->query .= " WHERE $condition";
        return $this;
    }

    public function getQuery(): string
    {
        return $this->query;
    }
}
```

* Теперь вы можете использовать паттерн Fluent Interface для создания цепочек методов:
```php
<?php

// Пример использования
$queryBuilder = new QueryBuilder();
$query = $queryBuilder->select("name, age")
    ->from("users")
    ->where("age > 18")
    ->getQuery();

echo $query; // Output: SELECT name, age FROM users WHERE age > 18
```

## Преимущества

* Обеспечивает более выразительный и читаемый код за счет цепочек методов.
* Позволяет последовательно вызывать методы объекта, что уменьшает необходимость промежуточных переменных.

## Недостатки

* Может быть избыточным для простых случаев использования, где не требуется цепочка методов.
* Слишком длинные цепочки методов могут сделать код менее читаемым и поддерживаемым.