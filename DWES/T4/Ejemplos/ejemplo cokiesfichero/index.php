<?php
declare(strict_types=1);

$fichero = 'contador.txt';
$visitas = 0; // Valor por defecto si no hay archivo

// 1. Comprobar si el archivo existe
// Usamos file_exists (Pág. 24)
if (file_exists($fichero)) {
    // 2. Leer el contenido actual
    // file_get_contents devuelve un string (Pág. 15)
    $contenido = file_get_contents($fichero);
    
    // Casting a int para poder sumar matemáticamente
    $visitas = (int) $contenido; 
}

// 3. Incrementar visitas
$visitas++;

// 4. Guardar el nuevo dato
// file_put_contents escribe strings, por eso hacemos (string) (Pág. 13)
file_put_contents($fichero, (string) $visitas);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contador con Fichero</title>
    <style>
        body { font-family: sans-serif; text-align: center; padding: 50px; }
        .contador { font-size: 4em; color: #d35400; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Bienvenido a mi web</h1>
    <p>Eres el visitante número:</p>
    
    <?php
        echo '<div class="contador">' . $visitas . '</div>';
    ?>
</body>
</html>