<?php
$title = "Mejores Jugadores";
include("inc/header.php"); 

if ($usuarioLogueado == null) {
    echo "<h2>Acceso denegado</h2>";
    echo "<p>Debes estar conectado para ver esta página. Usa el formulario de la cabecera.</p>";
} else {
    
    echo "<h2>Ranking de Jugadores</h2>";
    echo "<p>Estos son los jugadores registrados en el sistema, ordenados según su número de puntos.</p>";
    
    $jugadores = leerJugadores(); 

    // Ordenar los jugadores por la puntuación (índice 7) de forma descendente
    usort($jugadores, function(array $a, array $b) : int {
        return $b[7] <=> $a[7];
    });

    if (empty($jugadores)) {
        echo "<div class='alert alert-warning'>No hay jugadores registrados.</div>";
    } else {
        echo '<table class="table table-striped table-bordered text-center">'; // Añadido text-center para centrar
        echo '<thead class="table-dark">';
        echo '  <tr>';
        echo '    <th style="width: 15%;">Ranking</th>'; 
        echo '    <th>Usuario</th>';
        echo '    <th style="width: 20%;">Mejor Puntuación</th>'; 
        echo '  </tr>';
        echo '</thead>';
        echo '<tbody>';
        
        $posicionRanking = 1;
        foreach ($jugadores as $jugador) {
            echo '<tr>';
            echo '  <td><strong>#' . $posicionRanking++ . '</strong></td>'; // Ranking destacado
            echo '  <td>' . htmlspecialchars($jugador[0]) . '</td>';      // Usuario (índice 0)
            echo '  <td>' . htmlspecialchars($jugador[7]) . ' pts</td>';  // Puntuación (índice 7)
            echo '</tr>';
        }
        
        echo '</tbody>';
        echo '</table>';
    }
}

include("inc/footer.php"); 
?>