<?php

final class Connection
{
    private static ?self $instance = null;
    private static string $name;

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}