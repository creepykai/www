<?php
// Recogemos los datos enviados por GET
$nombre = $_GET['nombre'];
$apellidos = $_GET['apellidos'];

// Mostramos el resultado
echo "<h1>Bienvenido, $nombre $apellidos</h1>";
echo "<p>Has enviado el formulario correctamente.</p>";

