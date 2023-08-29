# Паттерн Observer (Издатель-Подписчик, Слушатель, Наблюдатель) на PHP

![](https://refactoring.guru/images/patterns/content/observer/observer.png)


# Проблема
Представьте, что вы имеете два объекта: **_Покупатель_** и **_Магазин_**. В магазин вот-вот должны завезти новый товар, который интересен покупателю.    

Покупатель может каждый день ходить в магазин, чтобы проверить наличие товара. Но при этом он будет злиться, без толку тратя своё драгоценное время.  
![](https://refactoring.guru/images/patterns/content/observer/observer-comic-1-ru.png)
Постоянное посещение магазина или спам?

С другой стороны, магазин может разослать спам каждому своему покупателю. Многих это расстроит, так как товар специфический, и не всем он нужен.  

Получается конфликт: либо покупатель тратит время на периодические проверки, либо магазин тратит ресурсы на бесполезные оповещения.  

# Аналогия из жизни

!()[https://refactoring.guru/images/patterns/content/observer/observer-comic-2-ru.png]
Подписка на газеты и их доставка.  
После того как вы оформили подписку на газету или журнал, вам больше не нужно ездить в супермаркет и проверять, не вышел ли очередной номер. Вместо этого издательство будет присылать новые номера по почте прямо к вам домой сразу после их выхода.  
Издательство ведёт список подписчиков и знает, кому какой журнал высылать. Вы можете в любой момент отказаться от подписки, и журнал перестанет вам приходить.  

# Описание

Паттерн **Observer** (**Наблюдатель**) — это **поведенческий** паттерн проектирования, который позволяет объектам подписываться на оповещения о изменениях состояния других объектов и автоматически получать обновления. Это позволяет создать слабую связанность между объектами и обеспечить реакцию на изменения без явной зависимости.

# Пример использования в PHP

* Определите интерфейс Observer, который будет определять метод для получения обновлений:
```php
<?php

interface Observer
{
    public function update(string $message): void;
}
```

* Реализуйте класс ConcreteObserver, который будет представлять конкретного наблюдателя:
```php
<?php

class ConcreteObserver implements Observer
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function update(string $message): void
    {
        echo "$this->name received message: $message\n";
    }
}
```

* Создайте класс Subject, который будет представлять субъект (объект, за которым наблюдают):
```php
<?php

class Subject
{
    private $observers = [];

    public function addObserver(Observer $observer): void
    {
        $this->observers[] = $observer;
    }

    public function removeObserver(Observer $observer): void
    {
        $index = array_search($observer, $this->observers);
        if ($index !== false) {
            unset($this->observers[$index]);
        }
    }

    public function notifyObservers(string $message): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($message);
        }
    }
}
```

* Теперь вы можете использовать паттерн Observer для наблюдения за изменениями состояния:
```php
<?php

// Пример использования
$subject = new Subject();

$observerA = new ConcreteObserver("Observer A");
$observerB = new ConcreteObserver("Observer B");

$subject->addObserver($observerA);
$subject->addObserver($observerB);

$subject->notifyObservers("Hello!"); 
// Output: Observer A received message: Hello!
// Output: Observer B received message: Hello!

$subject->removeObserver($observerB);

$subject->notifyObservers("Goodbye!");
// Output: Observer A received message: Goodbye!
```

## Преимущества

* Позволяет объектам реагировать на изменения состояния других объектов без явной зависимости.
* Улучшает расширяемость и обслуживаемость кода.
* Издатели не зависят от конкретных классов подписчиков и наоборот.
* Вы можете подписывать и отписывать получателей на лету. 
* Реализует принцип открытости/закрытости.

## Недостатки

* Наблюдатели могут не освобождаться автоматически, что может привести к утечкам памяти.
* Подписчики оповещаются в случайном порядке.