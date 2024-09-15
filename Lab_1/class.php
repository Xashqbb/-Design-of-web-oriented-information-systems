<?php class Coor{ private $name; function Getname()

{

    echo $this->name;

}

    function Setname($text)

    {

        $this->name=$text;

    }

}

$works=array();//creating a new array

$works[0]=new Coor();//writing a “Coor” object in array

$works[0]->Setname(" Nick "); //set a name

$works[1]=new Coor();

$works[1]->Setname(" Nick 1"); //set a name

$works[2]=new Coor();

$works[2]->Setname(" Nick 2"); //set a name

for($i=0;$i<3;$i++) {echo $works[$i]->Getname();}

//circle with printing names of objects in array

?>