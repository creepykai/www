<?php
// Si el checkbox no se marcó, no existe en $_GET, así que usamos ?? para asignar un valor por defecto
$boletin = $_GET['boletin'] ?? "No marcado";
$condiciones = $_GET['condiciones'] ?? "No marcadas";

echo "<h1>Datos recibidos</h1>";
echo "<p><strong>Boletín:</strong> $boletin</p>";
echo "<p><strong>Condiciones:</strong> $condiciones</p>";
echo '<p><a href="index.html">Volver</a></p>';
?>
