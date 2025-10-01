<!DOCTYPE html><html><head><title>Simulacro</title></head><body>
<?php
    $num1 = "7";
    $num2 = 4.0;
    $suma = (int)$num1 + (int)$num2;
    echo "$num1 + $num2 = $suma <br>"; //$num1 . " + " . $num2 . " = " . $suma; (También válido)
    $decimal = 2.5;
    // echo ($suma * $decimal) . '/' . (($suma * $decimal) % 7);
    $new = $decimal * $suma;
    $resto = $multiplicacion % 7;
    echo "Multiplicacion: " . $multiplicacion . "<br>";
    echo "Resto: " . $resto . "<br>";
    $ref = &$suma;
    $ref += 3;
    echo "$ref compara a  $suma <br>";
    $bool = False;
    var_dump($bool); echo "<br>"; //Imprime el tipo de dato y su valor
    //echo $bool; NO FUNCIONA ECHO SOLO FUNCIONA CON CADENAS
    $bool = &$suma;
    var_dump((1!=2) and (2!=1)); //true
    //var_dump((1 && 2) and (2 || 1)); 
?>
</body></html>