<?php

class Config {
    public static $factory = 'ua';
    public static $carNum = 10;
    public static $truckNum = 2;
    public static $busNum = 4;
}

interface Sedan {
    public function getModel();
}

interface Truck {
    public function getModel();
}

interface Bus {
    public function getModel();
}

abstract class VehicleFactory {
    abstract public function createSedan();
    abstract public function createTruck();
    abstract public function createBus();

    public static function getFactory() {
        switch (Config::$factory) {
            case 'ua':
                return new DomesticFactory();
            case 'foreign':
                return new ForeignFactory();
            default:
                throw new Exception('Invalid factory type');
        }
    }
}

class DomesticFactory extends VehicleFactory {
    public function createSedan() {
        return new DomesticSedan();
    }
    public function createTruck() {
        return new DomesticTruck();
    }
    public function createBus() {
        return new DomesticBus();
    }
}

class ForeignFactory extends VehicleFactory {
    public function createSedan() {
        return new ForeignSedan();
    }
    public function createTruck() {
        return new ForeignTruck();
    }
    public function createBus() {
        return new ForeignBus();
    }
}

class DomesticSedan implements Sedan {
    public function getModel() {
        return "Domestic Sedan";
    }
}

class DomesticTruck implements Truck {
    public function getModel() {
        return "Domestic Truck";
    }
}

class DomesticBus implements Bus {
    public function getModel() {
        return "Domestic Bus";
    }
}

class ForeignSedan implements Sedan {
    public function getModel() {
        return "Foreign Sedan";
    }
}

class ForeignTruck implements Truck {
    public function getModel() {
        return "Foreign Truck";
    }
}

class ForeignBus implements Bus {
    public function getModel() {
        return "Foreign Bus";
    }
}

// Прототипи
class VehiclePrototype {
    public function __clone() {
        // Можливі дії під час клонування
    }
}

function buildVehicleFleet() {
    $factory = VehicleFactory::getFactory();

    $cars = [];
    $trucks = [];
    $buses = [];

    // Створення автомобілів
    for ($i = 0; $i < Config::$carNum; $i++) {
        $cars[] = clone $factory->createSedan();
    }

    // Створення вантажівок
    for ($i = 0; $i < Config::$truckNum; $i++) {
        $trucks[] = clone $factory->createTruck();
    }

    // Створення автобусів
    for ($i = 0; $i < Config::$busNum; $i++) {
        $buses[] = clone $factory->createBus();
    }

    echo "Fleet created:\n";
    foreach ($cars as $car) {
        echo $car->getModel() . "\n";
    }
    foreach ($trucks as $truck) {
        echo $truck->getModel() . "\n";
    }
    foreach ($buses as $bus) {
        echo $bus->getModel() . "\n";
    }
}

buildVehicleFleet();

Config::$factory = 'foreign';
Config::$carNum = 5;
Config::$truckNum = 3;
Config::$busNum = 1;

echo "\nSwitching to Foreign Factory:\n";
buildVehicleFleet();

?>
