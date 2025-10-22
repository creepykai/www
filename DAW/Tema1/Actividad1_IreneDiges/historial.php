<?php
$fichero = "resultados.txt";

if (file_exists($fichero)) {
    $lineas = file($fichero);
} else {
    $lineas = [];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Historial de resultados</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Historial de resultados</h1>

  <?php if (empty($lineas)): ?>
    <p>No hay datos todavía.</p>
  <?php else: ?>
    <table border="1" cellpadding="6">
      <tr>
        <th>Usuario</th>
        <th>Fecha</th>
        <th>Estado del gato</th>
      </tr>
      <?php foreach ($lineas as $linea): 
        $datos = explode(";", trim($linea)); ?>
        <tr>
          <td><?= htmlspecialchars($datos[0]) ?></td>
          <td><?= htmlspecialchars($datos[1]) ?></td>
          <td><?= htmlspecialchars($datos[2]) ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php endif; ?>

  <p><a href="index.html">Volver</a></p>
</body>
</html>
