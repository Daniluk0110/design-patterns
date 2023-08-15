<?php

interface Mail
{
    public function render(): string;
}

abstract class TypeMail
{

    public function __construct(private string $text)
    {
    }

    public function getText(): string
    {
        return $this->text;
    }
}

class BusinessMail extends TypeMail implements Mail
{
    public function render(): string
    {
        return $this->getText() . ' from business mail';
    }
}

class JobMail extends TypeMail implements Mail
{
    public function render(): string
    {
        return $this->getText() . ' from job mail';
    }
}

class MailFactory
{
    private array $pool = [];

    public function getMail($id, $typeMail): Mail
    {
        if (!isset($this->pool[$id])) {
            $this->pool[$id] = $this->make($typeMail);
        }

        return $this->pool[$id];
    }

    private function make($typeMail): Mail
    {
        if ($typeMail === 'business') {
            return new BusinessMail('Business text');
        }

        return new JobMail('Job Text');
    }
}

$mailFactory = new MailFactory();
$mail = $mailFactory->getMail(10, 'business');
$mail2 = $mailFactory->getMail(12, 'job');

var_dump($mail->render());
var_dump($mail2->render());