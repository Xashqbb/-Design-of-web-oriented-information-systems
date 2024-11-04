<?php

abstract class AnimalHandler
{
    protected $nextHandler;

    public function setNext($handler)
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    abstract public function handle($animal);
}

class SpeciesHandler extends AnimalHandler
{
    public function handle($animal)
    {
        if (isset($animal['species'])) {
            echo "Видова назва: " . $animal['species'] . "\n";
        }
        if ($this->nextHandler) {
            $this->nextHandler->handle($animal);
        }
    }
}

class LimbsHandler extends AnimalHandler
{
    public function handle($animal)
    {
        if (isset($animal['limbs'])) {
            echo "Число кінцівок: " . $animal['limbs'] . "\n";
        }
        if ($this->nextHandler) {
            $this->nextHandler->handle($animal);
        }
    }
}

class OffspringHandler extends AnimalHandler
{
    public function handle($animal)
    {
        if (isset($animal['offspring'])) {
            echo "Число нащадків: " . $animal['offspring'] . "\n";
        }
        if ($this->nextHandler) {
            $this->nextHandler->handle($animal);
        }
    }
}

// Приклад використання
$speciesHandler = new SpeciesHandler();
$limbsHandler = new LimbsHandler();
$offspringHandler = new OffspringHandler();

$speciesHandler->setNext($limbsHandler)->setNext($offspringHandler);

// Інформація про тварину
$animal = [
    'species' => 'Лев',
    'limbs' => 4,
    'offspring' => 3
];

// Запуск обробки
$speciesHandler->handle($animal);
?>
