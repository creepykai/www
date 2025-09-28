<?php
// Constantes se definen con define(nombre, valor)
define("PI", 3.1416); 

$radio = 5;

// * es multiplicación
// ^ no se usa en PHP, se eleva con $x * $x (o pow())
// Aquí: longitud = 2 * PI * radio
$longitud = 2 * PI * $radio;

// área = PI * radio^2
$area = PI * $radio * $radio;

// . concatenación de cadenas
echo "Valor de PI: " . PI . "<br>";
echo "Radio: $radio<br>";
echo "Longitud de la circunferencia: $longitud<br>";
echo "Área del círculo: $area<br><br>";

$valor1 = 8;
$valor2 = 3;

// + suma
$suma = $valor1 + $valor2;

// - resta
$resta = $valor1 - $valor2;

// * producto
$producto = $valor1 * $valor2;

// / cociente (división normal con decimales)
$cociente = $valor1 / $valor2;

// % resto de la división entera (módulo)
$resto = $valor1 % $valor2;

// ++ incremento en 1
$incremento = $valor1++;

// -- decremento en 1
$decremento = $valor2--;

echo "valor1: $valor1<br>";
echo "valor2: $valor2<br>";
echo "suma: $suma<br>";
echo "resta: $resta<br>";
echo "producto: $producto<br>";
echo "cociente: $cociente<br>";
echo "resto de la división: $resto<br>";
echo "incremento de valor1: $incremento<br>";
echo "decremento de valor2: $decremento<br>";
?>
