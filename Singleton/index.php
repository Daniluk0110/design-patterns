<?php

final class Connection
{
    private static ?self $instance = null;
    private static string $name;

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
        // TODO: Implement __clone() method.
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