<?php

abstract class Registry
{
    private static array $services = [];

    final public static function setService(int|string $key, Service $service): void
    {
        self::$services[$key] = $service;
    }

    final public static function getService(int|string $key): Service|string
    {
        if (isset(self::$services[$key])) {
            return self::$services[$key];
        }

        return "This service doesn't exist";
    }
}

class Service
{

}

$service = new Service();

Registry::setService(1, $service);

$service = Registry::getService(1);

var_dump($service);
