<?php

interface Interviewer
{
    public function askQuestions(): void;
}

class Developer implements Interviewer
{

    public function askQuestions(): void
    {
        echo 'Asking about design patterns!' . PHP_EOL;
    }
}

class CommunityExecutive implements Interviewer
{

    public function askQuestions(): void
    {
        echo 'Asking about community building' . PHP_EOL;
    }
}

abstract class HiringManager
{
    // Factory Method
    abstract protected function makeInterviewer(): Interviewer;

    public function takeInterview(): void
    {
        $interviewer = $this->makeInterviewer();
        $interviewer->askQuestions();
    }
}

class DevelopmentManager extends HiringManager
{
    protected function makeInterviewer(): Interviewer
    {
        return new Developer();
    }
}

class MarketingManager extends HiringManager
{
    protected function makeInterviewer(): Interviewer
    {
        return new CommunityExecutive();
    }
}

$devManager = new DevelopmentManager();
$devManager->takeInterview(); // Output: Asking about design patterns

$marketingManager = new MarketingManager();
$marketingManager->takeInterview(); // Output: Asking about community building.