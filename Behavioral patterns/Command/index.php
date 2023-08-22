<?php

interface Command
{
    public function execute();
}

interface Undoable extends Command
{
    public function undo();
}

class Output
{
    private bool $isEnable = true;
    private string $body = '';

    public function enable(): void
    {
        $this->isEnable = true;
    }

    public function disable(): void
    {
        $this->isEnable = false;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function write(string $str): void
    {
        if ($this->isEnable) {
            $this->body = $str;
        }
    }
}

class Invoker
{
    private Command $command;

    public function run(): void
    {
        $this->command->execute();
    }

    public function setCommand(Command $command): void
    {
        $this->command = $command;
    }
}

class Message implements Command
{
    private Output $output;

    public function __construct(Output $output)
    {
        $this->output = $output;
    }

    public function execute(): void
    {
        $this->output->write('some string for execute');
    }
}

class ChangerStatus implements Undoable
{
    private Output $output;

    public function __construct(Output $output)
    {
        $this->output = $output;
    }

    public function execute(): void
    {
        $this->output->enable();
    }

    public function undo(): void
    {
        $this->output->disable();
    }
}

$output = new Output();
$invoker = new Invoker();
$message = new Message($output);

$statusChanger = new ChangerStatus($output);
$statusChanger->undo();
//$statusChanger->execute();
$message->execute();

var_dump($output->getBody());