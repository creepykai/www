<?php
// 1. REGLA DE ORO: session_start() SIEMPRE en la línea 1
session_start();

include_once 'functions.php';

// --- LÓGICA PHP ---

// 2. Salir
if (isset($_GET['accion']) && $_GET['accion'] === 'cerrar') {
    session_destroy();
    $_SESSION = [];
    header("Location: index.php");
    exit;
}

// 3. Inicializar
if (!isset($_SESSION['jugadas'])) {
    $_SESSION['jugadas'] = 0;
    $_SESSION['ganadas'] = 0;
}

// 4. Configuración
$cartas = ["spades1", "spades2", "spades3"];
$ganadora = "spades1"; 
$nombresBonitos = ["spades1" => "As", "spades2" => "Dos", "spades3" => "Tres"];
$mensaje = ""; 

// 5. Juego
if (isset($_GET['posicion'])) {
    
    shuffle($cartas);
    $elegida = (int) $_GET['posicion'];
    $cartaLevantada = $cartas[$elegida];
    $nombreReal = $nombresBonitos[$cartaLevantada];

    $_SESSION['jugadas']++;

    if ($cartaLevantada === $ganadora) {
        $mensaje = "¡Enhorabuena! Has encontrado el As.";
        $_SESSION['ganadas']++;
    } else {
        $mensaje = "¡Fallaste! Ha salido el " . $nombreReal;
    }
}
// FIN PHP
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juego de Trileros con Sesión</title>
    <style>
        /* Estilos generales */
        body { font-family: sans-serif; }
        
        .titulo-principal { text-align: center; }
        
        /* Marcador */
        .marcador { 
            background-color: #f0f0f0; 
            padding: 15px; 
            border: 1px solid #ccc; 
            margin: 0 auto 20px auto; 
            text-align: center; 
            width: 50%;
            border-radius: 8px;
        }

        /* Textos de resultado */
        .mensaje { text-align: center; }
        .texto-ganador { color: green; }
        .texto-perdedor { color: red; }

        /* Botones */
        .btn-salir { background-color: #ffcccc; border: 1px solid #cc9999; padding: 5px 10px; cursor: pointer; border-radius: 4px; }
        .btn-reiniciar { padding: 10px 20px; cursor: pointer; font-size: 1em; }
        .btn-jugar { padding: 10px 20px; font-size: 1.2em; cursor: pointer; background-color: #e0e0ff; border: 1px solid #aaa; border-radius: 5px; }
        
        /* Tablero y Cartas */
        .tablero { margin: 0 auto; text-align: center; border-spacing: 15px; }
        .carta { 
            height: 150px; 
            border: 2px solid #333; 
            border-radius: 10px; 
            box-shadow: 3px 3px 5px rgba(0,0,0,0.3);
        }
        
        .contenedor-centro { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>

    <?php
    mostrarTablero($cartas, $mensaje);
    ?>

</body>
</html>