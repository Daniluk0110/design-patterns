# Паттерн Chain (CoR, Chain of Command, Chain of Responsibility, цепочка обязанностей) на PHP

![](https://refactoring.guru/images/patterns/content/chain-of-responsibility/chain-of-responsibility.png?id=56c10d0dc712546cc283cfb3fb463458)

## Аналогия из жизни
Пример общения с поддержкой
![](https://refactoring.guru/images/patterns/content/chain-of-responsibility/chain-of-responsibility-comic-1-ru.png?id=36f613d78baebc27d21d2a94deb3992f)
Вы купили новую видеокарту. Она автоматически определилась и заработала под Windows, но в вашей любимой Ubuntu «завести» её не удалось. Со слабой надеждой вы звоните в службу поддержки.  
Первым вы слышите голос автоответчика, предлагающий выбор из десятка стандартных решений. Ни один из вариантов не подходит, и робот соединяет вас с живым оператором.  
Увы, но рядовой оператор поддержки умеет общаться только заученными фразами и давать шаблонные ответы. После очередного предложения «выключить и включить компьютер» вы просите связать вас с настоящими инженерами.  
Оператор перебрасывает звонок дежурному инженеру, изнывающему от скуки в своей каморке. Уж он-то знает, как вам помочь! Инженер рассказывает вам, где скачать подходящие драйвера и как настроить их под Ubuntu. Запрос удовлетворён. Вы кладёте трубку.  
# Описание

Паттерн **Chain of Responsibility** (**Цепочка обязанностей**) — это **поведенческий** паттерн проектирования, который позволяет создавать цепочку обработчиков для запросов и передавать запрос по этой цепочке, пока один из обработчиков не обработает его. Это позволяет избежать прямой зависимости между отправителем запроса и получателем, а также дает возможность динамически изменять порядок обработчиков.

# Пример использования в PHP

* Создайте интерфейс Handler, представляющий обработчик запроса:
```php
<?php

interface Handler
{
    public function setNext(Handler $handler): Handler;
    public function handle(Request $request): ?string;
}
```

* Реализуйте классы, представляющие конкретные обработчики:
```php
<?php

class ConcreteHandlerA implements Handler
{
    private $nextHandler;

    public function setNext(Handler $handler): Handler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(Request $request): ?string
    {
        if ($request->getType() === 'A') {
            return "ConcreteHandlerA handled the request.";
        }

        if ($this->nextHandler !== null) {
            return $this->nextHandler->handle($request);
        }

        return null;
    }
}

class ConcreteHandlerB implements Handler
{
    private $nextHandler;

    public function setNext(Handler $handler): Handler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(Request $request): ?string
    {
        if ($request->getType() === 'B') {
            return "ConcreteHandlerB handled the request.";
        }

        if ($this->nextHandler !== null) {
            return $this->nextHandler->handle($request);
        }

        return null;
    }
}
```

* Создайте класс Request, представляющий запрос:
```php
<?php

class Request
{
    private $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
```

* Теперь вы можете создавать цепочку обработчиков и передавать запросы по этой цепочке:
```php
<?php

// Пример использования
$requestA = new Request('A');
$requestB = new Request('B');

$handlerA = new ConcreteHandlerA();
$handlerB = new ConcreteHandlerB();

$handlerA->setNext($handlerB);

$resultA = $handlerA->handle($requestA); // Output: ConcreteHandlerA handled the request.
$resultB = $handlerA->handle($requestB); // Output: ConcreteHandlerB handled the request.
```

## Преимущества

* Позволяет избежать прямой зависимости между отправителем запроса и получателем.
* Обеспечивает гибкость и возможность динамически изменять порядок обработчиков.

## Недостатки

* Могут возникнуть ситуации, когда запрос не будет обработан ни одним из обработчиков.