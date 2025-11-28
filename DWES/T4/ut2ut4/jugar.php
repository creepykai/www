<?php
$title = "Jugar";
include("inc/header.php"); 


if ($usuarioLogueado == null) {
    echo "<h2>Acceso denegado</h2>";
    echo "<p>Debes estar conectado para poder jugar. Usa el formulario de la cabecera.</p>";
} else {
    
    // Si el usuario está logueado, $datosPartida ya está cargada desde $_SESSION['partida']
    $preguntasTotalesSistema = count(leerPreguntas()); // Para el límite del juego

    // --- 1. PROCESAR RESPUESTA ANTERIOR (si existe) ---
    if (isset($_GET['responder']) && $datosPartida !== null) {
        
        $respuestaRecibida = (int)($_GET['respuesta'] ?? 0);
        $idPreguntaActual = (int)($_GET['idPreguntaActual'] ?? -1);
        $preguntaCompleta = leerPreguntaPorId($idPreguntaActual);

        // Comprobación de la respuesta
        if ($preguntaCompleta && $preguntaCompleta[5] == $respuestaRecibida) {
            // Respuesta CORRECTA [cite: 42, 43]
            $datosPartida['acertadas']++;
            $datosPartida['racha']++;
            
            // Lógica de Puntuación por Racha 
            if ($datosPartida['racha'] == 1) {
                $puntosGanados = 10;
            } else {
                // Cada una de las posteriores iniciará una racha donde cada pregunta valdrá el doble que la anterior (10, 20, 40, 80, etc.) 
                $puntosGanados = 10 * (2 ** ($datosPartida['racha'] - 1));
            }
            $datosPartida['puntuacionActual'] += $puntosGanados;
            $mensaje = "¡Respuesta Correcta! Has ganado $puntosGanados puntos. Racha actual: " . $datosPartida['racha'] . ".";

        } else {
            // Respuesta INCORRECTA 
            $datosPartida['racha'] = 0; // Se acaba la racha 
            $mensaje = "Respuesta Incorrecta. La racha se ha terminado.";
        }
        
        $datosPartida['preguntasRealizadas']++;

        // Actualizar la sesión con los nuevos datos
        $_SESSION['partida'] = $datosPartida; 
    }


    // --- 2. DETERMINAR LA PRÓXIMA PREGUNTA ---
    $preguntasDisponibles = array_keys($datosPartida['preguntasDisponibles']);
    $preguntasPendientes = array_diff($preguntasDisponibles, $datosPartida['preguntasYaHechas']);

    if (empty($preguntasPendientes)) {
        // --- FIN DE PARTIDA POR AGOTAMIENTO ---
        
        $bonus = 0;
        if ($datosPartida['preguntasRealizadas'] < $preguntasTotalesSistema) {
             // Si las preguntas realizadas son menores que las totales, significa que el sistema está simulando
             // el archivo de preguntas (preguntasDisponibles en la sesión) no tiene las mismas que readQuestions().
             // Para esta simulación, asumiremos que si ya no quedan preguntas en 'preguntasYaHechas' VS 'preguntasDisponibles', se terminó.
             
             // Si el usuario agota las preguntas disponibles en el fichero se le sumarán 100 puntos y finalizará la partida. [cite: 44]
             $datosPartida['puntuacionActual'] += 100;
             $bonus = 100;
        }
        
        echo "<h2>Partida Finalizada</h2>";
        echo "<div class='alert alert-success'>¡Has respondido todas las preguntas! Se te ha sumado un bonus de $bonus puntos.</div>";
        echo "<p>Puntuación Final: " . $datosPartida['puntuacionActual'] . "</p>";
        echo "<p>Preguntas Acertadas: " . $datosPartida['acertadas'] . "</p>";
        
        // Aquí se simularía el guardado en "partidas.csv" [cite: 46]
        
        // Destruir el estado de la partida
        unset($_SESSION['partida']);
        
    } else {
        // --- CONTINUAR JUGANDO ---

        // Seleccionar una pregunta al azar que no haya sido planteada [cite: 47]
        $idProximaPregunta = $preguntasPendientes[array_rand($preguntasPendientes)];
        $proximaPregunta = leerPreguntaPorId($idProximaPregunta); // Obtenemos los datos de la pregunta
        
        // Marcamos la pregunta como realizada en el array temporal para la próxima carga de la sesión
        $datosPartida['preguntasYaHechas'][] = $idProximaPregunta;
        
        // Actualizar la sesión
        $_SESSION['partida'] = $datosPartida;

        // --- Mostrar la Pregunta y el Estado ---
        echo "<h2>Ronda de Preguntas</h2>";
        
        // Mostrar puntuación, preguntas realizadas y acertadas [cite: 39]
        echo '<div class="alert alert-info d-flex justify-content-between">';
        echo '<span>Puntuación: <strong>' . $datosPartida['puntuacionActual'] . '</strong></span>';
        echo '<span>Realizadas: <strong>' . $datosPartida['preguntasRealizadas'] . '</strong></span>';
        echo '<span>Acertadas: <strong>' . $datosPartida['acertadas'] . '</strong></span>';
        echo '</div>';

        if (isset($mensaje)) {
            echo "<p style='color: green;'>$mensaje</p>";
        }
        
        // Botón "Finalizar" [cite: 45]
        echo '<div class="text-end mb-3">';
        echo '<a href="jugar.php?finalizar=true" class="btn btn-danger btn-sm">Finalizar Partida (Sin Bonus)</a>';
        echo '</div>';


        // Mostrar la pregunta actual
        echo '<div class="card my-3">';
        echo '  <div class="card-header bg-warning text-dark">';
        // Mostrar la categoría con diseño distintivo [cite: 38]
        echo '    Pregunta #' . ($idProximaPregunta + 1) . ' | Categoría: <strong>' . htmlspecialchars($proximaPregunta[4]) . '</strong>';
        echo '  </div>';
        echo '  <div class="card-body">';
        echo '    <h5 class="card-title">' . htmlspecialchars($proximaPregunta[0]) . '</h5>';
        
        // Formulario para responder (Uso de GET obligatorio)
        echo '    <form method="GET" action="jugar.php">';
        
        // ID de la pregunta actual (oculto)
        echo '      <input type="hidden" name="idPreguntaActual" value="' . $idProximaPregunta . '">';
        echo '      <input type="hidden" name="responder" value="1">';

        echo '      <ul class="list-group list-group-flush">';
        for ($i = 1; $i <= 3; $i++) {
            echo '      <li class="list-group-item">';
            // Radio button para la respuesta
            echo '          <input type="radio" name="respuesta" value="' . $i . '" id="respuesta' . $i . '" required>';
            echo '          <label for="respuesta' . $i . '">' . $i . '. ' . htmlspecialchars($proximaPregunta[$i]) . '</label>';
            echo '      </li>';
        }
        echo '      </ul>';
        echo '      <button type="submit" class="btn btn-success mt-3">Responder</button>';
        echo '    </form>';
        
        echo '  </div>';
        echo '</div>';
    }

    // --- 3. Lógica para FINALIZAR Partida (Botón) ---
    if (isset($_GET['finalizar'])) {
        echo "<h2>Partida Cancelada</h2>";
        echo "<div class='alert alert-warning'>Has elegido finalizar la partida. No se lleva el bonus de 100 puntos.</div>"; 
        echo "<p>Puntuación Final: " . $datosPartida['puntuacionActual'] . "</p>";
        
        // Aquí se simularía el guardado en "partidas.csv" [cite: 46]
        
        // Destruir el estado de la partida
        unset($_SESSION['partida']);
    }
}

include("inc/footer.php"); 
?>