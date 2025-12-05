<?php

class Clase {
    private $atributo;
    function __get($nombre){ //el get es un metodo mágico que se ejecuta cuando se accede a un atributo privado
        return $this->$nombre;
    }
    function __set($nombre, $valor){ //el set es un metodo que se ejecuta cuando se modifica un atributo privado
        $this->$nombre = $valor;
    }
}

//Pruebas
$a = new Clase(1); //Se crea un objeto de la clase Clase
$a->atributo = 1; //Aqui se llama al metodo __set
$x = $a->atributo; //Aqui se llama al metodo __get y lo que hace es a x asignarle el valor de $a->atributo, es decir, a x le asigna el valor de 1
echo $x;
$a->atributo = 2; //Aqui se llama al metodo __set
echo $x;
?>