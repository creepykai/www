<?php
// Act 3.9(a) — Un solo archivo PHP
$nombre = $_GET['nombre'] ?? '';
$apellido = $_GET['apellido'] ?? '';
$hayDatos = ($nombre !== '' && $apellido !== '');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?php echo $hayDatos ? "Bienvenida" : "Formulario"; ?></title>
</head>
<body>
<?php if (!$hayDatos): ?>
  <h1>Introduce tus datos</h1>
  <form method="GET" action="">
    <p>
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" required>
    </p>
    <p>
      <label for="apellido">Apellido:</label>
      <input type="text" id="apellido" name="apellido" required>
    </p>
    <button type="submit">Enviar</button>
  </form>
<?php else: ?>
  <h1>Bienvenida, <?php echo $nombre . " " . $apellido; ?>.</h1>
  <p><a href="index.php">Volver</a></p>
<?php endif; ?>
</body>
</html>
