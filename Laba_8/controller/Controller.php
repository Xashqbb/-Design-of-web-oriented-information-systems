<?php
include_once("model/Model.php");

class Controller {
    public $model;

    public function __construct() {
        $this->model = new Model();
    }

    public function invoke() {
        if (isset($_GET['search'])) {
            $searchQuery = $_GET['search'];
            $books = $this->model->searchBooks($searchQuery);
            include 'view/booklist.php';
        } elseif (isset($_GET['book'])) {
            $book = $this->model->getBook($_GET['book']);
            include 'view/viewbook.php';
        } else {
            $books = $this->model->getBookList();
            include 'view/booklist.php';
        }
    }
}
?>
