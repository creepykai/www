<?php
$title = "Mejores Jugadores";
include("inc/header.php"); 

if ($usuarioLogueado == null) {
    echo "<h2>Acceso denegado</h2>";
    echo "<p>Debes estar conectado para ver esta página. Usa el formulario de la cabecera.</p>";
} else {
    
    echo "<h2>Ranking de Jugadores</h2>";
    echo "<p>Estos son los jugadores registrados en el sistema.</p>";
    
    $jugadores = read_players(); 

    if (empty($jugadores)) {
        echo "<div class='alert alert-warning'>No hay jugadores registrados.</div>";
    } else {
        echo '<table class="table table-striped table-bordered">';
        echo '<thead class="table-dark">';
        echo '  <tr>';
        echo '    <th>Usuario</th>';
        echo '    <th>Nombre Completo</th>';
        echo '    <th>País</th>';
        echo '  </tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($jugadores as $jugador) {
            echo '<tr>';
            echo '  <td>' . htmlspecialchars($jugador[0]) . '</td>'; 
            echo '  <td>' . htmlspecialchars($jugador[2]) . '</td>'; 
            echo '  <td>' . htmlspecialchars($jugador[3]) . '</td>'; 
            echo '</tr>';
        }
        
        echo '</tbody>';
        echo '</table>';
    }
}

include("inc/footer.php"); 
?>