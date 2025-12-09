<?php

class Empleado{
    public $nombre;
    public $sueldo;
    static private $id = 0; 
    //Esto es el id que se incrementa con cada nuevo empleado, static es para que sea una variable de la clase y no de la instancia

    function __construct(mixed $valor1='', mixed $valor2=''){ //mixed es un tipo de dato que puede ser cualquier cosa, en este caso es el nombre
        $num_args = func_num_args();
        self::$id++; //Incrementa el id con cada nuevo empleado, es decir con cada nueva instancia

        switch ($num_args) {
            case 0: default:
                $this->nombre = "Empleado" . self::$id; //Importante el $this para referirnos a la instancia
                $this->sueldo = 555;
                break;
            case 1:
                if(isset($valor1)){ //Comprobamos si el valor 1 está definido
                    if(is_numeric($valor1)){ //Comprobamos si el valor 1 es numérico y si lo es lo asignamos al sueldo
                        $this->nombre = "Empleado" . self::$id;
                        $this->sueldo = $valor1;
                    }elseif (is_string($valor1)){ //Comprobamos si el valor 1 es texto y si lo es lo asignamos al nombre
                        $this->nombre = $valor1;
                        $this->sueldo = 555;
                    }else { //Si no es ni numérico ni texto, no lo asignamos a nada y nombre es empleado X y el sueldo 555
                        $this->nombre = "Empleado" . self::$id;
                        $this->sueldo = 555;
                    }

                } else if(isset($valor2)){ //Comprobamos si el valor 2 está definido
                    if(is_numeric($valor2)){
                        $this->nombre = "Empleado" . self::$id;
                        $this->sueldo = $valor2;
                    }elseif (is_string($valor2)){
                        $this->nombre = $valor2;
                        $this->sueldo = 555;
                    }else {
                        $this->nombre = "Empleado" . self::$id;
                        $this->sueldo = 555;
                    }
                }
                break;
            case 2:
                if(is_numeric($valor1) && is_string($valor2)){
                    $this->nombre = $valor2;
                    $this->sueldo = $valor1;
                }elseif (is_numeric($valor2) && is_string($valor1)){
                    $this->nombre = $valor1;
                    $this->sueldo = $valor2;
                }else {
                    $this->nombre = "Empleado" . self::$id;
                    $this->sueldo = 555;
                }
                break;
        }
    }

    public function __clone(){
        self::$id++; //Incrementamos el id con cada nuevo empleado
        $this->nombre = "Empleado" . self::$id;  
    }

    //Get devuelve mixed
    //Set devuelve void

    public function __get(string $atributo) : mixed { //Getter: Devuelve el valor del atributo recibido como parámetro
        $ret = ''; //Variable de retorno

        if(property_exists($this, $atributo)){ //Comprobamos si el atributo existe, $this se refiere a la instancia, 
            $ret = $this->$atributo; 
        }
        return $ret;
    }

    public function __set(string $atributo, mixed $valor) : void{ //Setter: Establece un valor para el atributo recibido como primer parámetro
        if(property_exists($this, $atributo)){ //Comprobamos si el atributo existe
            if(($atributo == 'nombre') && (is_string($valor))){ //Comprobamos si el atributo es nombre y el valor es string
                $this->$atributo = $valor; //Establecemos el valor del atributo
            }elseif(($atributo == 'sueldo') && (is_numeric($valor))){ //Comprobamos si el atributo es sueldo y el valor es numérico
                $this->$atributo = $valor; //Establecemos el valor del atributo
            }else{ //Si no cumple con ninguna de las condiciones anteriores 
                echo "Error: El atributo $atributo no existe o el valor $valor no es correcto";
            }
        }
    }

   public function __toString() : string{ //toString devuelve string
        return "<p> <strong>Nombre:</strong> " . $this->nombre . "<br>" . "<strong>Sueldo:</strong> " . $this->sueldo;
    }
    
}

$empleado1 = new Empleado();
$empleado2 = new Empleado("Irene", 600);
$empleado3 = new Empleado(500);
$empleado4 = clone $empleado1;
$empleado5 = new Empleado(500, "Juan");

$phtml = ''. $empleado1 . $empleado2 . $empleado3 . $empleado4 . $empleado5;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>02</title>
</head>
<body>
    <h1>Empleados</h1>
    <p><?php echo $phtml; ?></p>
</body>
</html>