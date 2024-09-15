<?php
class WordFileHandler
{
    private $filename;

    // Конструктор класу
    function __construct($filename)
    {
        $this->filename = $filename;

        // Перевірка на існування файлу
        if (!file_exists($this->filename)) {
            exit("File does not exist");
        }
    }

    // Метод для підрахунку кількості слів і дописування результату у файл
    function countWordsAndAppend()
    {
        // Зчитування вмісту файлу в масив
        $lines = file($this->filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Підрахунок кількості слів (кількість рядків)
        $wordCount = count($lines);

        // Відкриття файлу для дописування
        $fd = fopen($this->filename, "a");

        if (!$fd) {
            exit("Unable to open file for appending");
        }

        // Дописування кількості слів у кінець файлу
        fwrite($fd, "\nTotal words: $wordCount");

        // Закриття файлу
        fclose($fd);
    }
}

// Використання класу
$fileHandler = new WordFileHandler("text.txt");
$fileHandler->countWordsAndAppend();

echo "Word count has been appended to the file.";
?>
