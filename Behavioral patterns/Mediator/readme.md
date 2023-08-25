# Паттерн Mediator (Intermediary, Controller, Mediator, Посредник) на PHP

![](https://refactoring.guru/images/patterns/content/mediator/mediator.png?id=0264bd857a231b6ea2d0c537c092e698)
  
![](https://refactoring.guru/images/patterns/diagrams/mediator/solution1-en.png?id=dd991a5b7830de8d43f82b084e021713)  
**_Элементы интерфейса общаются через посредника._**

# Аналогия из жизни
![](https://refactoring.guru/images/patterns/diagrams/mediator/live-example.png?id=aa1de3cb7b63aa623e63578a1e43399a)  
Пилоты самолётов общаются не напрямую, а через диспетчера.  


Пилоты садящихся или улетающих самолётов не общаются напрямую с другими пилотами. Вместо этого они связываются с диспетчером, который координирует действия нескольких самолётов одновременно. Без диспетчера пилотам приходилось бы все время быть начеку и следить за всеми окружающими самолётами самостоятельно, а это приводило бы к частым катастрофам в небе.  

Важно понимать, что диспетчер не нужен во время всего полёта. Он задействован только в зоне аэропорта, когда нужно координировать взаимодействие многих самолётов.

# Применимость
* **Когда вам сложно менять некоторые классы из-за того, что они имеют множество хаотичных связей с другими классами.**
  Посредник позволяет поместить все эти связи в один класс, после чего вам будет легче их отрефакторить, сделать более понятными и гибкими.
*  **Когда вы не можете повторно использовать класс, поскольку он зависит от уймы других классов.**
   После применения паттерна компоненты теряют прежние связи с другими компонентами, а всё их общение происходит косвенно, через объект-посредник.
* **Когда вам приходится создавать множество подклассов компонентов, чтобы использовать одни и те же компоненты в разных контекстах.**
  Если раньше изменение отношений в одном компоненте могли повлечь за собой лавину изменений во всех остальных компонентах, то теперь вам достаточно создать подкласс посредника и поменять в нём связи между компонентами.

# Описание

Паттерн **Mediator** (**Посредник**) — это **поведенческий** паттерн проектирования, который предоставляет объект-посредник для управления взаимодействием множества объектов. Это позволяет уменьшить связанность между объектами и централизовать управление взаимодействием.

# Пример использования в PHP

Определите интерфейс Mediator, который будет определять методы для взаимодействия объектов:
```php
<?php

interface Mediator
{
    public function notify(Component $sender, string $event): void;
}
```

* Реализуйте класс ConcreteMediator, который будет представлять конкретный посредник:
```php
<?php

class ConcreteMediator implements Mediator
{
    private $component1;
    private $component2;

    public function setComponent1(Component1 $component): void
    {
        $this->component1 = $component;
    }

    public function setComponent2(Component2 $component): void
    {
        $this->component2 = $component;
    }

    public function notify(Component $sender, string $event): void
    {
        if ($sender === $this->component1) {
            echo "Component1 triggers event: $event\n";
            $this->component2->doSomething();
        } elseif ($sender === $this->component2) {
            echo "Component2 triggers event: $event\n";
            $this->component1->doSomething();
        }
    }
}
```

* Создайте классы Component1 и Component2, которые будут взаимодействовать через посредника:
```php
<?php

class Component1 extends Component {
    public function doSomething(): void {
        echo "Component1 does something\n";
        $this->mediator->notify($this, "event A");
    }
}

class Component2 extends Component {
    public function doSomething(): void {
        echo "Component2 does something\n";
        $this->mediator->notify($this, "event B");
    }
}
```

* Создайте базовый класс Component, который будет представлять базовый компонент:
```php
<?php

abstract class Component
{
    protected $mediator;

    public function setMediator(Mediator $mediator): void
    {
        $this->mediator = $mediator;
    }

    abstract public function doSomething(): void;
}
```

* Теперь вы можете использовать паттерн Mediator для управления взаимодействием объектов:
```php
<?php

$mediator = new ConcreteMediator();

$component1 = new Component1();
$component2 = new Component2();

$component1->setMediator($mediator);
$component2->setMediator($mediator);

$mediator->setComponent1($component1);
$mediator->setComponent2($component2);

$component1->doSomething(); // Output: Component1 does something, Component2 triggers event: event A
$component2->doSomething(); // Output: Component2 does something, Component1 triggers event: event B
```

## Преимущества

* Уменьшает связанность между объектами, так как управление взаимодействием централизовано.
* Улучшает расширяемость и обслуживаемость кода.
* Устраняет зависимости между компонентами, позволяя повторно их использовать.
* Упрощает взаимодействие между компонентами.
* Централизует управление в одном месте.

## Недостатки

* Посредник может стать единой точкой отказа, если он становится слишком сложным или перегруженным.
* Посредник может сильно раздуться.