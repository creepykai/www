<?php

include_once "Empleado.php";


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

    public function __toString(): string {
        $ret = "<p>{$this->nombre} (" . get_class($this) . "): {$this->sueldo}</p>";
        return $ret;
    }
}


class Becario extends EmpleadoModificado {
    function __construct(mixed $valor1 = "", mixed $valor2 = "") {
        parent::__construct($valor1, $valor2);
        $this -> sueldo = 0;
    }
}


class Fijo extends EmpleadoModificado {
    function __construct(mixed $valor1 = "", mixed $valor2 = "") {
        parent::__construct($valor1, $valor2);
        if ($this -> sueldo < 650) $this -> sueldo = 650;
        if ($this -> sueldo > 1200) $this -> sueldo = 1200;
    }
}


class Gerente extends EmpleadoModificado {
    function __construct(mixed $valor1 = "", mixed $valor2 = "") {
        parent::__construct($valor1, $valor2);
        if ($this -> sueldo < 1500) $this -> sueldo = 1500;
        if ($this -> sueldo > 2500) $this -> sueldo = 2500;
    }
}