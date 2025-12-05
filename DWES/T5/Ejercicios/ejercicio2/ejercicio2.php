<?php
class Empleado
{
    public $nombre;
    public $sueldo;
    public $nEmpleado;

    public function __construct(string $nombre = "Empleado", float $sueldo = 555)
    {
        $this->nombre = $nombre;
        $this->sueldo = $sueldo;
        $this->nEmpleado = $this->nEmpleado + 1;
    }

    public function clonar()
    {
        $clon = clone $this;
        $clon->nEmpleado = $this->nEmpleado + 1;
        return $clon;
    }

    public function __toString()
    {
        return "Nombre: " . $this->nombre . "<br>" . "Sueldo: " . $this->sueldo;
    }
}

$empleado1 = new Empleado();
echo $empleado1;
$empleado2 = new Empleado();
echo $empleado2;
$empleado3 = new Empleado();
echo $empleado3;
$empleado4 = $empleado1->clonar();
echo $empleado4;