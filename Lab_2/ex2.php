<?php
// Базовий клас Тварина
class Animal {
    // Властивості
    public $species;
    public $limbs;
    public $offspring;

    // Конструктор класу
    public function __construct($species, $limbs, $offspring) {
        $this->species = $species;
        $this->limbs = $limbs;
        $this->offspring = $offspring;
    }
    // Деструктор класу
    public function __destruct() {
        echo "Об'єкт {$this->species} видалено.\n";
    }
    // Метод для виведення інформації про тварину
    public function displayInfo() {
        echo "Вид: {$this->species}\n";
        echo "Кількість кінцівок: {$this->limbs}\n";
        echo "Кількість потомків: {$this->offspring}\n";
    }
}

// Похідний клас Домашня Тварина
class Pet extends Animal {
    public $name;

    // Конструктор за замовчуванням
    public function __construct($name = "Безіменна", $species = "Невідомо", $limbs = 0, $offspring = 0) {
        parent::__construct($species, $limbs, $offspring);
        $this->name = $name;
    }
    // Деструктор класу
    public function __destruct() {
        echo "Домашню тварину {$this->name} видалено.\n";
    }
    // Метод для виведення інформації про домашню тварину
    public function displayInfo() {
        echo "Кличка: {$this->name}\n";
        parent::displayInfo(); // Виклик методу базового класу
    }
}

// Приклад використання
$animal = new Animal("Кіт", 4, 5);
$animal->displayInfo();

echo "\n";

$pet = new Pet("Шарік", "Собака", 4, 2);
$pet->displayInfo();

?>
