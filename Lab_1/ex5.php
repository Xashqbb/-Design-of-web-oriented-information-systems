<?php
header("Content-Type: text/html; charset=windows-1251");

class WorkWithFile
{
    var $buff; // Буфер для збереження вмісту файлу
    var $filename; // Ім'я файлу

    // Конструктор класу
    function __construct($filename)
    {
        $uploaddir = './'; // Директорія файлу (поточна директорія)
        $this->filename = $uploaddir . $filename;

        // Перевіряємо, чи існує файл
        if (!file_exists($this->filename)) {
            exit("File does not exist");
        }

        // Відкриваємо файл
        $fd = fopen($this->filename, "r");

        // Перевіряємо, чи вдалося відкрити файл
        if (!$fd) {
            exit("File open error");
        }

        // Зчитуємо вміст файлу
        $this->buff = fread($fd, filesize($this->filename));
        fclose($fd);
    }

    // Метод для виведення вмісту файлу
    function getContent()
    {
        return $this->buff;
    }

    // Метод для отримання розміру файлу
    function getSize()
    {
        return filesize($this->filename);
    }

    // Метод для підрахунку кількості рядків у файлі
    function getCount()
    {
        if (!empty($this->filename)) {
            $arr = file($this->filename); // Читаємо файл в масив
            return count($arr); // Повертаємо кількість рядків
        } else {
            return 0;
        }
    }
}

// Створюємо об'єкт класу WorkWithFile для файлу count.txt
$first = new WorkWithFile("count.txt");

// Виводимо вміст файлу
echo "Content of the file:<br>" . nl2br($first->getContent()) . "<br>";

// Виводимо розмір файлу
echo "Size of the file: " . $first->getSize() . " bytes<br>";

// Виводимо кількість рядків у файлі
echo "Number of lines in the file: " . $first->getCount() . "<br>";

?>
