<?php

class A
{
    public $a = "5";
    public $b = "7";
    public $c = "9";
}
$a = new A();
foreach ($a as $atri) {
    echo "<p>$atri</p>";
}

class myIterator implements Iterator
{ // Implementa la interface Iterator que es una interface que define un conjunto de métodos 
    //que deben ser implementados por una clase, en este caso la clase myIterator
    private $position = 0; //Posicion actual
    private $array = array("element1", "element2", "lastelement");   //Array con los elementos
    public function __construct()
    {
        $this->position = 0;
    } //Constructor, haciendo que la posicion sea 0
    public function current(): mixed
    {
        return $this->array[$this->position];
    } //Devuelve el valor actual
    public function key(): mixed
    {
        return $this->position;
    } //Devuelve la clave actual
    public function next(): void
    {
        ++$this->position;
    } //Avanza al siguiente elemento
    public function rewind(): void
    {
        $this->position = 0;
    } //Rebobina al primer elemento
    public function valid(): bool
    {
        return isset($this->array[$this->position]);
    } //Devuelve true si el elemento actual es válido
}

$it = new myIterator;
foreach ($it as $key => $value) {
    var_dump($key, $value);
    echo "<br>\n";
}
