<?php
/* ====== b. Comparaciones ====== */

echo "<h2>Comparaciones</h2>";

// Caso 1: ==
$num1d = 0;
$num2d = 0.0;
echo "<h3>Comparación con ==</h3>";
var_dump($num1d == $num2d); // true porque compara solo valor (0 == 0.0)

// Caso 2: ===
$num1e = 0;
$num2e = 0.0;
echo "<h3>Comparación con ===</h3>";
var_dump($num1e === $num2e); // false porque compara tipo y valor (int != double)
?>