<?php
// Ruta de destino (ajústala si quieres otra)
$destino = $_SERVER['DOCUMENT_ROOT'] . '/DWES/T3/uploads/';

// Asegura que existe (en Windows+Docker normalmente ya existe; si no, créala a mano)
if (!is_dir($destino)) {
  mkdir($destino, 0775, true);
}

// Comprobar si llegó el archivo y si no hubo errores
if (!isset($_FILES['fichero'])) {
  exit('<p>No llegó ningún archivo. <a href="index.html">Volver</a></p>');
}

$archivo = $_FILES['fichero']; // atajo

// Opcional: validar tamaño/extensión/mime simples
$permitidas = ['jpg','jpeg','png','gif','pdf','txt'];
$nombreOriginal = $archivo['name'];
$ext = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
if (!in_array($ext, $permitidas)) {
  exit('<p>Extensión no permitida. <a href="index.html">Volver</a></p>');
}

if ($archivo['error'] !== UPLOAD_ERR_OK) {
  exit('<p>Error en la subida (código '.$archivo['error'].'). <a href="index.html">Volver</a></p>');
}

// Evitar colisiones de nombre
$nombreSeguro = date('Ymd_His') . '_' . preg_replace('/[^A-Za-z0-9._-]/', '_', $nombreOriginal);
$rutaDestino = $destino . $nombreSeguro;

// Mover desde la carpeta temporal al destino final
if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
  echo "<h1>Subida correcta</h1>";
  echo "<p>Guardado como: <strong>$nombreSeguro</strong></p>";
  echo "<p>Tamaño: " . number_format($archivo['size']/1024, 2) . " KB</p>";
  echo '<p><a href="index.html">Subir otro</a></p>';

  // Info útil para ver qué trae $_FILES (como en la diapositiva)
  echo '<pre>' . print_r($_FILES, true) . '</pre>'; // :contentReference[oaicite:3]{index=3}

} else {
  echo "<p>Error al mover el archivo al destino.</p>";
  echo '<p><a href="index.html">Volver</a></p>';
}
