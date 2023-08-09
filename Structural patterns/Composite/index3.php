<?php

abstract class AnalysisComponent
{
    abstract public function calculateRating();
}

class SingleAnalysis extends AnalysisComponent
{
    private int $rating;

    public function __construct(int $rating)
    {
        $this->rating = $rating;
    }

    public function calculateRating(): int
    {
        return $this->rating;
    }
}

class CompositeAnalysis extends AnalysisComponent
{
    private array $components = [];

    public function addComponent(AnalysisComponent $component): void
    {
        $this->components[] = $component;
    }

    public function calculateRating(): int
    {
        $totalRating = 0;

        foreach ($this->components as $component) {
            $totalRating += $component->calculateRating();
        }

        if ($totalRating > 100) {
            $totalRating = 100;
        }

        return $totalRating;
    }
}

// Создание отдельных анализов
$analysis1 = new SingleAnalysis(20);
$analysis2 = new SingleAnalysis(30);
$analysis3 = new SingleAnalysis(50);
$analysis4 = new SingleAnalysis(50);

// Создание составного анализа с поданализами
$compositeAnalysis = new CompositeAnalysis();
$compositeAnalysis->addComponent($analysis1);
$compositeAnalysis->addComponent($analysis2);
$compositeAnalysis->addComponent($analysis3);
$compositeAnalysis->addComponent($analysis4);

// Расчет рейтинга для всей структуры
$totalRating = $compositeAnalysis->calculateRating();
echo "Total Rating: " . $totalRating;
