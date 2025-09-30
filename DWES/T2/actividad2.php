<?php
$var = 5;
$tipo = gettype($var);
echo "La variable vale $var y es de tipo $tipo\n";
$var = 5.5;
$tipo = gettype($var);
echo "La variable vale $var y es de tipo $tipo\n";

$var2 = 5.5;
$tipo2 = gettype($var2);
echo "La variable vale $var2 y es de tipo $tipo2\n";
$var2 = (int)$var2; // Lo trunca
$tipo2 = gettype($var2);
echo "La variable vale $var2 y es de tipo $tipo2\n";

$nombre = "Juan";
$apellidos = "Perro";
$direccion = "C. Jardín Botánico";
$codigoPostal = 28014;
$localidad = "Madrid";
$provincia = "Madrid";

echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Variable</th><th>Valor</th><th>Tipo</th></tr>";

echo "<tr><td>nombre</td><td>$nombre</td><td>" . gettype($nombre) . "</td></tr>";
echo "<tr><td>apellidos</td><td>$apellidos</td><td>" . gettype($apellidos) . "</td></tr>";
echo "<tr><td>direccion</td><td>$direccion</td><td>" . gettype($direccion) . "</td></tr>";
echo "<tr><td>codigoPostal</td><td>$codigoPostal</td><td>" . gettype($codigoPostal) . "</td></tr>";
echo "<tr><td>localidad</td><td>$localidad</td><td>" . gettype($localidad) . "</td></tr>";
echo "<tr><td>provincia</td><td>$provincia</td><td>" . gettype($provincia) . "</td></tr>";

echo "</table>";
?>
