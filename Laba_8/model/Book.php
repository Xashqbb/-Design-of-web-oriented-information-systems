<?php
class Book {
    public $id;
    public $title;
    public $description;
    public $author;
    public $publish_year;
    public $pages;
    public $cover_image;

    public function __construct($id, $title, $description, $author, $publish_year = null, $pages = null, $cover_image = null) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->author = $author;
        $this->publish_year = $publish_year;
        $this->pages = $pages;
        $this->cover_image = $cover_image;
    }
}
?>
