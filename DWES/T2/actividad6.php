<?php
echo "<h2>Ejercicio: Tipos y valores</h2>";

/* ===== Primer bloque ===== */
$num1 = "7";                  
$num2 = 5;                    
$result = intval($num1) / $num2;

echo "<h3>Primer bloque</h3>";
echo "\$num1: "; var_dump($num1);
echo "\$num2: "; var_dump($num2);
echo "\$result: "; var_dump($result);

/* ===== Segundo bloque ===== */
$num1 = "Lote ";              
$num2 = 724;                  
$result = $num1 . $num2;      

echo "<h3>Segundo bloque</h3>";
echo "\$num1: "; var_dump($num1);
echo "\$num2: "; var_dump($num2);
echo "\$result: "; var_dump($result);
?>
