# Паттерн Pool (Бассейн)  на PHP

## Описание
Паттерн Pool (Бассейн) — это **порождающий** паттерн проектирования, который предоставляет пул объектов для повторного использования. Вместо создания нового объекта при необходимости, этот паттерн позволяет использовать и переиспользовать заранее созданные объекты из пула. Это может снизить накладные расходы на создание и уничтожение объектов, а также улучшить производительность.
Всегда будет два массива, где в одном объекты будут свободны, а другие будут заняты. Не важно, будут это рабочие или что-то другое. И их количество будут туда-сюда ходить.

# _**Пример использования в PHP**_

- Создайте класс ObjectPool, который представляет пул объектов:
```php
<?php

class ObjectPool {
    private $available = [];
    private $inUse = [];

    public function addObject($object): void {
        $key = spl_object_hash($object);
        $this->available[$key] = $object;
    }

    public function getObject(): ?object {
        if (empty($this->available)) {
            return null;
        }

        $object = array_pop($this->available);
        $this->inUse[spl_object_hash($object)] = $object;
        return $object;
    }

    public function releaseObject($object): void {
        $key = spl_object_hash($object);
        if (isset($this->inUse[$key])) {
            unset($this->inUse[$key]);
            $this->available[$key] = $object;
        }
    }
}
```

- Создайте класс ReusableObject, который будет использоваться в пуле:
```php
<?php

class ReusableObject {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function getData(): string {
        return $this->data;
    }
}
```

- Теперь вы можете использовать паттерн Pool для повторного использования объектов:
```php
<?php

// Пример использования
$pool = new ObjectPool();

// Создаем несколько объектов и добавляем их в пул
$object1 = new ReusableObject("Object 1");
$object2 = new ReusableObject("Object 2");
$pool->addObject($object1);
$pool->addObject($object2);

// Получаем объекты из пула и используем их
$objectA = $pool->getObject();
$objectB = $pool->getObject();
echo $objectA->getData() . PHP_EOL; // Output: Object 2
echo $objectB->getData() . PHP_EOL; // Output: Object 1

// Освобождаем объекты обратно в пул
$pool->releaseObject($objectA);
$pool->releaseObject($objectB);
```

## Преимущества

* Повторное использование объектов может снизить накладные расходы на создание и уничтожение объектов.
* Улучшает производительность при работе с ресурсоемкими объектами.
* Позволяет контролировать количество созданных объектов и избегать проблем с памятью.

## Недостатки

* Если пул объектов становится слишком большим, это может привести к ненужному потреблению памяти.
* Не все объекты могут быть легко повторно использованы, особенно если у них есть сложное состояние или внешние зависимости.