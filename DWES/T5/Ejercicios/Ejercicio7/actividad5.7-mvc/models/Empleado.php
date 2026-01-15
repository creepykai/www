<?php

class Empleado {
    public $nombre;
    public $sueldo;
    static private $id = 0;

    function __construct(mixed $valor1="", mixed $valor2="") {
        $num_args = func_num_args();

        self::$id++;

        switch ($num_args) {
            case 0: default:
                $this -> nombre = "Empleado" . self::$id;
                $this -> sueldo = 555;
                break;
            case 1:
                if (isset($valor1)) {
                    if (is_numeric($valor1)) {
                        $this -> nombre = "Empleado" . self::$id;
                        $this -> sueldo = $valor1;
                    }
                    else if (is_string($valor1)) {
                        $this -> nombre = $valor1;
                        $this -> sueldo = 555;
                    }
                    else {
                        $this -> nombre = "Empleado" . self::$id;
                        $this -> sueldo = 555;
                    }
                }
                else if (isset($valor2)) {
                    if (is_numeric($valor2)) {
                        $this -> nombre = "Empleado" . self::$id;
                        $this -> sueldo = $valor2;
                    }
                    else if (is_string($valor2)) {
                        $this -> nombre = $valor2;
                        $this -> sueldo = 555;
                    }
                    else {
                        $this -> nombre = "Empleado" . self::$id;
                        $this -> sueldo = 555;
                    }
                }
                break;
            case 2:
                if (is_numeric($valor1) && is_string($valor2)) {
                    $this -> nombre = $valor2;
                    $this -> sueldo = $valor1;
                }
                else if (is_string($valor1) && is_numeric($valor2)) {
                    $this -> nombre = $valor1;
                    $this -> sueldo = $valor2;
                }
                else {
                    $this -> nombre = "Empleado" . self::$id;
                    $this -> sueldo = 555;
                }
                break;
        }
    }

    function __clone() {
        self::$id++;
        $this -> nombre = "Empleado" . self::$id;
    }

    function __get(string $atributo) : mixed {
        $ret = "";
        if (property_exists($this, $atributo)) {
            $ret = $this -> $atributo;
        }
        return $ret;
    }

    function __set(string $atributo, mixed $valor) : void {
        if (property_exists($this, $atributo)) {
            if (($atributo == "nombre") && (is_string($valor))) {
                $this -> nombre = $valor;
            }
            if (($atributo == "sueldo") && (is_numeric($valor))) {
                $this -> sueldo = $valor;
            }
        }
    }

    function __tostring() : string {
        return "
        <p><strong>{$this -> nombre}</strong>: {$this -> sueldo}</p>";
    }
}