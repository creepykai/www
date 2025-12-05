<?php
class Clase { //Se define la clase
    public $atributo; //Se define el atributo publico, quiere decir que se puede acceder desde fuera de la clase
    private $privado; //Se define el atributo privado, quiere decir que solo se puede acceder desde dentro de la clase

    function __construct(int $param) { //Se define el constructor, que es un metodo que se ejecuta al crear un objeto
        $this -> atributo = $param; //Se asigna el valor del parametro al atributo publico
        $this -> privado = $param; //Se asigna el valor del parametro al atributo privado, aunque no se pueda acceder desde fuera de la clase
    }

    function Sumar(int $a, int $b) : int { //Se define el metodo Sumar, : int indica que el metodo devuelve un entero
        return $a + $b; //Si sumas + privado no funciona porque es privado
    }
}

$miClase = new Clase("Uno"); //Se crea un objeto de la clase Clase
// echo "<p>Valor: {$miClase->atributo}</p>";
$miClase -> atributo = "Dos"; //Se modifica el atributo publico
//$miClase -> privado = "Tres"; //Se modifica el atributo privado, pero no se puede acceder desde fuera de la clase
// echo "<p>Valor: {$miClase->atributo}</p>";
var_dump($miClase); //Se muestra el objeto, var_dump() muestra la informacion del objeto

var_dump($miClase->Sumar(5,7)); //Se llama al metodo Sumar
?>

Operador flecha -> se usa para acceder a los atributos y metodos de una clase

Ejemplos:
$this -> atributo = $param; //Se asigna el valor del parametro al atributo publico
$this es una variable que representa el objeto actual
