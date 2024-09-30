<?php

// Трейт для видової назви
trait SpeciesTrait {
    protected $speciesName;

    public function setSpeciesName($name) {
        $this->speciesName = $name;
    }

    public function getSpeciesName() {
        return $this->speciesName;
    }
}

// Трейт для числа кінцівок
trait LimbsTrait {
    protected $numberOfLimbs;

    public function setNumberOfLimbs($number) {
        $this->numberOfLimbs = $number;
    }

    public function getNumberOfLimbs() {
        return $this->numberOfLimbs;
    }
}

// Трейт для числа нащадків
trait OffspringTrait {
    protected $numberOfOffspring;

    public function setNumberOfOffspring($number) {
        $this->numberOfOffspring = $number;
    }

    public function getNumberOfOffspring() {
        return $this->numberOfOffspring;
    }
}

// Основний клас Animal
class Animal {
    use SpeciesTrait, LimbsTrait, OffspringTrait;

    public function displayInfo() {
        echo "Species: " . $this->getSpeciesName() . "\n";
        echo "Number of Limbs: " . $this->getNumberOfLimbs() . "\n";
        echo "Number of Offspring: " . $this->getNumberOfOffspring() . "\n";
    }
}


$animal = new Animal();
$animal->setSpeciesName("Кіт лісовий");
$animal->setNumberOfLimbs(4);
$animal->setNumberOfOffspring(6);

$animal->displayInfo();
?>
