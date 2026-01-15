<?php

include_once "models/EmpleadoModificado.php";

class Empresa {
    private $empleados;

    public function __construct() {
        $this->empleados = [];
    }

    public function add_employee($nombre, $salario) {
        $this->empleados[] = new EmpleadoModificado($nombre, $salario);
    }

    public function __toString() {
        $phtml = '';
        // print_r($this->empleados);
        foreach ($this->empleados as $empleado) {
            $phtml .= $empleado;
        }
        return $phtml;
    }
}