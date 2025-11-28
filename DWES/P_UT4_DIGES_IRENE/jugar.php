<?php
//Incluyo el header para cargar la sesión y defino el titulo de la pagina
$title = "Jugar";
include("inc/header.php"); 

//Compruebo si el usuario está logueado
if ($usuarioLogueado == null) {
    echo "<h2>Acceso denegado</h2>";
    echo "<p>Debes estar conectado para poder jugar. Usa el formulario de la cabecera.</p>";
} else {
    //Leo todas las preguntas y el numero total de preguntas
    $todasLasPreguntas = leerPreguntas();
    $preguntasTotalesSistema = count($todasLasPreguntas);

    //Compruebo si se ha enviado una respuesta
    if (isset($_GET['responder']) && $datosPartida !== null) {
        
        $respuestaRecibida = (int)($_GET['respuesta'] ?? 0);
        $idPreguntaActual = (int)($_GET['idPreguntaActual'] ?? -1);
        
        $preguntaCompleta = leerPreguntaPorId($idPreguntaActual);

        if ($preguntaCompleta && (int)$preguntaCompleta[5] === $respuestaRecibida) {
            
            $datosPartida['acertadas']++;
            $datosPartida['racha']++;
            //Calculo los puntos ganados
            if ($datosPartida['racha'] == 1) {
                $puntosGanados = 10;
            } else {
                $puntosGanados = 10 * (2 ** ($datosPartida['racha'] - 1));
            }
            $datosPartida['puntuacionActual'] += $puntosGanados;
            $mensaje = "¡Respuesta Correcta! Has ganado $puntosGanados puntos. Racha actual: " . $datosPartida['racha'] . ".";

        } else {
            $datosPartida['racha'] = 0; 
            $mensaje = "Respuesta Incorrecta. La racha se ha terminado.";
        }
        
        $datosPartida['preguntasRealizadas']++;
        //Guardo la partida
        $_SESSION['partida'] = $datosPartida; 
    }

    
    $todosLosIds = array_keys(leerPreguntas());
    $preguntasPendientes = array_diff($todosLosIds, $datosPartida['preguntasYaHechas']);

    //Compruebo si se ha enviado una respuesta
    if (isset($_GET['finalizar'])) {
        
        echo "<h2>Partida Finalizada</h2>";
        echo "<div class='alert alert-warning'>Has elegido finalizar la partida. No se lleva el bonus de 100 puntos.</div>";
        echo "<p><strong>Puntuación Final:</strong> " . $datosPartida['puntuacionActual'] . "</p>";
        echo "<p>Preguntas Acertadas: " . $datosPartida['acertadas'] . "</p>";
        
        if (guardarPartida($usuarioLogueado, $datosPartida['puntuacionActual'], $datosPartida['preguntasRealizadas'], $datosPartida['acertadas'])) {
            echo "<div class='alert alert-success'> Partida guardada correctamente en el historial.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al guardar la partida.</div>";
        }
        
        unset($_SESSION['partida']);

    } elseif (empty($preguntasPendientes)) {
        //Si no hay preguntas pendientes, se muestra el mensaje de finalización
        $bonus = 100;
        $datosPartida['puntuacionActual'] += $bonus;
        
        echo "<h2>¡Juego Completado!</h2>";
        echo "<div class='alert alert-success'>¡Enhorabuena! Has respondido todas las preguntas disponibles. <br><strong>BONUS: +100 puntos</strong> applied.</div>";
        echo "<p class='fs-4'><strong>Puntuación Final:</strong> " . $datosPartida['puntuacionActual'] . "</p>";
        echo "<p>Preguntas Acertadas: " . $datosPartida['acertadas'] . " de " . $datosPartida['preguntasRealizadas'] . "</p>";

        
        if (guardarPartida($usuarioLogueado, $datosPartida['puntuacionActual'], $datosPartida['preguntasRealizadas'], $datosPartida['acertadas'])) {
            echo "<div class='alert alert-success'> Partida guardada correctamente en el historial.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al guardar la partida.</div>";
        }
        
        unset($_SESSION['partida']);
        
    } else {
        //Si hay preguntas pendientes, se muestra la siguiente pregunta
        $idProximaPregunta = $preguntasPendientes[array_rand($preguntasPendientes)];
        $proximaPregunta = leerPreguntaPorId($idProximaPregunta); 
        
        $datosPartida['preguntasYaHechas'][] = $idProximaPregunta;
        $_SESSION['partida'] = $datosPartida;

        echo "<h2>Ronda de Preguntas</h2>";
        
        echo '<div class="card mb-3">';
        echo '  <div class="card-body d-flex justify-content-around bg-light">';
        echo '    <span>Puntos: <strong>' . $datosPartida['puntuacionActual'] . '</strong></span>';
        echo '    <span>Racha: <strong>' . $datosPartida['racha'] . '</strong></span>';
        echo '    <span>Pregunta: <strong>' . ($datosPartida['preguntasRealizadas'] + 1) . '</strong></span>';
        echo '  </div>';
        echo '</div>';

        if (isset($mensaje)) {
            $claseAlerta = strpos($mensaje, 'Correcta') !== false ? 'alert-success' : 'alert-danger';
            echo "<div class='alert $claseAlerta'>$mensaje</div>";
        }
        
        echo '<div class="text-end mb-2">';
        echo '<a href="jugar.php?finalizar=true" class="btn btn-outline-danger btn-sm">Terminar Partida y Guardar</a>';
        echo '</div>';

        echo '<div class="card shadow-sm">';
        echo '  <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">';
        echo '    <span>Pregunta</span>';
        echo '    <span class="badge bg-dark">' . htmlspecialchars($proximaPregunta[4]) . '</span>';
        echo '  </div>';
        echo '  <div class="card-body">';
        echo '    <h4 class="card-title mb-4">' . htmlspecialchars($proximaPregunta[0]) . '</h4>';
        echo '    <form method="GET" action="jugar.php">';
        echo '      <input type="hidden" name="idPreguntaActual" value="' . $idProximaPregunta . '">';
        echo '      <input type="hidden" name="responder" value="1">';
        echo '      <div class="list-group">';
        for ($i = 1; $i <= 3; $i++) {
            echo '      <label class="list-group-item list-group-item-action">';
            echo '          <input class="form-check-input me-1" type="radio" name="respuesta" value="' . $i . '" required>';
            echo            htmlspecialchars($proximaPregunta[$i]);
            echo '      </label>';
        }
        echo '      </div>';
        
        echo '      <div class="d-grid gap-2 mt-3">';
        echo '        <button type="submit" class="btn btn-primary btn-lg">Responder</button>';
        echo '      </div>';
        echo '    </form>';
        
        echo '  </div>';
        echo '</div>';
    }
}

include("inc/footer.php"); 
?>