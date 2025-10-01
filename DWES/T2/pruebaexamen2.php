<?php //Se inicia el bloque PHP
    $a = "15.7"; //Declara la variable $a y le asigna el valor "15.7"
    settype($a, "float"); //Convierte el tipo de dato de $a a float
    $b = 4; //Declara la variable $b y le asigna el valor 4
    $c = (int)$a + $b; //Declara la variable $c y le asigna la suma de $a usada como entero y $b
    echo $c, "<br>"; //Imprime el valor de $c seguido de un salto de línea // Se puede usar , y . para concatenar pero . lo convierte en un único valor por eso se usa en el print
    $ref = &$c; //Declara la variable $ref y se le asigna una referencia a $c 
    $ref  = $ref * 2; //Multiplica el valor de $ref por 2
    echo $c, "<br>"; //Imprime el valor actualizado de $c seguido de un salto de línea
    unset($c); //Elimina la variable $c
    echo $c, "<br>"; //Intenta imprimir $c, pero dará un error porque $c ha sido eliminada
    echo $ref, "<br>"; //Imprime el valor de $ref, que sigue existiendo aunque $c ha sido eliminada
?> //Se cierra el bloque PHP

