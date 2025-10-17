<?php
// server.php — guarda nombre del usuario, fecha y estado del gato

$fichero = "resultados.txt";

// Recoger datos enviados desde el navegador
$usuario = $_POST["usuario"];
$estado = $_POST["estado"];
$fecha = date("Y-m-d H:i:s");

// Crear una línea de texto
$linea = $usuario . ";" . $fecha . ";" . $estado . "\n";

// Guardar la línea en el fichero
file_put_contents($fichero, $linea, FILE_APPEND);

// Responder al navegador
echo "Guardado correctamente";
?>
