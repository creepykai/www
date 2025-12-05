<?php
    class Clase {
    public static $atributo;
    public function oper ($param) {
    self::$atributo = $param;
    echo self::$atributo;
    }
    }
    //La diferencia entre this y self es que this se refiere a la instancia actual de la clase, mientras que self se refiere a la clase misma.
    $miClase = new Clase(1);
    $miClase->oper("Hola");
    $miClase->oper("Adios");
    $miClase->oper("Chau");
?>