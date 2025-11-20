<?php
declare(strict_types=1);

function mostrarTablero(array $cartas, string $mensaje = "") {
    
    // Variable semáforo: ¿Hemos terminado la partida?
    $juegoTerminado = ($mensaje !== "");

    echo '<h1>Juego de los Trileros</h1>';

    if ($juegoTerminado) {
        // RESULTADO: Mostramos mensaje y botón de reiniciar
        echo "<h2>$mensaje</h2>";
        
        // Botón para limpiar la URL y empezar de cero
        echo '<div>';
        echo '<a href="index.php"><button>Jugar de Nuevo</button></a>';
        echo '</div>';
    }

    // TABLERO
    // Dejamos action vacío para enviar a la misma página
    echo '<form action="" method="GET">';
    echo '<table>';
    
    // FILA DE CARTAS
    echo '<tr>';
    foreach ($cartas as $carta) {
        echo '<td>';
        
        if ($juegoTerminado) {
            // Si terminó, enseñamos la carta real
            echo '<img src="picas1-9/' . $carta . '.png" alt="' . $carta . '">';
        } else {
            // Si estamos jugando, enseñamos el reverso
            echo '<img src="picas1-9/back.png" alt="Reverso">';
        }
        
        echo '</td>';
    }
    echo '</tr>';

    // FILA DE BOTONES (Solo si no ha terminado el juego)
    if (!$juegoTerminado) {
        echo '<tr>';
        for ($i = 0; $i < 3; $i++) {
            echo '<td>';
            echo "<label><input type='radio' name='posicion' value='$i' required></label>";
            echo '</td>';
        }
        echo '</tr>';
    }

    echo '</table>';
    
    // BOTÓN DE JUGAR (Solo si no ha terminado)
    if (!$juegoTerminado) {
        echo '<p style="text-align:center">';
        echo '<input type="submit" value="Barajar y Elegir">';
        echo '</p>';
    }
    
    echo '</form>';
}
?>