<?php
interface Figure {
    public function draw();     // метод для малювання фігури
    public function erase();    // метод для стирання фігури
    public function move($x, $y); // метод для переміщення фігури
    public function getColor(); // метод для отримання кольору
    public function setColor($color); // метод для встановлення кольору
}

class Circle implements Figure {
    private $color;
    private $radius;
    private $x;
    private $y;

    public function __construct($radius, $color) {
        $this->radius = $radius;
        $this->color = $color;
        $this->x = 0; // початкові координати
        $this->y = 0;
    }

    public function draw() {
        echo "Малюємо коло радіусом $this->radius з кольором $this->color на координатах ($this->x, $this->y).\n";
    }

    public function erase() {
        echo "Стираємо коло радіусом $this->radius.\n";
    }

    public function move($x, $y) {
        $this->x = $x;
        $this->y = $y;
        echo "Перемістили коло на координати ($this->x, $this->y).\n";
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }
}

class Square implements Figure {
    private $color;
    private $side;
    private $x;
    private $y;

    public function __construct($side, $color) {
        $this->side = $side;
        $this->color = $color;
        $this->x = 0; // початкові координати
        $this->y = 0;
    }

    public function draw() {
        echo "Малюємо квадрат зі стороною $this->side з кольором $this->color на координатах ($this->x, $this->y).\n";
    }

    public function erase() {
        echo "Стираємо квадрат зі стороною $this->side.\n";
    }

    public function move($x, $y) {
        $this->x = $x;
        $this->y = $y;
        echo "Перемістили квадрат на координати ($this->x, $this->y).\n";
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }
}

class Triangle implements Figure {
    private $color;
    private $base;
    private $height;
    private $x;
    private $y;

    public function __construct($base, $height, $color) {
        $this->base = $base;
        $this->height = $height;
        $this->color = $color;
        $this->x = 0; // початкові координати
        $this->y = 0;
    }

    public function draw() {
        echo "Малюємо трикутник з основою $this->base і висотою $this->height з кольором $this->color на координатах ($this->x, $this->y).\n";
    }

    public function erase() {
        echo "Стираємо трикутник з основою $this->base і висотою $this->height.\n";
    }

    public function move($x, $y) {
        $this->x = $x;
        $this->y = $y;
        echo "Перемістили трикутник на координати ($this->x, $this->y).\n";
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }
}

// Приклад використання
$circle = new Circle(5, 'червоний');
$circle->draw();
$circle->move(10, 15);
$circle->setColor('синій');
$circle->draw();
$circle->erase();

$square = new Square(4, 'зелений');
$square->draw();
$square->move(20, 25);
$square->setColor('жовтий');
$square->draw();
$square->erase();

$triangle = new Triangle(6, 4, 'фіолетовий');
$triangle->draw();
$triangle->move(30, 35);
$triangle->setColor('помаранчевий');
$triangle->draw();
$triangle->erase();

?>
