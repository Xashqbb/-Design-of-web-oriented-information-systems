<?php
class Author {
    public $id;
    public $last_name;
    public $first_name;
    public $country;

    public function __construct($id, $last_name, $first_name, $country) {
        $this->id = $id;
        $this->last_name = $last_name;
        $this->first_name = $first_name;
        $this->country = $country;
    }
}
?>
