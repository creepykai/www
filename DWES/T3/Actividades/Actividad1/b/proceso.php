<?php
// Comprobación básica de presencia de datos
if (
    !isset($_GET['n1']) || $_GET['n1'] === '' ||
    !isset($_GET['n2']) || $_GET['n2'] === '' ||
    !isset($_GET['op']) || $_GET['op'] === ''
) {
    echo 'Faltan datos. <a href="calculadora.html">Volver</a>';
    exit;
}

// Convertir a número (lo más simple posible a este nivel)
$a = (float) $_GET['n1'];
$b = (float) $_GET['n2'];
$op = $_GET['op'];

$resultado = null;
$textoOperacion = '';

if ($op === 'add') {
    $resultado = $a + $b;
    $textoOperacion = 'Suma (+)';
} elseif ($op === 'sub') {
    $resultado = $a - $b;
    $textoOperacion = 'Resta (−)';
} elseif ($op === 'mul') {
    $resultado = $a * $b;
    $textoOperacion = 'Multiplicación (×)';
} elseif ($op === 'div') {
    if ($b == 0) {
        echo 'Error: división entre 0. <a href="calculadora.html">Volver</a>';
        exit;
    }
    $resultado = $a / $b;
    $textoOperacion = 'División (÷)';
} elseif ($op === 'mod') {
    // Módulo SOLO con enteros a este nivel
    $ai = (int) $a;
    $bi = (int) $b;
    if ($bi == 0) {
        echo 'Error: módulo con 0. <a href="calculadora.html">Volver</a>';
        exit;
    }
    $resultado = $ai % $bi;
    $textoOperacion = 'Módulo (%)';
} else {
    echo 'Operación no válida. <a href="calculadora.html">Volver</a>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultado</title>
</head>
<body>
  <h1>Resultado</h1>

  <p><strong>Número 1:</strong> <?php echo $a; ?></p>
  <p><strong>Número 2:</strong> <?php echo $b; ?></p>
  <p><strong>Operación:</strong> <?php echo $textoOperacion; ?></p>
  <p><strong>Resultado:</strong> <?php echo $resultado; ?></p>

  <p><a href="index.html">Volver</a></p>
</body>
</html>
