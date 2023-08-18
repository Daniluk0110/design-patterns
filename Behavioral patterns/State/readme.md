# Паттерн State (Состояние) на PHP

Отвечает за то, что у нас есть класса и у него есть несколько статусов.

![](https://refactoring.guru/images/patterns/content/state/state-ru.png)


# Аналогия из жизни

Ваш смартфон ведёт себя по-разному, в зависимости от текущего состояния:

* Когда телефон разблокирован, нажатие кнопок телефона приводит к каким-то действиям.
* Когда телефон заблокирован, нажатие кнопок приводит к экрану разблокировки.
* Когда телефон разряжен, нажатие кнопок приводит к экрану зарядки.


# Описание

Паттерн **State** (**Состояние**) — это **поведенческий** паттерн проектирования, который позволяет объектам менять свое поведение в зависимости от своего текущего состояния. Паттерн State представляет собой альтернативу длинным цепочкам условных операторов, позволяя вынести логику состояний в отдельные классы.

# Пример использования в PHP

* Создайте интерфейс State, представляющий состояния объекта:
```php
<?php

interface State
{
    public function handle(Context $context): void;
}
```

Реализуйте классы, представляющие конкретные состояния:
```php
<?php

class ConcreteStateA implements State
{
    public function handle(Context $context): void
    {
        echo "ConcreteStateA handles the request.\n";
        $context->setState(new ConcreteStateB());
    }
}

class ConcreteStateB implements State
{
    public function handle(Context $context): void
    {
        echo "ConcreteStateB handles the request.\n";
        $context->setState(new ConcreteStateA());
    }
}
```

* Создайте класс Context, который будет содержать объект состояния и делегировать ему работу:
```php
<?php

class Context
{
    private $state;

    public function setState(State $state): void
    {
        $this->state = $state;
    }

    public function request(): void
    {
        $this->state->handle($this);
    }
}
```

* Теперь вы можете использовать паттерн State для управления состоянием объекта:
```php
<?php

// Пример использования
$context = new Context();
$stateA = new ConcreteStateA();
$stateB = new ConcreteStateB();

$context->setState($stateA);
$context->request(); // Output: ConcreteStateA handles the request.

$context->setState($stateB);
$context->request(); // Output: ConcreteStateB handles the request.
```

## Преимущества

* Упрощает код объекта, так как переключение между состояниями происходит через объекты состояний.
* Обеспечивает четкую структуру и упорядоченность логики состояний.

## Недостатки

* Вводит дополнительные классы для каждого состояния, что может увеличить количество классов в системе.
* Может быть избыточным для простых объектов без сложной логики состояний.