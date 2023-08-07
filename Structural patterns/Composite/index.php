<?php

interface Renderable
{
    public function render(): string;
}

class Mail implements Renderable
{
    private array $parts = [];
    
    public function render(): string
    {
        $result = '';

        foreach ($this->parts as $part) {
            $result .= $part->render();
        }

        return $result;
    }

    public function addPart(Renderable $part)
    {
        $this->parts[] = $part;
    }
}

abstract class Part
{
    private string $text;

    /**
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text . PHP_EOL;
    }
}

class Header extends Part implements Renderable
{

    public function render(): string
    {
        return $this->getText();
    }
}

class Body extends Part implements Renderable
{

    public function render(): string
    {
        return $this->getText();
    }
}

class Footer extends Part implements Renderable
{

    public function render(): string
    {
        return $this->getText();
    }
}

$mail = new Mail();

$mail->addPart(new Header('header'));
$mail->addPart(new Body('body'));
$mail->addPart(new Footer('footer'));

var_dump($mail->render());