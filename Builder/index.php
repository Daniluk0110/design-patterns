<?php

class Operator
{
    /*
     *
    */
    public function make(Builder $builder): Message
    {
        $builder->makeHeader();
        $builder->makeBody();
        $builder->makeFooter();
        $builder->makeCustom();

        return $builder->getText();
    }
}

interface Builder
{
    public function makeHeader();

    public function makeBody();

    public function makeFooter();

    public function makeCustom();

    public function getText();
}

class TextBuilder implements Builder
{
    private Message $message;

    public function make(): void
    {
        $this->message = new Message();
    }

    public function makeHeader(): void
    {
        $this->message->setPart(new Header('Header line'));
    }

    public function makeBody(): void
    {
        $this->message->setPart(new Body('Body line'));
    }

    public function makeFooter(): void
    {
        $this->message->setPart(new Footer('Footer line'));
    }

    public function makeCustom(): void
    {
        $this->message->setPart(new Custom('Custom line'));
    }

    public function getText(): Message
    {
        return $this->message;
    }
}

class Section
{
    public function __construct(private string $text)
    {
    }

    public function __toString(): string
    {
        return $this->text;
    }
}

class Header extends Section
{

}

class Body extends Section
{

}

class Footer extends Section
{

}

class Custom extends Section
{

}

class Message
{
    private string $text = '';

    public function setPart($part): void
    {
        $this->text .= $part . PHP_EOL;
    }

    public function getText(): string
    {
        return $this->text;
    }
}

$operator = new Operator();

$builder = new TextBuilder();
$builder->make();
$message = $operator->make($builder);

var_dump($message->getText());