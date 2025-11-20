<?php
declare(strict_types=1);

function mostrarTablero(array $cartas, string $mensaje = "") {
    
    $juegoTerminado = ($mensaje !== "");

    echo '<h1 class="titulo-principal">Juego de los Trileros</h1>';

    // --- MARCADOR ---
    $jugadas = $_SESSION['jugadas'] ?? 0;
    $ganadas = $_SESSION['ganadas'] ?? 0;

    echo "<div class='marcador'>";
    echo "<h3>Marcador Global</h3>";
    echo "<span>Partidas: <b>$jugadas</b></span> | ";
    echo "<span>Ganadas: <b class='texto-ganador'>$ganadas</b></span>";
    
    // Botón de Salir
    echo "<br><br><a href='index.php?accion=cerrar'><button class='btn-salir'>🚪 Salir y Borrar Datos</button></a>";
    echo "</div>";
    // ----------------

    if ($juegoTerminado) {
        // Determinamos la clase CSS según el mensaje
        $claseResultado = str_contains($mensaje, "Enhorabuena") ? "texto-ganador" : "texto-perdedor";
        
        echo "<h2 class='mensaje $claseResultado'>$mensaje</h2>";
        
        echo '<div class="contenedor-centro">';
        echo '<a href="index.php"><button class="btn-reiniciar">🔄 Jugar de Nuevo</button></a>';
        echo '</div>';
    }

    echo '<form action="" method="GET">';
    echo '<table class="tablero">';
    
    // FILA DE CARTAS
    echo '<tr>';
    foreach ($cartas as $carta) {
        echo '<td>';
        
        // Solo usamos la clase .carta que definiremos en el CSS
        if ($juegoTerminado) {
            echo '<img src="picas1-9/' . $carta . '.png" alt="' . $carta . '" class="carta">';
        } else {
            echo '<img src="picas1-9/back.png" alt="Reverso" class="carta">';
        }
        
        echo '</td>';
    }
    echo '</tr>';

    // FILA DE BOTONES
    if (!$juegoTerminado) {
        echo '<tr>';
        for ($i = 0; $i < 3; $i++) {
            echo '<td>';
            echo "<label><input type='radio' name='posicion' value='$i' required> ¡Aquí!</label>";
            echo '</td>';
        }
        echo '</tr>';
    }

    echo '</table>';
    
    // BOTÓN DE JUGAR
    if (!$juegoTerminado) {
        echo '<p class="contenedor-centro">';
        echo '<input type="submit" value="🎲 Barajar y Elegir" class="btn-jugar">';
        echo '</p>';
    }
    
    echo '</form>';
}
?>