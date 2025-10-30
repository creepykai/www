<?php
// Comprobamos que todos los datos han llegado
if (
    !isset($_GET['numero1']) || $_GET['numero1'] === '' ||
    !isset($_GET['numero2']) || $_GET['numero2'] === '' ||
    !isset($_GET['operacion']) || $_GET['operacion'] === ''
) {
    echo 'Faltan datos. <a href="calculadora.html">Volver</a>';
    exit;
}

// Convertimos a número
$numero1 = (float) $_GET['numero1'];
$numero2 = (float) $_GET['numero2'];

// Guardamos la operación elegida
$operacion = $_GET['operacion'];

// Variables para guardar resultado y texto informativo
$resultadoOperacion = null;
$nombreOperacion = '';


// Aquí comprobamos qué operación eligió el usuario
if ($operacion === 'add') {
    $resultadoOperacion = $numero1 + $numero2;
    $nombreOperacion = 'Suma (+)';

} elseif ($operacion === 'sub') {
    $resultadoOperacion = $numero1 - $numero2;
    $nombreOperacion = 'Resta (-)';

} elseif ($operacion === 'mul') {
    $resultadoOperacion = $numero1 * $numero2;
    $nombreOperacion = 'Multiplicación (×)';

} elseif ($operacion === 'div') {

    // Controlar división por 0
    if ($numero2 == 0) {
        echo 'Error: división entre 0. <a href="calculadora.html">Volver</a>';
        exit;
    }

    $resultadoOperacion = $numero1 / $numero2;
    $nombreOperacion = 'División (÷)';

} elseif ($operacion === 'mod') {

    // Para el módulo trabajamos con enteros
    $entero1 = (int) $numero1;
    $entero2 = (int) $numero2;

    if ($entero2 == 0) {
        echo 'Error: módulo con 0. <a href="calculadora.html">Volver</a>';
        exit;
    }

    $resultadoOperacion = $entero1 % $entero2;
    $nombreOperacion = 'Módulo (%)';

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
  <h1>Resultado de la operación</h1>

  <!-- Mostramos los datos introducidos -->
  <p><strong>Número 1:</strong> <?php echo $numero1; ?></p>
  <p><strong>Número 2:</strong> <?php echo $numero2; ?></p>
  <p><strong>Operación:</strong> <?php echo $nombreOperacion; ?></p>

  <!-- Mostramos el resultado -->
  <p><strong>Resultado:</strong> <?php echo $resultadoOperacion; ?></p>

  <p><a href="index.html">Volver</a></p>
</body>
</html>
