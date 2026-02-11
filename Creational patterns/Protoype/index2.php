<?php

class Sheep
{
    protected string $name;
    protected string $category;

    public function __construct(string $name, string $category = 'Mountain Sheep')
    {
        $this->name = $name;
        $this->category = $category;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function getCategory(): string
    {
        return $this->category;
    }
}

$original = new Sheep('Jolly');
echo $original->getName() . PHP_EOL; // Jolly
echo $original->getCategory() . PHP_EOL; // Mountain Sheep

// Clone and modify what is required
$cloned = clone $original;
$cloned->setName('Dolly');
echo $cloned->getName() . PHP_EOL; // Dolly
echo $cloned->getCategory() . PHP_EOL; // Mountain sheep
