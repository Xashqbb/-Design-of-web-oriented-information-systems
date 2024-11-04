<?php
include_once("model/Model.php");

class SearchController {
    private $model;

    public function __construct() {
        $this->model = new Model();
    }

    public function search($query) {

        return $this->model->searchBooks($query);
    }
}

// Обробка пошукового запиту
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $query = $_POST['query'];
    $searchController = new SearchController();
    $books = $searchController->search($query);
    include 'view/booklist.php';
}
?>
