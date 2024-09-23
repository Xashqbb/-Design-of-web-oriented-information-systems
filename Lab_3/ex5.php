<?php
date_default_timezone_set('Europe/Kiev'); // або ваш часовий пояс
interface ILoger {
    public function log($message); // визначення функції, яка повинна бути перевизначена в наступному класі
}

class FileLoger implements ILoger {
    private $file;
    private $logFile;

    public function __construct($filename, $mode = 'a') {
        $this->logFile = $filename;
        $this->file = fopen($filename, $mode) or die('Could not open the log file'); // відкриваємо файл або виводимо помилку
    }

    public function log($message) { // перевизначення функції "log"
        $message = date("F j, Y, g:i a") . ': ' . $message . "\n";
        fwrite($this->file, $message);
    }

    public function __destruct() {
        if ($this->file) {
            fclose($this->file);
        }
    }
}

class DbLoger implements ILoger {
    private $file;

    public function __construct($filename, $mode = 'a') {
        $this->file = fopen($filename, $mode) or die('Could not open the log file'); // відкриваємо файл
    }

    public function log($message) { // реалізація методу log
        $message = date("F j, Y, g:i a") . ': ' . $message . "\n";
        fwrite($this->file, $message);
    }

    public function __destruct() {
        if ($this->file) {
            fclose($this->file);
        }
    }
}

// Приклад використання
$logFile = './db_log.txt'; // Ім'я файлу для логування
$dbLog = new DbLoger($logFile);

// Логуємо повідомлення
$dbLog->log('Перше повідомлення для журналу');
$dbLog->log('Друге повідомлення для журналу');

echo "Логування завершено!";
?>
