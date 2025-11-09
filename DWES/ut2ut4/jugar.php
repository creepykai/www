<?php
$title = "Jugar";
include("inc/header.php"); 

if ($usuarioLogueado == null) {
    echo "<h2>Acceso denegado</h2>";
    echo "<p>Debes estar conectado para poder jugar. Usa el formulario de la cabecera.</p>";
} else {
    
    echo "<h2>Ronda de Preguntas</h2>";
    echo "<p>Estas son las preguntas disponibles en el sistema.</p>";
    
    $preguntas = read_questions(); 
    
    if (empty($preguntas)) {
        echo "<div class='alert alert-warning'>No hay preguntas disponibles en este momento.</div>";
    } else {
        foreach ($preguntas as $index => $pregunta) {
            
            echo '<div class="card my-3">';
            echo '  <div class="card-header">';
            echo '    Pregunta ' . ($index + 1) . ' (Categoría: ' . htmlspecialchars($pregunta[4]) . ')';
            echo '  </div>';
            echo '  <div class="card-body">';
            echo '    <h5 class="card-title">' . htmlspecialchars($pregunta[0]) . '</h5>';
            echo '    <ul class="list-group list-group-flush">';
            echo '      <li class="list-group-item">1. ' . htmlspecialchars($pregunta[1]) . '</li>';
            echo '      <li class="list-group-item">2. ' . htmlspecialchars($pregunta[2]) . '</li>';
            echo '      <li class="list-group-item">3. ' . htmlspecialchars($pregunta[3]) . '</li>';
            echo '    </ul>';
            echo '  </div>';
            echo '</div>';
        }
    }
}

include("inc/footer.php"); 
?>