<?php
class Coor {
    private $text;
    private $login;
    private $password;

    function __construct($text, $login, $password) {
        $this->text = $text;
        $this->login = $login;
        $this->password = $password;
    }

    function Getname() {
        echo "<p>Name: " . $this->text . "<br>"."\n";
        echo "Login: " . $this->login . "<br>"."\n";
        echo "Password: " . $this->password . "<br>"."\n";
    }

    function __destruct() {
        echo "Object is deleted!<br>"."\n";
    }
}

// Створюємо три об'єкти
$object1 = new Coor("Nick", "nick123", "password1");
$object2 = new Coor("John", "john456", "password2");
$object3 = new Coor("Alice", "alice789", "password3");

$object1->Getname();
$object2->Getname();
$object3->Getname();
?>
