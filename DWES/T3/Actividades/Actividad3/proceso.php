<?php
// Comprobación básica
if (
  !isset($_GET['texto'])   || $_GET['texto'] === '' ||
  !isset($_GET['tam'])     || $_GET['tam'] === '' ||
  !isset($_GET['estilo'])  || $_GET['estilo'] === '' ||
  !isset($_GET['color'])   || $_GET['color'] === ''
) {
  echo 'Faltan datos. <a href="index.html">Volver</a>';
  exit;
}

// Recoger datos
$texto  = $_GET['texto'];
$tam    = (int) $_GET['tam']; // px
$estilo = $_GET['estilo'];    // CSS directo
$color  = $_GET['color'];     // CSS directo

// Si tamaño es 0 → borde oculto
if ($tam === 0) {
  $estilo = 'none';
}

// Estilo final
$style = "border: {$tam}px {$estilo} {$color}; padding:10px; background:white; width:fit-content;";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultado</title>
</head>
<body style="background-color:#d9e6e6; font-family:Arial, sans-serif;">
  <h1>Resultado</h1>

  <div style="<?php echo $style; ?>">
    <?php echo $texto; ?>
  </div>

  <p><a href="index.html">Volver</a></p>
</body>
</html>
