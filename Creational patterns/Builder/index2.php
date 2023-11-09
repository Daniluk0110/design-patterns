<?php

/*
 * Представьте, что вы находитесь у Харди и заказываете конкретную сделку, скажем, «Большой Харди»,
 * и они передают ее вам без каких-либо вопросов; это пример простой фабрики.
 * Но бывают случаи, когда логика создания может включать больше шагов. Например,
 * вы хотите индивидуальное предложение Subway, у вас есть несколько вариантов
 * приготовления гамбургера, например, какой хлеб вы хотите? какие соусы вы бы хотели?
 * Какой сыр вы бы хотели? и т. д. В таких случаях на помощь приходит паттерн-строитель.
 *
 *
 * Позволяет создавать различные варианты объекта, избегая при этом загрязнения конструктора.
 * Полезно, когда у объекта может быть несколько разновидностей.
 * Или когда создание объекта требует большого количества шагов.
*/

class Burger
{
    protected $size;

    protected bool $cheese = false;
    protected bool $pepperoni = false;
    protected bool $lettuce = false;
    protected bool $tomato = false;

    public function __construct(BurgerBuilder $builder)
    {
        $this->size = $builder->size;
        $this->cheese = $builder->cheese;
        $this->pepperoni = $builder->pepperoni;
        $this->lettuce = $builder->lettuce;
        $this->tomato = $builder->tomato;
    }
}

class BurgerBuilder
{
    public int $size;
    public bool $cheese = false;
    public bool $pepperoni = false;
    public bool $lettuce = false;
    public bool $tomato = false;

    public function __construct(int $size)
    {
        $this->size = $size;
    }

    public function addPepperoni(): BurgerBuilder
    {
        $this->pepperoni = true;
        return $this;
    }

    public function addLettuce(): BurgerBuilder
    {
        $this->lettuce = true;
        return $this;
    }

    public function addCheese(): BurgerBuilder
    {
        $this->cheese = true;
        return $this;
    }

    public function addTomato(): BurgerBuilder
    {
        $this->tomato = true;
        return $this;
    }

    public function build(): Burger
    {
        return new Burger($this);
    }
}

$burger = (new BurgerBuilder(14))
    ->addPepperoni()
    ->addLettuce()
    ->addTomato()
    ->build();

/*
 * Когда использовать?
 *
 * Когда может быть несколько разновидностей объекта и чтобы избежать телескопирования конструктора.
 * Ключевое отличие от фабричного шаблона заключается в том, что Шаблон фабрики следует использовать,
 * когда создание представляет собой одноэтапный процесс, а шаблон строителя
 * следует использовать, когда создание является многоэтапным процессом.
*/