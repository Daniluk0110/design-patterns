<?php

/*
 * Одновременно в стране может быть только один президент.
 * Тот же президент должен действовать всякий раз, когда того требует долг.
 * Президент здесь синглтон.
*/

final class President
{
    private static ?President $instance = null;

    private function __construct()
    {
        // Hide the constructor
    }

    public static function getInstance(): President
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __clone()
    {
        // Disable cloning
    }

    public function __wakeup(): void
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }
}

$president1 = President::getInstance();
$president2 = President::getInstance();

var_dump($president1 === $president2); // true
