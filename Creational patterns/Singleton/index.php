<?php

final class Connection
{
    private static ?self $instance = null;
    private static string $name;

    /**
     * Конструктор можно сделать скрытым или защищённым для предотвращения его прямого вызова.
     * В таком случае объект класса можно будет создать только с помощью статических методов.
     */
    private function __construct()
    {
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function setName(string $name): void
    {
        self::$name = $name;
    }

    public static function getName(): string
    {
        return self::$name;

    }

    protected function __clone(): void
    {
        throw new \Exception("Cannot clone a singleton.");
    }

    /**
     * @throws Exception
     */
    public function __wakeup(): void
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }
}

$connection = Connection::getInstance();
$connection::setName('connection1');

$connection2 = Connection::getInstance();

var_dump($connection2::getName());