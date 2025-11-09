<?php
$title = "Editar Preguntas";

$datosGuardados = [];
$mensaje = "";

if (isset($_GET['guardar_pregunta'])) {

    $datosGuardados = [
        'pregunta' => $_GET['pregunta'] ?? null,
        'opcion1' => $_GET['opcion1'] ?? null,
        'opcion2' => $_GET['opcion2'] ?? null,
        'opcion3' => $_GET['opcion3'] ?? null,
        'correcta' => $_GET['correcta'] ?? null,
        'categoria' => $_GET['categoria'] ?? null,
    ];
    
    $mensaje = "Pregunta recibida en el array.";
}

include("inc/header.php"); 

if (!$esAdmin) {
    echo "<h2>Acceso denegado</h2>";
    echo "<p>No tienes permisos de administrador para acceder a esta sección.</p>";
} else {
    
    echo "<h2>Añadir Nueva Pregunta</h2>";
    echo "<p>Rellena los campos para añadir una nueva pregunta al juego.</p>";

    if ($mensaje != "") {
        echo "<p style='color:green;'>$mensaje</p>";
    }

    echo '
    <form method="GET" action="editar.php" class="row g-3">
        <div class="col-12">
            <label for="pregunta" class="form-label">Enunciado de la Pregunta*</label>
            <textarea class="form-control" id="pregunta" name="pregunta" rows="3"></textarea>
        </div>
        
        <div class="col-md-6">
            <label for="opcion1" class="form-label">Opción 1*</label>
            <input type="text" class="form-control" id="opcion1" name="opcion1">
        </div>
        <div class="col-md-6">
            <label for="categoria" class="form-label">Categoría*</label>
            <input type="text" class="form-control" id="categoria" name="categoria">
        </div>

        <div class="col-md-6">
            <label for="opcion2" class="form-label">Opción 2*</label>
            <input type="text" class="form-control" id="opcion2" name="opcion2">
        </div>
        
        <div class="col-md-6">
            <label for="opcion3" class="form-label">Opción 3*</label>
            <input type="text" class="form-control" id="opcion3" name="opcion3">
        </div>
        
        <div class="col-12">
            <label class="form-label">¿Cuál es la correcta?*</label>
            <div>
                <input type="radio" name="correcta" value="1" id="correcta1" checked>
                <label for="correcta1">Opción 1</label>
                
                <input type="radio" name="correcta" value="2" id="correcta2">
                <label for="correcta2">Opción 2</label>
                
                <input type="radio" name="correcta" value="3" id="correcta3">
                <label for="correcta3">Opción 3</label>
            </div>
        </div>

        <div class="col-12 mt-4">
            <button type="submit" name="guardar_pregunta" class="btn btn-primary">Guardar Pregunta</button>
        </div>
    </form>
    ';
}

include("inc/footer.php"); 
?>