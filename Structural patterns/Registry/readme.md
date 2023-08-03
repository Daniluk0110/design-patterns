# Паттерн Registry (Реестр)

# Описание

Паттерн Registry (Реестр) — это паттерн проектирования, который предоставляет единое место для хранения и доступа к объектам или сервисам в приложении. Реестр действует как глобальное хранилище, где объекты могут быть зарегистрированы под уникальными ключами и затем извлечены из реестра в любой части приложения. Этот паттерн упрощает управление зависимостями и обеспечивает единое место для доступа к общим ресурсам.

## Пример использования в PHP

- Создайте класс Registry, который будет представлять реестр объектов:
```php
<?php

class Registry {
    private static $instances = [];

    final public static function setInstance(string $key, $instance): void {
        self::$instances[$key] = $instance;
    }

    final public static function getInstance(string $key) {
        if (!isset(self::$instances[$key])) {
            throw new Exception("Instance not found in registry: $key");
        }

        return self::$instances[$key];
    }

    final public static function hasInstance(string $key): bool {
        return isset(self::$instances[$key]);
    }
}
```

- Создайте классы, которые будут регистрироваться в реестре:
```php
<?php

class Logger {
    public function log(string $message): void {
        echo "Logging: $message" . PHP_EOL;
    }
}

class Database {
    public function query(string $sql): void {
        echo "Executing query: $sql" . PHP_EOL;
    }
}
```

- Теперь вы можете использовать паттерн Registry для регистрации и доступа к объектам:
```php
<?php

// Пример использования
$logger = new Logger();
$database = new Database();

// Регистрируем объекты в реестре
Registry::setInstance('logger', $logger);
Registry::setInstance('database', $database);

// Получаем объекты из реестра
$loggerFromRegistry = Registry::getInstance('logger');
$databaseFromRegistry = Registry::getInstance('database');

// Используем объекты из реестра
$loggerFromRegistry->log('Hello, Registry!'); // Output: Logging: Hello, Registry!
$databaseFromRegistry->query('SELECT * FROM table'); // Output: Executing query: SELECT * FROM table
```

## Преимущества

* Упрощает управление зависимостями и обеспечивает единое место для доступа к общим ресурсам.
* Позволяет избежать глобальных переменных, что может уменьшить связанность между компонентами приложения.
* Облегчает отладку и тестирование, так как реестр может быть заменен на моки или заглушки.

## Недостатки

* Использование реестра может сделать код менее читаемым и усложнить отслеживание зависимостей.
* Злоупотребление паттерном Registry может привести к проблемам с производительностью и поддержкой кода, так как зависимости становятся менее очевидными.