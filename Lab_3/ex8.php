<?php
interface InterfaceOne {
    public function methodOne(); // Метод для першого інтерфейсу
}

interface InterfaceTwo {
    public function methodTwo(); // Метод для другого інтерфейсу
}

class A {
    public static function test() {
        echo 1;
    }

    public static function get() {
        self::test();
    }
}

class B extends A {
    public static function test() {
        echo 2;
    }
}

class C extends B implements InterfaceOne, InterfaceTwo {
    public function methodOne() {
        echo "Method One from InterfaceOne\n";
    }

    public function methodTwo() {
        echo "Method Two from InterfaceTwo\n";
    }
}

// Використання класу C
$instance = new C();
$instance->methodOne(); // Виклик методу з першого інтерфейсу
$instance->methodTwo(); // Виклик методу з другого інтерфейсу

B::get(); // Виклик статичного методу з класу B
?>
