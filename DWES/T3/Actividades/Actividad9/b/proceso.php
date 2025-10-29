<?php
// Act 3.9(b) — Dos pasos en un único PHP
$paso = $_GET['paso'] ?? '1';
$cantidad = isset($_GET['cantidad']) ? (int) $_GET['cantidad'] : 0;
if ($cantidad < 1) $cantidad = 1;
if ($cantidad > 10) $cantidad = 10;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Actividad 3.9(b)</title>
  <style>
    table, th, td { border:1px solid #000; border-collapse:collapse; padding:6px; }
  </style>
</head>
<body>

<?php if ($paso === '1'): ?>
  <h1>¿Cuántos alumnos? (máx. 10)</h1>
  <form method="GET" action="">
    <input type="hidden" name="paso" value="2">
    <label for="cantidad">Cantidad:</label>
    <input type="number" id="cantidad" name="cantidad" min="1" max="10" value="3" required>
    <button type="submit">Continuar</button>
  </form>

<?php elseif ($paso === '2'): ?>
  <h1>Introduce los nombres (<?php echo $cantidad; ?>)</h1>
  <form method="GET" action="">
    <input type="hidden" name="paso" value="3">
    <input type="hidden" name="cantidad" value="<?php echo $cantidad; ?>">
    <?php for ($i = 1; $i <= $cantidad; $i++): ?>
      <p>
        <label>Alumno <?php echo $i; ?>:</label>
        <input type="text" name="alumno[]" required>
      </p>
    <?php endfor; ?>
    <button type="submit">Mostrar tabla</button>
  </form>

<?php elseif ($paso === '3'): ?>
  <h1>Listado de alumnos</h1>
  <?php
    $alumnos = $_GET['alumno'] ?? [];
    echo "<table><tr><th>#</th><th>Nombre</th></tr>";
    $i = 1;
    foreach ($alumnos as $nombre) {
      echo "<tr><td>$i</td><td>$nombre</td></tr>";
      $i++;
    }
    echo "</table>";
  ?>
  <p><a href="index.php">Volver al inicio</a></p>
<?php endif; ?>

</body>
</html>
