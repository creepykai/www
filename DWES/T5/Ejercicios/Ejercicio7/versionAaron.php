<?php

include_once "../ejercicio2/versionAaron.php";


class EmpleadoModificado extends Empleado {
    function __construct(mixed $valor1 = "", mixed $valor2 = "") {
        if (empty($valor1) && empty($valor2)) {
            $valor1 = "Anonimo";
            $valor2 = 1000;
        }
        else if (empty($valor1) && !empty($valor2)) {
            if (is_int($valor2)) {
                $valor1 = "Anonimo";
            }
            else if (is_string($valor2)) {
                $valor1 = 1000;
            }
        }
        else if (empty($valor2) && !empty($valor12)) {
            if (is_int($valor1)) {
                $valor2 = "Anonimo";
            }
            else if (is_string($valor1)) {
                $valor2 = 1000;
            }
        }
        parent::__construct($valor1, $valor2);
    }

    public function __toString() {
        $ret = "<p>";
        $ret .= "Nombre: " . $this->nombre . "<br>";
        $ret .= "Tipo: " . get_class($this) . "<br>";
        $ret .= "Sueldo: " . $this->sueldo . "</p>";
        return $ret;
    }
}


class Becario extends Empleado {
    function __construct(mixed $valor1 = "", mixed $valor2 = "") {
        parent::__construct($valor1, $valor2);
        $this->sueldo = 0;
    }

    function __toString() {
        return "Becario: " . $this->nombre . " - " . $this->sueldo;
    }


}


class Fijo extends Empleado {
    function __construct(mixed $valor1 = "", mixed $valor2 = "") {
        parent::__construct($valor1, $valor2);
        if($this->sueldo < 650) $this->sueldo = 650;
        if($this->sueldo > 1200) $this->sueldo = 1200;
    }

    function __toString() {
        return "Fijo: " . $this->nombre . " - " . $this->sueldo;
    }
}


class Gerente extends Empleado {
    function __construct(mixed $valor1 = "", mixed $valor2 = "") {
        parent::__construct($valor1, $valor2);
        if($this->sueldo < 1500) $this->sueldo = 1500;
        if($this->sueldo > 2500) $this->sueldo = 2500;
    }

    function __toString() {
        return "Gerente: " . $this->nombre . " - " . $this->sueldo;
    }
}