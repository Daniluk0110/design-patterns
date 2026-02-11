<?php

// Абстрактный класс транспортного средства
abstract class Vehicle
{
    abstract public function drive(): void;
}

// Конкретный класс автомобиля
class Car extends Vehicle
{
    public function drive(): void
    {
        echo "Driving a car..." . PHP_EOL;
    }
}

// Конкретный класс велосипеда
class Bicycle extends Vehicle
{
    public function drive(): void
    {
        echo "Riding a bicycle..." . PHP_EOL;
    }
}

// Класс фабрики
class VehicleFactory
{
    public function createVehicle(string $type): Vehicle
    {
        return match ($type) {
            'car' => new Car(),
            'bicycle' => new Bicycle(),
            default => throw new InvalidArgumentException("Invalid vehicle type: $type"),
        };
    }
}

// Создаем фабрику
$factory = new VehicleFactory();

// Создаем автомобиль
$car = $factory->createVehicle('car');
$car->drive(); // Вывод: "Driving a car..."

// Создаем велосипед
$bicycle = $factory->createVehicle('bicycle');
$bicycle->drive(); // Вывод: "Riding a bicycle..."
