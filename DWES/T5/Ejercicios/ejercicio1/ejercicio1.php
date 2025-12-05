<?php

class Titulo
{
    private $text;
    private $position;
    private $colorTexto;
    private $colorFondo;

    const POSITION = array("centro", "izquierda", "derecha");

    public function __construct(string $text = "", string $position = "centro", string $colorTexto = "negro", string $colorFondo = "blanco")
    {
        $this->text = $text;
        $this->position = $position;
        $this->colorTexto = $colorTexto;
        $this->colorFondo = $colorFondo;
    }

    public function __get($nombre): string
    {
        return $this->$nombre;
    }

    public function __set($nombre, $valor): void
    {
        $this->$nombre = $valor;
    }

    public function modificarTitulo(string $text, string $position, string $colorTexto, string $colorFondo): void
    {
        $this->text = $text;
        $this->position = $position;
        $this->colorTexto = $colorTexto;
        $this->colorFondo = $colorFondo;
    }

    public function obtenerTitulo(): string
    {
        return $this->text;
    }

    public function obtenerPosicion(): string
    {
        return $this->position;
    }

    public function obtenerColorTexto(): string
    {
        return $this->colorTexto;
    }

    public function obtenerColorFondo(): string
    {
        return $this->colorFondo;
    }

    public function obtenerTodosLosValores(): string
    { //Se puede acceder a todos los valores de una vez
        return $this->text . " " . $this->position . " " . $this->colorTexto . " " . $this->colorFondo;
    }

    public function __toString(): string
    {
        $cad = "($this->text, $this->position, $this->colorTexto, $this->colorFondo)";
        return $cad;
    }
}

$titulo = new Titulo("titulo", "centro", "negro", "blanco");
echo "<h2>Titulo original:</h2>";
echo "<h3>Impresion de str:</h3>";
echo $titulo;
echo "<br/>";
echo "<h3>Impresion de todos los valores:</h3>";
echo $titulo->obtenerTodosLosValores();
echo "<br/>";
echo "<br/>";
$titulo->modificarTitulo("mochi", "izquierda", "rojo", "amarillo");
echo "<h2>Titulo modificado:</h2>";
echo "<h3>Impresion de str:</h3>";
echo $titulo;
echo "<br/>";
echo "<h3>Impresion de todos los valores:</h3>";
echo $titulo->obtenerTodosLosValores();
?>
