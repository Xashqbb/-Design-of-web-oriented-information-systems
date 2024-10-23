<?php

// Інтерфейс AnimalInterface
interface AnimalInterface {
    public function getSpecies();
    public function getLegs();
    public function getOffspringCount();
}

// Клас для собаки
class Dog implements AnimalInterface {
    private $species = "Dog";
    private $legs = 4;
    private $offspringCount;

    public function __construct($offspringCount) {
        $this->offspringCount = $offspringCount;
    }

    public function getSpecies() {
        return $this->species;
    }

    public function getLegs() {
        return $this->legs;
    }

    public function getOffspringCount() {
        return $this->offspringCount;
    }
}

// Клас для птаха
class Bird implements AnimalInterface {
    private $species = "Bird";
    private $legs = 2;
    private $offspringCount;

    public function __construct($offspringCount) {
        $this->offspringCount = $offspringCount;
    }

    public function getSpecies() {
        return $this->species;
    }

    public function getLegs() {
        return $this->legs;
    }

    public function getOffspringCount() {
        return $this->offspringCount;
    }
}

// Адаптер для тварин
class AnimalAdapter {
    private $animal;

    public function __construct(AnimalInterface $animal) {
        $this->animal = $animal;
    }

    public function getAnimalInfo() {
        return [
            'Species' => $this->animal->getSpecies(),
            'Legs' => $this->animal->getLegs(),
            'Offspring Count' => $this->animal->getOffspringCount()
        ];
    }
}

// Приклад використання

$dog = new Dog(5);
$bird = new Bird(3);

$dogAdapter = new AnimalAdapter($dog);
$birdAdapter = new AnimalAdapter($bird);

// Отримання інформації про тварин
$dogInfo = $dogAdapter->getAnimalInfo();
$birdInfo = $birdAdapter->getAnimalInfo();

echo "Dog Info: " . json_encode($dogInfo) . PHP_EOL;
echo "Bird Info: " . json_encode($birdInfo) . PHP_EOL;

?>
