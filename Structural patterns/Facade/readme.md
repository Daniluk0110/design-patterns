# Паттерн Facade на PHP

![image](https://refactoring.guru/images/patterns/content/facade/facade.png)

# Описание
Паттерн **Facade** (**Фасад**) — это структурный паттерн проектирования, который предоставляет унифицированный интерфейс для набора интерфейсов в подсистеме. Фасад обеспечивает более простой и удобный способ взаимодействия клиента с комплексной системой, скрывая детали и сложности внутренних компонентов.

# Пример использования в PHP

* Создайте классы, представляющие сложную подсистему:
```php
<?php

class SubsystemA {
    public function operationA(): string {
        return "Subsystem A operation";
    }
}

class SubsystemB {
    public function operationB(): string {
        return "Subsystem B operation";
    }
}

class SubsystemC {
    public function operationC(): string {
        return "Subsystem C operation";
    }
}
```

* Создайте класс Facade, который предоставит унифицированный интерфейс для взаимодействия с подсистемой:
```php
<?php

class Facade {
    private $subsystemA;
    private $subsystemB;
    private $subsystemC;

    public function __construct() {
        $this->subsystemA = new SubsystemA();
        $this->subsystemB = new SubsystemB();
        $this->subsystemC = new SubsystemC();
    }

    public function operation(): string {
        $result = "Facade initializes subsystems:\n";
        $result .= $this->subsystemA->operationA() . "\n";
        $result .= $this->subsystemB->operationB() . "\n";
        $result .= $this->subsystemC->operationC() . "\n";
        return $result;
    }
}
```

* Теперь вы можете использовать паттерн Facade для упрощения взаимодействия с подсистемой:
```php
<?php

// Пример использования
$facade = new Facade();
echo $facade->operation();
```

## Преимущества

* Облегчает взаимодействие клиента с сложной системой, предоставляя более простой интерфейс.
* Скрывает детали и сложности внутренних компонентов, упрощая понимание системы.

## Недостатки

* Может привести к созданию "толстых" фасадов, которые знают слишком много о подсистеме.
* Может скрыть слишком много информации о внутренних компонентах, что может затруднить диагностику проблем.