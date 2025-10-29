<?php
$numero = (int) $_GET['numero'];
$funcion = $_GET['funcion'];

// Título dinámico
echo "<!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'>";
echo "<title>" . ucfirst($funcion) . "</title></head><body>";
echo "<h1>" . ucfirst($funcion) . " ($numero): </h1>";

switch ($funcion) {
    case "opuesto":
        $resultado = -$numero;
        break;

    case "inverso":
        if ($numero == 0) {
            $resultado = "No existe";
        } else {
            $resultado = 1 / $numero;
        }
        break;

    case "cuadrado":
        $resultado = $numero * $numero;
        break;

    case "raiz":
        if ($numero < 0) {
            $resultado = "No existe";
        } else {
            $resultado = sqrt($numero); // permitido
        }
        break;

    case "sumatorio":
        if ($numero < 1) {
            $resultado = "No existe";
        } else {
            $suma = 0;
            for ($i = 1; $i <= $numero; $i++) {
                $suma += $i;
            }
            $resultado = $suma;
        }
        break;

    case "factorial":
        if ($numero < 0) {
            $resultado = "No existe";
        } else {
            $fact = 1;
            for ($i = 1; $i <= $numero; $i++) {
                $fact *= $i;
            }
            $resultado = $fact;
        }
        break;

    default:
        $resultado = "Función no válida";
        break;
}

// Mostrar el resultado
echo "<p><strong>Resultado:</strong> $resultado</p>";
echo "<p><a href='index.html'>Volver</a></p>";
echo "</body></html>";
?>
