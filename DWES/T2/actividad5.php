<?php
$num1 = 5.5;          // num1 es float
$num2 = &$num1;       // num2 es referencia a num1 (apunta al mismo valor)

// Se muestran ambos valores (son iguales porque comparten referencia)
echo "num1: $num1 - num2: $num2\n";  
// Salida: num1: 5.5 - num2: 5.5

// isset() → devuelve true si la variable está definida
echo "Existe la variable num1: ";
var_dump(isset($num1));  
// Salida: bool(true)

// empty() → devuelve true si la variable está vacía (0, "", null, false, etc.)
echo "Está vacía la variable num1: ";
var_dump(empty($num1));  
// num1 = 5.5 → no está vacía
// Salida: bool(false)

// is_int() → comprueba si es entero
echo "Es de tipo entero la variable num1: ";
var_dump(is_int($num1));  
// num1 = 5.5 → no es entero
// Salida: bool(false)

// is_float() → comprueba si es float
echo "Es de tipo float la variable num1: ";
var_dump(is_float($num1));  
// num1 = 5.5 → sí es float
// Salida: bool(true)

// unset() → elimina la variable
unset($num1);

// Ahora num1 ya no existe
echo "Existe la variable num1: ";
var_dump(isset($num1));  
// Salida: bool(false)

// num2 sigue existiendo (pero apuntaba a num1, ahora se queda con null)
echo "Existe la variable num2: ";
var_dump(isset($num2));  
// Salida: bool(false) → porque al eliminar num1, num2 pierde la referencia también

// Mostramos los valores (num1 ya no existe, num2 = null)
echo "num1: "; 
var_dump($num1);   // Notice + NULL
echo "num2: "; 
var_dump($num2);   // NULL
?>
