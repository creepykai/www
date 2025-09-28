<?php
$resultado = 0;
$tipo = gettype($resultado);
echo "Resultado vale: $resultado y es de tipo $tipo\n";
$resultado2 = (double)$resultado;
$tipo = gettype($resultado2);
echo "y Resultado2: $resultado2 y es de tipo $tipo\n";
$tipo = gettype($resultado);
echo "y Resultado vale: $resultado y es de tipo $tipo";
?>