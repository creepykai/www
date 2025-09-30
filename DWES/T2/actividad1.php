<?php
$resultado = 0.00;
$tipo = gettype($resultado);
echo "Resultado vale: $resultado y es de tipo $tipo\n";
$resultado = "Cero";
$tipo = gettype($resultado);
echo "y ahora vale: $resultado y es de tipo $tipo\n";
?>