# Паттерн Dependency Injection на PHP

## Описание

Паттерн **Dependency Injection** (**Внедрение зависимости**) — это паттерн проектирования, который позволяет уменьшить связанность между классами, разделяя создание объектов и их использование. Вместо того чтобы класс самостоятельно создавать зависимые объекты, он получает их из внешнего источника (например, контейнера зависимостей). Это делает код более гибким, улучшает тестируемость и облегчает замену зависимостей.

## Пример использования в PHP

* Создайте класс Service, который будет зависеть от другого класса (например, Dependency):
```php
<?php

class Dependency {
    public function doSomething(): string {
        return "Doing something in Dependency";
    }
}

class Service {
    private $dependency;

    public function __construct(Dependency $dependency) {
        $this->dependency = $dependency;
    }

    public function doSomethingElse(): string {
        return "Doing something else in Service, and " . $this->dependency->doSomething();
    }
}
```

* Создайте класс Container, который будет использоваться для внедрения зависимостей:
```php
<?php

class Container {
    private $dependencies = [];

    public function addDependency(string $name, Closure $dependency): void {
        $this->dependencies[$name] = $dependency;
    }

    public function getDependency(string $name) {
        if (!isset($this->dependencies[$name])) {
            throw new Exception("Dependency not found: $name");
        }

        $dependency = $this->dependencies[$name];
        return $dependency();
    }
}
```

* Теперь вы можете использовать паттерн Dependency Injection для внедрения зависимостей в классы:
```php
<?php

// Пример использования
$container = new Container();

// Зарегистрируем зависимость Dependency в контейнере
$container->addDependency('dependency', function() {
    return new Dependency();
});

// Внедряем зависимость в класс Service
$service = new Service($container->getDependency('dependency'));
echo $service->doSomethingElse(); // Output: Doing something else in Service, and Doing something in Dependency
```

## Преимущества

* Уменьшает связанность между классами, что делает код более гибким и легче поддерживаемым.
* Облегчает тестирование, так как зависимости могут быть заменены на моки или заглушки.
* Упрощает внедрение сложных зависимостей, таких как базы данных или внешние сервисы.

## Недостатки

* Внедрение зависимостей может усложнить код, особенно для крупных проектов, где требуется управлять большим количеством зависимостей.
* Необходимость настройки контейнера зависимостей и регистрации зависимостей может привести к дополнительной сложности в начале работы с проектом.