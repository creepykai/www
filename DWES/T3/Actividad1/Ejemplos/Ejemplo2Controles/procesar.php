<?php
$nombre = $_GET['nombre'] ?? '';
$edad = $_GET['edad'] ?? '';
$genero = $_GET['genero'] ?? '';
$pais = $_GET['pais'] ?? '';

echo "<h1>Datos recibidos</h1>";
echo "<p><strong>Nombre:</strong> $nombre</p>";
echo "<p><strong>Edad:</strong> $edad</p>";
echo "<p><strong>Género:</strong> $genero</p>";
echo "<p><strong>País:</strong> $pais</p>";

echo '<p><a href="index.html">Volver</a></p>';
?>
