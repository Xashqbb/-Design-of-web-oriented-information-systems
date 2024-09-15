<?php

class Animal {
    // Публічні поля
    public $species;    // Видова назва
    public $limbs;      // Число кінцівок
    public $offspring;  // Число нащадків

    // Приватне поле
    private $habitat;   // Середовище проживання

    // Конструктор для ініціалізації полів
    public function __construct($species, $limbs, $offspring, $habitat) {
        $this->species = $species;
        $this->limbs = $limbs;
        $this->offspring = $offspring;
        $this->habitat = $habitat;
    }

    // Метод для встановлення значень поля
    public function set($field, $value) {
        if(property_exists($this, $field)) {
            $this->$field = $value;
        } else {
            echo "Поле '$field' не існує.\n";
        }
    }

    // Метод для отримання значення поля
    public function get($field) {
        if(property_exists($this, $field)) {
            return $this->$field;
        } else {
            return "Поле '$field' не існує.\n";
        }
    }

    // Метод для виведення значень усіх полів
    public function show() {
        echo "Видова назва: " . $this->species . "\n";
        echo "Число кінцівок: " . $this->limbs . "\n";
        echo "Число нащадків: " . $this->offspring . "\n";
        echo "Середовище проживання: " . $this->getHabitat() . "\n";  // Виклик приватного методу
    }

    // Метод для пошуку за одним з полів
    public function search($field, $value) {
        if(property_exists($this, $field) && $this->$field == $value) {
            echo "Знайдено тварину з полем '$field', яке дорівнює '$value'.\n";
            return true;
        } else {
            echo "Тварину з полем '$field', яке дорівнює '$value', не знайдено.\n";
            return false;
        }
    }

    // Приватний метод для отримання середовища проживання
    private function getHabitat() {
        return $this->habitat;
    }

    // Метод для зміни середовища проживання (інкапсуляція)
    public function setHabitat($newHabitat) {
        $this->habitat = $newHabitat;
    }

    // Статичний метод для виведення масиву об'єктів
    public static function show_objects($animals) {
        foreach ($animals as $animal) {
            $animal->show();
            echo "-----------------------\n";
        }
    }
}

// Створення 3 об'єктів класу Animal
$animal1 = new Animal("Кіт лісовий", 4, 5, "Ліси та степи");
$animal2 = new Animal("Кіт домашній", 4, 3, "Домашні умови");
$animal3 = new Animal("Кіт безхатько", 3, 1, "Міські райони");

// Виведення кожного об'єкта
$animal1->show();
echo "=======================\n";
$animal2->show();
echo "=======================\n";
$animal3->show();
echo "=======================\n";

// Зміна середовища проживання (інкапсуляція)
$animal1->setHabitat("Гори");
$animal1->show();
echo "=======================\n";

// Створення масиву з 5 об'єктів
$animals = [
    new Animal("Пантера", 4, 2, "Савана"),
    new Animal("Медвідь бурий", 4, 3, "Ліси"),
    new Animal("Слон", 4, 1, "Джунглі"),
    new Animal("Лев", 4, 1, "Савана"),
    new Animal("Панда червона", 4, 1, "Бамбукові ліси")
];

// Виведення масиву об'єктів
Animal::show_objects($animals);

?>
