<?php

interface Door
{
    public function getDescription(): void;
}

class WoodenDoor implements Door
{
    public function getDescription(): void
    {
        echo 'I am a wooden door' . PHP_EOL;
    }
}

class IronDoor implements Door
{
    public function getDescription(): void
    {
        echo 'I am an iron door' . PHP_EOL;
    }
}

interface DoorFittingExpert
{
    public function getDescription(): void;
}

class Welder implements DoorFittingExpert
{
    public function getDescription(): void
    {
        echo 'I can only fit iron doors' . PHP_EOL;
    }
}

class Carpenter implements DoorFittingExpert
{
    public function getDescription(): void
    {
        echo 'I can only fit wooden doors' . PHP_EOL;
    }
}

/*
Now we have our abstract factory that would let us make family of related objects i.e.
wooden door factory would create a wooden door and wooden door fitting expert
and iron door factory would create an iron door and iron door fitting expert
*/

interface DoorFactory
{
    public function makeDoor(): Door;
    public function makeFittingExpert(): DoorFittingExpert;
}

// Wooden factory to return carpenter and wooden door
class WoodenDoorFactory implements DoorFactory
{
    public function makeDoor(): Door
    {
        return new WoodenDoor();
    }

    public function makeFittingExpert(): DoorFittingExpert
    {
        return new Carpenter();
    }
}

// Iron door factory to get iron door and the relevant fitting expert
class IronDoorFactory implements DoorFactory
{
    public function makeDoor(): Door
    {
        return new IronDoor();
    }

    public function makeFittingExpert(): DoorFittingExpert
    {
        return new Welder();
    }
}


$woodenFactory = new WoodenDoorFactory();

$door = $woodenFactory->makeDoor();
$expert = $woodenFactory->makeFittingExpert();

$door->getDescription();  // Output: I am a wooden door
$expert->getDescription(); // Output: I can only fit wooden doors

// Same for Iron Factory
$ironFactory = new IronDoorFactory();

$door = $ironFactory->makeDoor();
$expert = $ironFactory->makeFittingExpert();

$door->getDescription();  // Output: I am an iron door
$expert->getDescription(); // Output: I can only fit iron doors

/*
 * As you can see the wooden door factory has encapsulated the carpenter
 * and the wooden door also iron door factory has encapsulated the iron door
 * and welder. And thus it had helped us make sure that for
 * each of the created door, we do not get a wrong fitting expert.

 * When to use?

 * When there are interrelated dependencies with not-that-simple creation logic involved
*/