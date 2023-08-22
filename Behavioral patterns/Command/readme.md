# Паттерн Command на PHP

![](https://refactoring.guru/images/patterns/content/command/command-en.png)

# Аналогия из жизни
![](https://refactoring.guru/images/patterns/content/command/command-comic-1.png)
Пример заказа в ресторане.  
Вы заходите в ресторан и садитесь у окна. К вам подходит вежливый официант и принимает заказ, записывая все пожелания в блокнот. Откланявшись, он уходит на кухню, где вырывает лист из блокнота и клеит на стену. Далее лист оказывается в руках повара, который читает содержание заказа и готовит заказанные блюда.
  
В этом примере вы являетесь отправителем, официант с блокнотом — командой, а повар — получателем. Как и в паттерне, вы не соприкасаетесь напрямую с поваром. Вместо этого вы отправляете заказ с официантом, который самостоятельно «настраивает» повара на работу. С другой стороны, повар не знает, кто конкретно послал ему заказ. Но это ему безразлично, так как вся необходимая информация есть в листе заказа.

# Описание

Паттерн **Command** (**Команда**) — это **_поведенческий_** паттерн проектирования, который позволяет инкапсулировать запросы или операции в отдельных объектах. Это позволяет параметризовать клиентов с различными запросами, откладывать выполнение команд или ставить их в очередь, а также поддерживать отмену операций.

# Пример использования в PHP

* Создайте интерфейс Command, который будет определять метод выполнения команды:
```php
<?php

interface Command
{
    public function execute(): void;
}
```

* Реализуйте классы, представляющие конкретные команды:
```php
<?php

class Light
{
    public function turnOn(): void
    {
        echo "Light is on\n";
    }

    public function turnOff(): void
    {
        echo "Light is off\n";
    }
}

class LightOnCommand implements Command
{
    private $light;

    public function __construct(Light $light)
    {
        $this->light = $light;
    }

    public function execute(): void
    {
        $this->light->turnOn();
    }
}

class LightOffCommand implements Command
{
    private $light;

    public function __construct(Light $light)
    {
        $this->light = $light;
    }

    public function execute(): void
    {
        $this->light->turnOff();
    }
}
```

* Создайте класс RemoteControl, который будет использовать команды для управления устройствами:
```php
<?php

class RemoteControl
{
    private $commands = [];

    public function setCommand(int $slot, Command $command): void
    {
        $this->commands[$slot] = $command;
    }

    public function pressButton(int $slot): void
    {
        if (isset($this->commands[$slot])) {
            $this->commands[$slot]->execute();
        }
    }
}
```

* Теперь вы можете использовать паттерн Command для управления устройствами через пульт:
```php
<?php

// Пример использования
$remote = new RemoteControl();
$light = new Light();

$lightOnCommand = new LightOnCommand($light);
$lightOffCommand = new LightOffCommand($light);

$remote->setCommand(0, $lightOnCommand);
$remote->setCommand(1, $lightOffCommand);

$remote->pressButton(0); // Output: Light is on
$remote->pressButton(1); // Output: Light is off
```

## Преимущества
* Инкапсулирует запросы или операции в объектах, что упрощает их обработку.
* Позволяет откладывать выполнение, ставить команды в очередь и поддерживать отмену операций.

## Недостатки
* Может привести к увеличению числа классов, так как требует создания классов для каждой команды.