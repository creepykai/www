<?php
echo "<h2>Actividad 2.4</h2>";

/* ====== a. Variables tras ejecutar el código ====== */

// Caso 1
$num1a = 7;
$num2a = 5;
$resulta = $num1a;        // resulta = 7
$resulta += $num2a++;     // usa 5 → resulta = 12, luego num2a = 6
echo "<h3>Caso 1</h3>";
echo "\$num1a = $num1a<br>";     // 7
echo "\$num2a = $num2a<br>";     // 6
echo "\$resulta = $resulta<br>"; // 12

// Caso 2
$num1b = 7;
$num2b = 5;
$resultb = &$num1b;       // resultb referencia a num1b
$resultb += ++$num2b;     // ++num2b = 6 → num1b = 7+6 = 13
echo "<h3>Caso 2</h3>";
echo "\$num1b = $num1b<br>";     // 13
echo "\$num2b = $num2b<br>";     // 6
echo "\$resultb = $resultb<br>"; // 13

// Caso 3
$num1c = 7;
$num2c = 5;
$resultc = &$num1c;       // resultc referencia a num1c
$resultc += ++$num1c;     // ++num1c = 8 → num1c = 8+8 = 16
echo "<h3>Caso 3</h3>";
echo "\$num1c = $num1c<br>";     // 16
echo "\$num2c = $num2c<br>";     // 5
echo "\$resultc = $resultc<br>"; // 16
?>