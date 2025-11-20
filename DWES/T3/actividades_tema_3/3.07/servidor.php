<?php
$numero = $_POST['numero'] ?? 0;
$funcion = $_POST['funcion'] ?? '';

switch ($funcion) {
    case 'opuesto':
        $titulo = 'Opuesto';
        $solucion = -1 * $numero;
        $resultado = "<h1>Opuesto de $numero: $solucion</h1>";
        break;
    case 'inverso':
        $titulo = 'Inverso';
        $solucion = 1/$numero;
        $resultado = "<h1>Inverso de $numero: $solucion</h1>";
        break;
    case 'cuadrado':
        $titulo = 'Cuadrado';
        $solucion = $numero ** 2;
        $resultado = "<h1>Cuadrado de $numero: $solucion</h1>";
        break;
    case 'raiz':
        $titulo = 'Raiz cuadrada';
        $solucion = sqrt($numero);
        $resultado = "<h1>Raiz cuadrada de $numero: $solucion</h1>";
        break;
    // case 'sumatorio':
    //     $titulo = 'Sumatorio';
    //     $solucion = 0;
    //     for ($i = 1; $i <= $numero; $i++) {
    //         $solucion += $i;
    //     }
    //     $resultado = "<h1>Sumatorio de $numero: $solucion</h1>";
        break;
    case 'factorial':
        $titulo = 'Factorial';
        $solucion = 0;
        for ($i = 1; $i <= $numero; $i++) {
            $solucion += $i;
        }
        $resultado = "<h1>Factorial de $numero: $solucion</h1>";
        break;
    default:
        $titulo = 'Error';
        $resultado = 'Se ha producido un error.';
        break;
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title><?= $titulo ?></title>
    </head>
    <body>
        <?= $resultado ?>
    </body>
</html>