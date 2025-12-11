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
}


class Becario extends Empleado {

}


class Fijo extends Empleado {

}


class Gerente extends Empleado {

}