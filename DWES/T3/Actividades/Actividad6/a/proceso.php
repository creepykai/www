<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultado - Tabla generada</title>
  <style>
    table, td {
      border: 1px solid black;
      border-collapse: collapse;
      padding: 6px;
      text-align: center;
    }
  </style>
</head>
<body>

<?php
// 1️⃣ Recogemos los valores enviados
$filas = $_GET['filas'];
$columnas = $_GET['columnas'];

// 2️⃣ Calculamos cuántos números necesitamos
$total = $filas * $columnas;

// 3️⃣ Generamos la tabla usando bucles anidados
echo "<h2>Tabla de $filas filas y $columnas columnas</h2>";
echo "<table>";

$numero = 1; // comenzamos desde 1
for ($i = 1; $i <= $filas; $i++) {
    echo "<tr>"; // abre una fila
    for ($j = 1; $j <= $columnas; $j++) {
        echo "<td>$numero</td>"; // imprime el número
        $numero++;
    }
    echo "</tr>"; // cierra la fila
}

echo "</table>";
?>

<p><a href="index.html">Volver</a></p>

</body>
</html>
