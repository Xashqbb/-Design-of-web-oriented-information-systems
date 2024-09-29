<?php
// Абстрактний клас Тварина
abstract class Animal {
    protected $speciesName;
    protected $numberOfLimbs;
    protected $numberOfOffspring;

    public function __construct($speciesName, $numberOfLimbs, $numberOfOffspring) {
        $this->speciesName = $speciesName;
        $this->numberOfLimbs = $numberOfLimbs;
        $this->numberOfOffspring = $numberOfOffspring;
    }

    // Абстрактний метод
    abstract public function makeSound();

    public function getInfo() {
        return "Вид: $this->speciesName, Кінцівки: $this->numberOfLimbs, Нащадки: $this->numberOfOffspring";
    }
}

// Дочірній клас Ссавець
class Mammal extends Animal {
    private $furColor;

    public function __construct($speciesName, $numberOfLimbs, $numberOfOffspring, $furColor) {
        parent::__construct($speciesName, $numberOfLimbs, $numberOfOffspring);
        $this->furColor = $furColor;
    }

    public function makeSound() {
        echo "Ця тварина видає звук, характерний для ссавців.\n";
    }

    public function getFurColor() {
        return $this->furColor;
    }
}

// Дочірній клас Птах
class Bird extends Animal {
    private $wingSpan;

    public function __construct($speciesName, $numberOfLimbs, $numberOfOffspring, $wingSpan) {
        parent::__construct($speciesName, $numberOfLimbs, $numberOfOffspring);
        $this->wingSpan = $wingSpan;
    }

    public function makeSound() {
        echo "Ця тварина видає звук, характерний для птахів.\n";
    }

    public function getWingSpan() {
        return $this->wingSpan;
    }
}

// Приклад використання
$dog = new Mammal("Собака", 4, 5, "Коричневий");
echo $dog->getInfo() . "\n";
echo "Колір хутра: " . $dog->getFurColor() . "\n";
$dog->makeSound();

$eagle = new Bird("Орел", 2, 3, "2 метри");
echo $eagle->getInfo() . "\n";
echo "Розмах крил: " . $eagle->getWingSpan() . "\n";
$eagle->makeSound();
?>
