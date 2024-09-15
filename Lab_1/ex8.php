<?php
class CSVHandler
{
    private $_csv_file = null;

    /**
     * @param string $csv_file - path to csv file
     */
    public function __construct($csv_file)
    {
        if (file_exists($csv_file)) {
            $this->_csv_file = $csv_file;
        } else {
            throw new Exception("File not found");
        }
    }

    // Метод для додавання нових записів у файл
    public function addRecord(array $record)
    {
        $handle = fopen($this->_csv_file, "a"); // Відкриття файлу для дописування

        fputcsv($handle, $record, ";"); // Запис нового запису в файл

        fclose($handle);
    }

    // Метод для виведення вмісту файлу
    public function getRecords()
    {
        $handle = fopen($this->_csv_file, "r"); // Відкриття файлу для читання

        $data = array();
        while (($line = fgetcsv($handle, 0, ";")) !== FALSE) {
            $data[] = $line; // Читання рядків з файлу
        }
        fclose($handle);

        return $data;
    }
}

// Використання класу
try {
    $csvHandler = new CSVHandler("animals.csv");

    // Отримання і виведення вмісту файлу
    $records = $csvHandler->getRecords();
    foreach ($records as $record) {
        echo "Species: " . $record[0] . "<br/>";
        echo "Limbs: " . $record[1] . "<br/>";
        echo "Offspring: " . $record[2] . "<br/>";
        echo "Habitat: " . $record[3] . "<br/>";
        echo "--------<br/>"."\n";
    }

    // Додавання нового запису
    $newRecord = array("Пантера", 4, 2, "Савана");
    $csvHandler->addRecord($newRecord);

    echo "New record added.<br/>";

    // Перевірка, чи новий запис додано
    $records = $csvHandler->getRecords();
    foreach ($records as $record) {
        echo "Species: " . $record[0] . "<br/>";
        echo "Limbs: " . $record[1] . "<br/>";
        echo "Offspring: " . $record[2] . "<br/>";
        echo "Habitat: " . $record[3] . "<br/>";
        echo "--------<br/>"."\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
