<?php
// Recogemos datos
$nombre  = isset($_GET['nombre']) ? trim($_GET['nombre']) : '';
$apuesta = isset($_GET['apuesta']) ? (int) $_GET['apuesta'] : 0;

// Título de la página con la jugada
$titulo = "Jugada: " . $apuesta;

echo "<!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>$titulo</title>";
echo "<style>
      .caja{border:1px solid #ccc;padding:12px;display:inline-block}
      .dado{width:120px;height:120px;object-fit:contain;margin:6px}
      </style></head><body>";

// Validación simple (lo dado en clase)
if ($nombre === '' || $apuesta < 2 || $apuesta > 12) {
    echo "<p>Datos incorrectos. <a href='index.html'>Volver</a></p>";
    echo "</body></html>";
    exit;
}

// Lanzamiento de los dos dados (1..6)
$d1 = rand(1, 6);
$d2 = rand(1, 6);
$suma = $d1 + $d2;

// Cabecera tipo ejemplo del PDF
echo "<div class='caja'>";
echo "<h2>Suerte, $nombre</h2>";
echo "<p><strong>Jugada:</strong> $apuesta</p>";

// Mostrar imágenes de los dados
echo "<img class='dado' src='dado/dado{$d1}.png' alt='Dado $d1'>";
echo "<img class='dado' src='dado/dado{$d2}.png' alt='Dado $d2'>";

// Resultado
echo "<p><strong>Suma de los dados:</strong> $suma</p>";

if ($suma == $apuesta) {
    echo "<h3>¡¡¡ Enhorabuena $nombre, ha ganado !!!</h3>";
} else {
    echo "<h3>Lo siento $nombre, gana la banca.</h3>";
}

echo "<p><a href='index.html'>Volver a jugar</a></p>";
echo "</div>";

echo "</body></html>";
