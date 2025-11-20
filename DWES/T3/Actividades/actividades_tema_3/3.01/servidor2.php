<?php
$num1 = $_POST['numero1'] ?? 0;
$num2 = $_POST['numero2'] ?? 0;
$operacion = $_POST['operacion'];

switch ($operacion) {
    case 'suma':
        $resultado = $num1 + $num2;
        break;
    case 'resta':
        $resultado = $num1 - $num2;
        break;
    case 'multiplicacion':
        $resultado = $num1 * $num2;
        break;
    case 'division':
        $resultado = $num1 / $num2;
        break;
    case 'modulo':
        $resultado = $num1 % $num2;
        break;
    default:
        $resultado = 'Operación no válida';
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Actividad 3.1</title>
    </head>
    <body>
        <?= $resultado ?>
    </body>
</html>