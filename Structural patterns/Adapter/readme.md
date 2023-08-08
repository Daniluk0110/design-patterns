# Паттерн Adapter (адаптер) на PHP

[image](https://refactoring.guru/images/patterns/content/adapter/adapter-en.png)

# Описание

Паттерн **Adapter** (**Адаптер**) — это структурный паттерн проектирования, который позволяет объектам с несовместимыми интерфейсами работать вместе. Адаптер предоставляет промежуточный интерфейс, который переводит вызовы одного интерфейса в вызовы другого.

# Пример использования в PHP

* Создайте интерфейс Target, который представляет целевой интерфейс, к которому будут адаптированы другие интерфейсы:
```php
<?php

interface Target {
    public function request(): string;
}
```

* Создайте класс Adaptee, который представляет существующий интерфейс, который нужно адаптировать:
```php
<?php

class Adaptee {
    public function specificRequest(): string {
        return "Adaptee's specific request";
    }
}
```

* Реализуйте класс Adapter, который адаптирует интерфейс Adaptee к интерфейсу Target:
```php
<?php

class Adapter implements Target {
    private $adaptee;

    public function __construct(Adaptee $adaptee) {
        $this->adaptee = $adaptee;
    }

    public function request(): string {
        return "Adapter: " . $this->adaptee->specificRequest();
    }
}
```

* Теперь вы можете использовать паттерн Adapter для адаптирования интерфейсов и их взаимодействия:
```php
<?php

// Пример использования
$adaptee = new Adaptee();
$adapter = new Adapter($adaptee);

echo $adaptee->specificRequest() . PHP_EOL; // Output: Adaptee's specific request
echo $adapter->request() . PHP_EOL; // Output: Adapter: Adaptee's specific request
```

# Преимущества

* Позволяет интегрировать старый код с новым без изменения существующего кода.
* Улучшает повторное использование компонентов, которые имеют несовместимые интерфейсы.
* Позволяет работать с различными классами через общий интерфейс.

# Недостатки

* Может увеличить количество классов в системе, особенно если требуется много адаптеров для разных классов.
* Может ухудшить производительность, так как вызовы проходят через дополнительный слой.