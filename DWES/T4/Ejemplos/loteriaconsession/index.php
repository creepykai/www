<?php
declare(strict_types=1);

/**
 * SIMULACRO EXAMEN DWES: Lotería con Persistencia (Usando SESIONES)
 * * DIFERENCIAS CON COOKIES:
 * 1. Usamos session_start() al inicio.
 * 2. Usamos $_SESSION en lugar de $_COOKIE.
 */

// --- INICIO DE SESIÓN OBLIGATORIO ---
// Debe ser la primera cosa en el script que usa sesiones (Unidad 4, Diapositiva 41)
session_start();

// --- CONFIGURACIÓN ---
$fichero = 'ganadores.txt';
$mensaje = '';
$nombreUsuario = '';

// --- 1. GESTIÓN DE SESIONES (Recordar Usuario) ---

// Si el usuario envía el formulario con su nombre (en $_GET o $_POST, da igual ahora)
if (isset($_GET['nombre'])) {
    $nombreUsuario = trim($_GET['nombre']);
    
    // Guardamos el nombre en la variable de Sesión. ¡El dato está en el SERVIDOR!
    $_SESSION['usuario'] = $nombreUsuario; 
} 
// Si no envía formulario, miramos si el nombre ya está guardado en la Sesión
elseif (isset($_SESSION['usuario'])) {
    $nombreUsuario = $_SESSION['usuario'];
}

// --- 2. LÓGICA DEL JUEGO (MÉTODO GET) ---

// Solo jugamos si se ha enviado el número y tenemos nombre
if (isset($_GET['numero']) && $nombreUsuario !== '') {
    
    $numeroElegido = (int) $_GET['numero'];
    $ganador = rand(1, 5); // Generamos número aleatorio del 1 al 5

    if ($numeroElegido === $ganador) {
        $mensaje = "¡PREMIO! El número ganador era el $ganador.";
        
        // --- 3. GUARDAR EN FICHERO ---
        
        $linea = $nombreUsuario . " - " . date('H:i:s d/m/Y') . PHP_EOL;
        file_put_contents($fichero, $linea, FILE_APPEND);

    } else {
        $mensaje = "Lo siento, ha salido el $ganador. ¡Inténtalo de nuevo!";
    }
}

// --- 4. LEER HISTORIAL DE GANADORES ---

$listaGanadores = [];

if (file_exists($fichero)) {
    $listaGanadores = file($fichero);
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lotería DWES - Sesiones</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f0f2f5; 
            display: flex; 
            justify-content: center; 
            padding-top: 50px; 
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }
        h1 { color: #2c3e50; text-align: center; margin-bottom: 30px; }
        
        /* Clases para mensajes de feedback */
        .alerta { padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: center; font-weight: bold; }
        .ganado { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .perdido { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        form { border-bottom: 2px solid #eee; padding-bottom: 20px; margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 600; color: #555; }
        input[type="text"], input[type="number"] {
            width: 100%; padding: 10px; margin-bottom: 15px;
            border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;
        }
        button {
            width: 100%; padding: 12px; background-color: #3498db; color: white;
            border: none; border-radius: 4px; font-size: 16px; cursor: pointer;
            transition: background 0.3s;
        }
        button:hover { background-color: #2980b9; }

        /* Lista de ganadores */
        ul { list-style: none; padding: 0; max-height: 200px; overflow-y: auto; }
        li { 
            padding: 10px; border-bottom: 1px solid #eee; 
            font-size: 0.9em; color: #555; 
            display: flex; justify-content: space-between;
        }
        li:last-child { border-bottom: none; }
        .titulo-lista { color: #7f8c8d; font-size: 0.9em; text-transform: uppercase; letter-spacing: 1px; }
    </style>
</head>
<body>

    <div class="container">
        <h1>🎲 Lotería del Examen (Método GET con SESIÓN)</h1>

        <!-- Mensaje de resultado (si existe) -->
        <?php if ($mensaje): ?>
            <div class="alerta <?= str_contains($mensaje, 'PREMIO') ? 'ganado' : 'perdido' ?>">
                <?= $mensaje ?>
            </div>
        <?php endif; ?>

        <form method="GET" action="index.php">
            <label for="nombre">Nombre del Jugador:</label>
            <!-- El nombre viene de la sesión -->
            <input type="text" id="nombre" name="nombre" 
                   value="<?= htmlspecialchars($nombreUsuario) ?>" 
                   required placeholder="Tu nombre aquí...">

            <label for="numero">Elige un número (1-5):</label>
            <input type="number" id="numero" name="numero" min="1" max="5" required>

            <button type="submit">¡Probar Suerte!</button>
        </form>

        <h3 class="titulo-lista">🏆 Últimos Ganadores</h3>
        
        <?php if (empty($listaGanadores)): ?>
            <p style="text-align: center; color: #999; font-style: italic;">Aún no hay ganadores registrados.</p>
        <?php else: ?>
            <ul>
                <?php 
                // Usamos array_reverse para mostrar los más nuevos arriba
                foreach (array_reverse($listaGanadores) as $ganador): 
                ?>
                    <li><?= htmlspecialchars($ganador) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

</body>
</html>