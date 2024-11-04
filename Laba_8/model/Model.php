<?php
include_once("model/Book.php");
include_once("model/Author.php");

class Model {
    private $db;

    public function __construct() {
        try {
            // Параметри підключення
            $host = 'localhost';
            $dbname = 'Library';
            $username = 'admin';
            $password = 'admin';

            // Підключення до бази
            $this->db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Перевірка успішного підключення
            echo "Підключення успішне!";
        } catch (PDOException $e) {
            echo "Помилка підключення до бази даних: " . $e->getMessage();
            exit();
        }
    }
    public function getBookList() {
        $stmt = $this->db->query("SELECT books.id, books.title, books.description, authors.first_name, authors.last_name FROM books JOIN authors ON books.author_id = authors.id");
        $books = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book($row['id'], $row['title'], $row['description'], $row['first_name'] . " " . $row['last_name']);
        }
        return $books;
    }

    public function getBook($id) {
        $stmt = $this->db->prepare("SELECT books.*, authors.first_name, authors.last_name FROM books JOIN authors ON books.author_id = authors.id WHERE books.id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Book(
            $row['id'],
            $row['title'],
            $row['description'],
            $row['first_name'] . " " . $row['last_name'],
            $row['publish_year'],
            $row['pages'],
            $row['cover_image']
        );
    }



    public function searchBooks($query) {
        $searchTerm = "%$query%";
        $stmt = $this->db->prepare("
        SELECT books.id, books.title, books.description, authors.first_name, authors.last_name, books.publish_year, books.pages, books.cover_image 
        FROM books 
        JOIN authors ON books.author_id = authors.id 
        WHERE books.title LIKE ? OR authors.first_name LIKE ? OR authors.last_name LIKE ?
    ");
        $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
        $books = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book(
                $row['id'],
                $row['title'],
                $row['description'],
                $row['first_name'] . " " . $row['last_name'],
                $row['publish_year'],
                $row['pages'],
                $row['cover_image']
            );
        }
        return $books;
    }


}
?>
