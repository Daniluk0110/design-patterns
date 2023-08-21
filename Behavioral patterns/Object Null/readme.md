# Паттерн Object null (пустой Объект) на PHP

Для того, что бы можно было вызывать какой-то объект, не боясь, что там ничего нет.

# Описание

Паттерн **Null Object** (**Объект null**) — это **поведенческий** паттерн проектирования, который позволяет создать объект-заменитель для обработки случаев, когда ссылка на объект равна null. Null Object предоставляет альтернативу проверкам на null и помогает избежать исключений и неожиданного поведения.

# Пример использования в PHP

* Создайте интерфейс Logger, представляющий логгер:
```php
<?php

interface Logger
{
    public function log(string $message): void;
}
```

* Реализуйте классы, представляющие конкретные логгеры:
```php
<?php

class ConsoleLogger implements Logger
{
    public function log(string $message): void
    {
        echo "Console log: $message\n";
    }
}

class NullLogger implements Logger
{
    public function log(string $message): void
    {
        // Ничего не делать
    }
}
```

* Теперь вы можете использовать паттерн Null Object для избегания проверок на null:
```php
<?php

$userLogger = new ConsoleLogger(); // Можно также использовать NullLogger
$user = getUserFromDatabase(); // Получаем пользователя или null

if ($user) {
    $userLogger->log("User logged in: " . $user->getName());
} else {
    $userLogger->log("Guest visited the site.");
}
```

## Преимущества

* Избавляет от проверок на null, что улучшает читаемость кода.
* Позволяет избежать исключений, связанных с работой с null объектами.
* Обеспечивает более предсказуемое поведение программы.

## Недостатки

* Может привести к использованию объектов-заместителей, даже когда необходимо обработать реальный null.
* Может быть избыточным для некоторых случаев, когда проверка на null не является проблемой.