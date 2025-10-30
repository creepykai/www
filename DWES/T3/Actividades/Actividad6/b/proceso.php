<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Datos recibidos</title>
  <style>
    table, td, th {
      border: 1px solid black;
      border-collapse: collapse;
      padding: 6px;
    }
    th {
      background-color: #eee;
    }
  </style>
</head>
<body>

<h1>Datos del alumno</h1>

<?php
// Guardamos los datos en un array asociativo
$alumno = [
    "Nombre" => $_GET['nombre'],
    "Apellidos" => $_GET['apellidos'],
    "Teléfono" => $_GET['telefono'],
    "Dirección" => $_GET['direccion'],
    "Población" => $_GET['poblacion'],
    "Provincia" => $_GET['provincia'],
    "Fecha de nacimiento" => $_GET['fecha'],
    "Estudios" => $_GET['estudios']
];

// Mostramos los datos dentro de una tabla usando foreach
echo "<table>";
foreach ($alumno as $campo => $valor) {
    echo "<tr><th>$campo</th><td>$valor</td></tr>";
}
echo "</table>";
?>

<p><a href="index.html">Volver al formulario</a></p>

</body>
</html>
