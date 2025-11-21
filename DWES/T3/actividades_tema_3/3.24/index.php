<?php 
// Incluir el archivo que contiene las funciones del juego.
include_once 'functions.php'; 

// --- 1. PROCESAMIENTO DE DATOS ---

// Obtener el nombre del usuario de la URL (GET) y sanearlo, o dejar vacío.
$nombre_usuario = isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : '';

// Obtener la predicción de pétalos de la URL (GET) y convertirla a entero, o -1 si no está.
$prediccion = isset($_GET['petalos']) ? intval($_GET['petalos']) : -1;

// Verificar si el formulario ha sido enviado (si 'action=Jugar' está en la URL).
$jugando = isset($_GET['action']) && $_GET['action'] == 'Jugar';
?>
<!DOCTYPE html>
<html lang="es">    
    <head>
        <meta charset="UTF-8">
        <title>Pétalos Alrededor De La Rosa</title>
        <style>
            /* Estilos básicos para la presentación */
            body { font-family: Arial, sans-serif; text-align: center; }
            img { margin: 5px; border: 1px solid #ccc; border-radius: 5px; }
            form { margin-top: 20px; border: 1px solid #eee; padding: 20px; display: inline-block; }
            label { display: inline-block; width: 80px; text-align: left; }
            input[type="submit"] { margin-top: 15px; padding: 10px 20px; cursor: pointer; }
        </style>
    </head>
    <body>
        <h1>Pétalos Alrededor De La Rosa</h1>
        <p>Adivina el número de pétalos que hay alrededor de la rosa (solo en las caras 3 y 5).</p>
        
        <hr>
        
        <?php 
        // --- 2. JUEGO Y RESULTADOS ---

        // Llamar a la función para lanzar los dados, mostrarlos y calcular el resultado.
        $petalos = juego_dados();
        
        // Si el usuario ha enviado el formulario, intentar mostrar el resultado.
        if ($jugando) {
            if ($nombre_usuario !== '' && $prediccion >= 0 && $prediccion <= 20) {
                // Si los datos son válidos, mostrar el mensaje de acierto/fallo.
                imprimir_mensaje($nombre_usuario, $prediccion, $petalos);
            } else if ($nombre_usuario === '') {
                // Mensaje de error si falta el nombre.
                echo "<p style='color: orange;'>Por favor, introduce tu nombre.</p>";
            } else if ($prediccion < 0 || $prediccion > 20) {
                // Mensaje de error si la predicción es inválida.
                echo "<p style='color: orange;'>Por favor, introduce un número de pétalos válido (entre 0 y 20).</p>";
            }
        }
        
        // --- 3. FORMULARIO DE JUEGO ---

        // Mostrar el formulario para la siguiente jugada.
        echo '
            <form method="get">
                <br>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="' . $nombre_usuario . '" required><br>
                
                <br>
                <label for="petalos">Pétalos:</label>
                <input type="number" id="petalos" name="petalos" min="0" max="20" required';
        
        // Si se ha jugado, rellenar el campo de pétalos con la predicción anterior.
        if ($jugando && $prediccion >= 0) {
             echo ' value="' . $prediccion . '"';
        }
        
        echo '><br>
                <br>
                <input type="submit" name="action" value="Jugar">
            </form>
        ';
        ?>
    </body>
</html>