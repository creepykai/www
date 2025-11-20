<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juego de Trileros</title>
    <style>
        /* Un poco de estilo para las imágenes */
        img { height: 200px; border: 1px solid #333; border-radius: 8px; }
    </style>
</head>
<body>
    <?php
    include_once 'functions.php';

    $cartas = ["spades1", "spades2", "spades3"];
    $ganadora = "spades1"; // El As

    // --- NOVEDAD: DICCIONARIO DE TRADUCCIÓN (Array Asociativo UT03 pág 40) ---
    $nombresBonitos = [
        "spades1" => "As",
        "spades2" => "Dos",
        "spades3" => "Tres"
    ];

    // Si el usuario ha elegido carta...
    if (isset($_GET['posicion'])) {
        
        // 1. Barajamos
        shuffle($cartas);

        // 2. Miramos qué ha levantado
        $elegida = (int) $_GET['posicion'];
        $cartaLevantada = $cartas[$elegida]; // Esto nos da "spades2", por ejemplo

        // 3. Traducimos el nombre técnico a nombre bonito
        $nombreReal = $nombresBonitos[$cartaLevantada]; // Esto nos da "Dos"

        // 4. Decidimos si gana o pierde
        if ($cartaLevantada === $ganadora) {
            $mensaje = "¡Enhorabuena! Has encontrado el As.";
        } else {
            // Aquí usamos el nombre bonito en el mensaje
            $mensaje = "¡Fallaste! Ha salido el " . $nombreReal;
        }

        // 5. Pasamos el mensaje
        mostrarTablero($cartas, $mensaje);

    } else {
        // Primera vez
        mostrarTablero($cartas, "");
    }
    ?>
</body>
</html>