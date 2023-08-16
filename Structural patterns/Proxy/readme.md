# Паттерн Proxy (Заместитель) на PHP

![image](https://refactoring.guru/images/patterns/content/proxy/proxy.png?id=efece4647fb11e3f7539291796327666)

# Аналогия из жизни
![image](https://refactoring.guru/images/patterns/diagrams/proxy/live-example.png?id=a268c57fdaf073ee81cf4dfc7239eae2)
_Платёжной картой можно расплачиваться, как и наличными._

**Платёжная карточка** — это заместитель пачки наличных. И карточка, и наличные имеют общий интерфейс — ими можно оплачивать товары. Для покупателя польза в том, что не надо таскать с собой тонны наличных, а владелец магазина рад, что ему не нужно делать дорогостоящую инкассацию наличности в банк — деньги поступают к нему на счёт напрямую.

# Описание

Паттерн **Proxy** (**Заместитель**) — это структурный паттерн проектирования, который предоставляет объект-заместитель для другого объекта. Прокси контролирует доступ к оригинальному объекту, позволяя выполнить дополнительные действия перед или после обращения к нему.

# Пример использования в PHP

* Создайте интерфейс Subject, который представляет оригинальный объект и его интерфейс:
```php
<?php

interface Subject
{
    public function request(): string;
}
```

Реализуйте класс RealSubject, который представляет оригинальный объект:
```php
<?php

class RealSubject implements Subject
{
    public function request(): string
    {
        return "RealSubject: Handling request.";
    }
}
```

* Создайте класс Proxy, который предоставляет заместителя для оригинального объекта:
```php
<?php

class Proxy implements Subject
{
    private $realSubject;

    public function __construct(RealSubject $realSubject)
    {
        $this->realSubject = $realSubject;
    }

    public function request(): string
    {
        return "Proxy: Preprocessing request.\n" . $this->realSubject->request() . "\nProxy: Postprocessing request.";
    }
}
```

* Теперь вы можете использовать паттерн Proxy для добавления дополнительной функциональности к объектам:
```php
<?php

// Пример использования
$realSubject = new RealSubject();
$proxy = new Proxy($realSubject);

echo $proxy->request();
```

## Преимущества

* Позволяет добавить дополнительную функциональность к объекту без изменения его кода.
* Позволяет контролировать доступ к оригинальному объекту, что полезно для безопасности или логирования.

## Недостатки

* Увеличивает сложность системы, так как вводит дополнительный слой абстракции.
* Может увеличить количество классов в системе, особенно если требуется много прокси для разных объектов.