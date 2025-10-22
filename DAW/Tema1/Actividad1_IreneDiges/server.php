<?php
$fichero = "resultados.txt";
$usuario = $_POST["usuario"];
$estado = $_POST["estado"];
$fecha = date("Y-m-d H:i:s");


$linea = $usuario . ";" . $fecha . ";" . $estado . "\n";

file_put_contents($fichero, $linea, FILE_APPEND);

echo "Guardado correctamente";
?>
