# Паттерн Data Mapper на PHP


# Описание

Паттерн **Data Mapper** (**Отображение данных**) — это шаблон проектирования, который предоставляет отдельные объекты для сохранения и извлечения данных из источника данных (например, базы данных). Этот паттерн разделяет обязанности между объектами, представляющими бизнес-логику (доменные объекты) и объектами, отвечающими за взаимодействие с хранилищем данных.

# Пример использования в PHP

* Создайте класс доменного объекта User, который представляет данные, с которыми будет работать:

```php
<?php

class User
{
    private $id;
    private $username;
    private $email;

    public function __construct(int $id, string $username, string $email)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
    }

    // Геттеры и сеттеры...
}
```

* Создайте класс UserMapper, который будет отвечать за сохранение и извлечение данных о пользователе:

```php
<?php

class UserMapper {
    private $db;

    public function __construct(DatabaseConnection $db)
    {
        $this->db = $db;
    }

    public function findById(int $id): ?User
    {
        $data = $this->db->query("SELECT * FROM users WHERE id = ?", [$id]);
        if ($data) {
            return new User($data['id'], $data['username'], $data['email']);
        }
        return null;
    }

    // Другие методы для сохранения, обновления и удаления данных...
}
```

* Теперь вы можете использовать паттерн Data Mapper для работы с данными пользователя:
```php
<?php

// Пример использования
$db = new DatabaseConnection(/* параметры подключения к БД */);
$userMapper = new UserMapper($db);

$user = $userMapper->findById(1);
if ($user) {
    echo "User ID: " . $user->getId() . PHP_EOL;
    echo "Username: " . $user->getUsername() . PHP_EOL;
    echo "Email: " . $user->getEmail() . PHP_EOL;
} else {
    echo "User not found." . PHP_EOL;
}
```

## Преимущества

* Разделяет ответственность между доменными объектами и объектами отображения данных.
* Улучшает тестируемость, так как доменные объекты могут быть легко созданы и заполнены моками.
* Позволяет изолировать доменные объекты от деталей хранения данных.

## Недостатки

* Добавляет дополнительный слой абстракции и может увеличить количество классов в системе.
* Может быть избыточным для маленьких приложений с небольшим количеством сущностей.