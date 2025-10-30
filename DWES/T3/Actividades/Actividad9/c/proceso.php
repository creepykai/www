<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Datos recibidos</title>
  <style>
    table, th, td { border:1px solid #000; border-collapse:collapse; padding:6px; }
    th { background:#eee; }
  </style>
</head>
<body>
<h1>Datos del formulario</h1>
<table>
  <tr><th>Campo</th><th>Valor</th></tr>
<?php
// Recorremos todos los pares clave=>valor recibidos por GET
foreach ($_GET as $campo => $valor) {
    // Si es un array (checkbox múltiples), lo unimos por comas
    if (is_array($valor)) {
        $mostrar = implode(", ", $valor);
    } else {
        $mostrar = $valor;
    }
    echo "<tr><td>$campo</td><td>$mostrar</td></tr>";
}
?>
</table>
<p><a href="index.html">Volver</a></p>
</body>
</html>
