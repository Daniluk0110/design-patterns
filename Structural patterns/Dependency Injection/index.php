<?php

class ControllerConfiguration
{
    public function __construct(private string $name, private string $action)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAction(): string
    {
        return $this->action;
    }
}

class Controller
{
    public function __construct(private ControllerConfiguration $controllerConfiguration)
    {
    }

    public function getConfiguration(): string
    {
        return $this->controllerConfiguration->getName() . '@' . $this->controllerConfiguration->getAction();
    }
}

$configuration = new ControllerConfiguration('PostController', 'index');
$configuration2 = new ControllerConfiguration('PostController', 'create');
$configuration3 = new ControllerConfiguration('TagController', 'update');

$controller = new Controller($configuration);
$controller2 = new Controller($configuration2);
$controller3 = new Controller($configuration3);

var_dump($controller->getConfiguration());
var_dump($controller2->getConfiguration());
var_dump($controller3->getConfiguration());