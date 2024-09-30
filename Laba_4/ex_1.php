<?php

trait MyFirstTrait {
    public function traitFunction() {
        echo "Hello world";
    }
    public function timeBasedGreeting() {
        $hour = date('H');

        if ($hour < 12) {
            echo "Good morning"."\n";
        } elseif ($hour < 18) {
            echo "Good afternoon"."\n";
        } else {
            echo "Good evening"."\n";
        }
    }
}

class HelloWorld {
    use MyFirstTrait;
}

$objTest = new HelloWorld();
$objTest->traitFunction(); // Виведе "Hello world"
echo "\n";
$objTest->timeBasedGreeting(); // Виведе привітання на основі поточного часу

// Логування в текстовий файл з використанням трейту
// Інтерфейс ILogger
interface ILogger {
    public function logMessage($message);
}
// Трейт для отримання дати та часу
trait DateTimeTrait {
    public function getCurrentDateTime() {
        return date('F d, Y, h:i a');
    }
}
// Трейт для запису у файл
trait FileTrait {
    public function writeToFile($message) {
        $dateTime = $this->getCurrentDateTime();
        $logEntry = $dateTime . ": " . $message . PHP_EOL;

        file_put_contents('log.txt', $logEntry, FILE_APPEND);
    }
}
class FileLogger implements ILogger {
    use DateTimeTrait, FileTrait;

    public function logMessage($message) {
        $this->writeToFile($message);
    }
}


$logger = new FileLogger();
$logger->logMessage("This is a log message"); // Запише повідомлення до файлу log.txt
$logger->logMessage("Another log message"); // Запише ще одне повідомлення до файлу log.txt

// Множинне спадкування за допомогою трейтів

trait A {
    public function a() {
        echo "Hello ";
    }
}

trait B {
    public function b() {
        echo "world";
    }
}

class Test {
    use A, B;

    public function c() {
        echo "!";
    }
}

$t = new Test();
$t->a(); // Виведе "Hello "
$t->b(); // Виведе "world"
$t->c(); // Виведе "!"
?>
