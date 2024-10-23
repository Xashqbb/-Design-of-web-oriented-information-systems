<?php
// Визначення класу DollarCalc (для розрахунків у доларах)
class DollarCalc {
    private $dollar;
    private $product;
    private $service;
    public $rate = 1;

    // Обробка запиту
    public function requestCalc($productNow, $serviceNow) {
        $this->product = $productNow;
        $this->service = $serviceNow;
        $this->dollar = $this->product + $this->service;
        return $this->requestTotal();
    }

    // Повернення результату
    public function requestTotal() {
        $this->dollar *= $this->rate;
        return $this->dollar;
    }
}

// Визначення класу EuroCalc (для розрахунків у євро)
class EuroCalc {
    private $euro;
    private $product;
    private $service;
    public $rate = 1;

    // Обробка запиту
    public function requestCalc($productNow, $serviceNow) {
        $this->product = $productNow;
        $this->service = $serviceNow;
        $this->euro = $this->product + $this->service;
        return $this->requestTotal();
    }

    // Повернення результату
    public function requestTotal() {
        $this->euro *= $this->rate;
        return $this->euro;
    }
}

// Визначення інтерфейсу ITarget
interface ITarget {
    function requester();
}

// Визначення класу EuroAdapter (адаптер для перетворення у євро)
class EuroAdapter extends EuroCalc implements ITarget {
    public function __construct($rate) {
        $this->rate = $rate;  // Користувацький курс конвертації
        $this->requester();
    }

    function requester() {
        return $this->rate;
    }
}

// Визначення класу Client для роботи з адаптером і DollarCalc
class Client {
    private $requestNow;
    private $dollarRequest;

    public function __construct($product, $service, $euroRate) {
        $this->requestNow = new EuroAdapter($euroRate);
        $this->dollarRequest = new DollarCalc();

        // Отримання суми у євро
        $euro = "€";
        echo "Euros: $euro" . $this->makeAdapterRequest($this->requestNow, $product, $service) . "\n";

        // Конверсія в долари
        echo "Dollars: $" . $this->makeDollarRequest($this->dollarRequest, $product, $service) . "\n";
    }

    // Метод для обробки запиту через адаптер
    private function makeAdapterRequest(ITarget $req, $product, $service) {
        return $req->requestCalc($product, $service); // Значення товару і послуги
    }

    // Метод для обробки запиту для доларів
    private function makeDollarRequest(DollarCalc $req, $product, $service) {
        return $req->requestCalc($product, $service); // Значення товару і послуги
    }
}

$product = 45;    // Вартість товарів у доларах
$service = 55;    // Вартість послуг у доларах
$euroRate = 0.85; // Курс конвертації євро

// Виклик клієнта для виконання запиту
$worker = new Client($product, $service, $euroRate);
?>
