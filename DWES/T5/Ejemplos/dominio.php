<?php
class silla {
    private $color;
    private $altura;
    private $anchura;
    private $profundidad;
    private $precio;
    private $material;
    private $tipo;

    //definir los colores que serán disponibles
    const COLOR = array("rojo", "azul", "amarillo", "verde", "negro", "blanco");

    //definir los tipos que serán disponibles
    const TIPO = array("silla de jardín", "silla de salón", "silla de comedor");

    //definir los materiales que serán disponibles
    const MATERIAL = array("madera", "metal", "plástico");
    
    public function __construct($color, $altura, $anchura, $profundidad, $precio, $material, $tipo) {
        $this->color = $color;
        $this->altura = $altura;
        $this->anchura = $anchura;
        $this->profundidad = $profundidad;
        $this->precio = $precio;
        $this->material = $material;
        $this->tipo = $tipo;
    }

    public function __toString() {
        $cad = "($this->color, $this->altura, $this->anchura, $this->profundidad, $this->precio, $this->material, $this->tipo)";
        return $cad;
    }

    public function __get($nombre) {
        return $this->$nombre;
    }

    public function __set($nombre, $valor) {
        $this->$nombre = $valor;
    }
}
?>