# Паттерн Memento (Хранитель, Снимок) на PHP

Позволяет сохранять и восстанавливать предыдущие состояния объектов без раскрытия реализации.

![](https://refactoring.guru/images/patterns/content/memento/memento-ru.png)

#  Проблема
Предположим, что вы пишете программу текстового редактора. Помимо обычного редактирования, ваш редактор позволяет менять форматирование текста, вставлять картинки и прочее.  
  
В какой-то момент вы решили сделать все эти действия отменяемыми. Для этого вам нужно сохранять текущее состояние редактора перед тем, как выполнить любое действие. Если потом пользователь решит отменить своё действие, вы достанете копию состояния из истории и восстановите старое состояние редактора.

![](https://refactoring.guru/images/patterns/diagrams/memento/problem1-ru.png)

Перед выполнением команды вы можете сохранить копию состояния редактора, чтобы потом иметь возможность отменить операцию.  

# Применимость
- Когда вам нужно сохранять мгновенные снимки состояния объекта (или его части), чтобы впоследствии объект можно было восстановить в том же состоянии.
  _Паттерн **Снимок** позволяет создавать любое количество снимков объекта и хранить их, независимо от объекта, с которого делают снимок. Снимки часто используют не только для реализации операции отмены, но и для транзакций, когда состояние объекта нужно «откатить», если операция не удалась._
-  Когда прямое получение состояния объекта раскрывает приватные детали его реализации, нарушая инкапсуляцию.  
   _Паттерн предлагает изготовить снимок самому исходному объекту, поскольку ему доступны все поля, даже приватные._

# Описание

Паттерн **Memento** (**Снимок**) — это **_поведенческий_** паттерн проектирования, который позволяет сохранять внутреннее состояние объекта так, чтобы в дальнейшем можно было восстановить объект в этом состоянии. Это позволяет реализовать откат к предыдущему состоянию или создавать "моментальные снимки" для будущего восстановления.

# Пример использования в PHP

* Создайте класс Memento, представляющий снимок состояния:
```php
<?php

class Memento
{
    private $state;

    public function __construct(string $state)
    {
        $this->state = $state;
    }

    public function getState(): string
    {
        return $this->state;
    }
}
```

* Реализуйте класс Originator, который будет иметь внутреннее состояние и создавать снимки:
```php
<?php

class Originator
{
    private $state;

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function createMemento(): Memento
    {
        return new Memento($this->state);
    }

    public function restoreMemento(Memento $memento): void
    {
        $this->state = $memento->getState();
    }
}
```

* Создайте класс Caretaker, который будет управлять снимками:
```php
<?php

class Caretaker
{
    private $mementos = [];

    public function addMemento(Memento $memento): void
    {
        $this->mementos[] = $memento;
    }

    public function getMemento(int $index): ?Memento
    {
        return $this->mementos[$index] ?? null;
    }
}
```

* Теперь вы можете использовать паттерн Memento для сохранения и восстановления состояния:
```php
<?php

// Пример использования
$originator = new Originator();
$caretaker = new Caretaker();

$originator->setState("State 1");
$caretaker->addMemento($originator->createMemento());

$originator->setState("State 2");
$caretaker->addMemento($originator->createMemento());

$originator->setState("State 3");

$lastMemento = $caretaker->getMemento(count($caretaker) - 1);
$originator->restoreMemento($lastMemento);

echo $originator->getState(); // Output: State 2
```

## Преимущества

* Позволяет сохранять и восстанавливать состояние объектов.
* Реализует откат к предыдущему состоянию.
* Не нарушает инкапсуляции исходного объекта.
* Упрощает структуру исходного объекта. Ему не нужно хранить историю версий своего состояния.

## Недостатки

* Требует много памяти, если клиенты слишком часто создают снимки.
* Может повлечь дополнительные издержки памяти, если объекты, хранящие историю, не освобождают ресурсы, занятые устаревшими снимками.
* В некоторых языках (например, PHP, Python, JavaScript) сложно гарантировать, чтобы только исходный объект имел доступ к состоянию снимка.