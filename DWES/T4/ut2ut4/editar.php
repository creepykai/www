<?php
$title = "Editar Preguntas";

include("inc/header.php"); 



$datosPregunta = []; 
$mensaje = "";
$idPregunta = null; // Variable en español camelCase

// 1. Lógica para CARGAR DATOS (Editar desde la URL)
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idPregunta = (int)$_GET['id'];
    $datosCargados = leerPreguntaPorId($idPregunta); // Uso de función leerPreguntaPorId()

    if ($datosCargados) {
       // Mapear los datos de la pregunta cargada [cite: 33]
        $datosPregunta = [
            'pregunta' => $datosCargados[0],
            'opcion1' => $datosCargados[1],
            'opcion2' => $datosCargados[2],
            'opcion3' => $datosCargados[3],
            'categoria' => $datosCargados[4],
            'correcta' => $datosCargados[5]
        ];
        $title = "Editar Pregunta #".$idPregunta;
    } else {
        $mensaje = "Error: Pregunta ID $idPregunta no encontrada. Se procederá a Añadir.";
        $idPregunta = null; 
    }
}

// 2. Lógica para GUARDAR DATOS (Añadir o Editar)
if (isset($_GET['guardar_pregunta'])) {
    
    // Obtener el ID de la pregunta si se está editando
    $idPreguntaRecibida = isset($_GET['idPregunta']) && is_numeric($_GET['idPregunta']) ? (int)$_GET['idPregunta'] : null;

    $datosAGuardar = [
        'pregunta' => $_GET['pregunta'] ?? '',
        'opcion1' => $_GET['opcion1'] ?? '',
        'opcion2' => $_GET['opcion2'] ?? '',
        'opcion3' => $_GET['opcion3'] ?? '',
        'correcta' => (int)($_GET['correcta'] ?? 0),
        'categoria' => $_GET['categoria'] ?? '',
    ];
   
    $informacionCompleta = !empty($datosAGuardar['pregunta']) && !empty($datosAGuardar['opcion1']) && !empty($datosAGuardar['opcion2']) && !empty($datosAGuardar['opcion3']) && !empty($datosAGuardar['categoria']) && in_array($datosAGuardar['correcta'], [1, 2, 3]);

    if (!$informacionCompleta) {
        $mensaje = "❌ ERROR: No se puede guardar. La información no está completa.";
    } elseif (guardarPregunta($datosAGuardar, $idPreguntaRecibida)) { 
        
       // El botón Guardar almacenará la información en el fichero "preguntas.txt" (simulado) [cite: 34]
        if ($idPreguntaRecibida !== null) {
            $mensaje = "✅ Pregunta #$idPreguntaRecibida editada con éxito (simulado).";
        } else {
            $mensaje = "✅ Nueva pregunta guardada con éxito (simulado).";
        }
        
        // Mantener los datos recién guardados en el formulario
        $datosPregunta = $datosAGuardar;
        $idPregunta = $idPreguntaRecibida;

    } else {
        $mensaje = "❌ Error al guardar la pregunta (fallo de simulación).";
    }
}



if (!$esAdmin) {
    echo "<h2>Acceso denegado</h2>";
    echo "<p>No tienes permisos de administrador para acceder a esta sección. Solo el usuario 'elchocas' puede editar preguntas.</p>";
} else {
    
    // Título dinámico
    $accion = $idPregunta !== null ? "Editar Pregunta #$idPregunta" : "Añadir Nueva Pregunta";
    echo "<h2>$accion</h2>";
    echo "<p>Rellena los campos para añadir una nueva pregunta al juego.</p>";

    if ($mensaje != "") {
        echo "<p style='color:green;'>$mensaje</p>";
    }

    echo '
    <form method="GET" action="editar.php" class="row g-3">
        <input type="hidden" name="idPregunta" value="'. htmlspecialchars($idPregunta ?? '') .'">

        <div class="col-12">
            <label for="pregunta" class="form-label">Enunciado de la Pregunta*</label>
            <textarea class="form-control" id="pregunta" name="pregunta" rows="3">'. htmlspecialchars($datosPregunta['pregunta'] ?? '') .'</textarea>
        </div>
        
        <div class="col-md-6">
            <label for="opcion1" class="form-label">Opción 1*</label>
            <input type="text" class="form-control" id="opcion1" name="opcion1" value="'. htmlspecialchars($datosPregunta['opcion1'] ?? '') .'">
        </div>
        <div class="col-md-6">
            <label for="categoria" class="form-label">Categoría*</label>
            <input type="text" class="form-control" id="categoria" name="categoria" value="'. htmlspecialchars($datosPregunta['categoria'] ?? '') .'">
        </div>

        <div class="col-md-6">
            <label for="opcion2" class="form-label">Opción 2*</label>
            <input type="text" class="form-control" id="opcion2" name="opcion2" value="'. htmlspecialchars($datosPregunta['opcion2'] ?? '') .'">
        </div>
        
        <div class="col-md-6">
            <label for="opcion3" class="form-label">Opción 3*</label>
            <input type="text" class="form-control" id="opcion3" name="opcion3" value="'. htmlspecialchars($datosPregunta['opcion3'] ?? '') .'">
        </div>
        
        <div class="col-12">
            <label class="form-label">¿Cuál es la correcta?*</label>
            <div>
                <input type="radio" name="correcta" value="1" id="correcta1" '. ((($datosPregunta['correcta'] ?? 1) == 1) ? 'checked' : '') .'>
                <label for="correcta1">Opción 1</label>
                
                <input type="radio" name="correcta" value="2" id="correcta2" '. ((($datosPregunta['correcta'] ?? 1) == 2) ? 'checked' : '') .'>
                <label for="correcta2">Opción 2</label>
                
                <input type="radio" name="correcta" value="3" id="correcta3" '. ((($datosPregunta['correcta'] ?? 1) == 3) ? 'checked' : '') .'>
                <label for="correcta3">Opción 3</label>
            </div>
        </div>

        <div class="col-12 mt-4">
            <button type="submit" name="guardar_pregunta" class="btn btn-primary">Guardar Pregunta</button>
            <a href="editar.php" class="btn btn-secondary">Añadir Nueva</a>
        </div>
    </form>
    ';
    
    // Listado de Preguntas para Edición
    $preguntasExistentes = leerPreguntas(); 
    if (!empty($preguntasExistentes)) {
        echo '<h3>Preguntas Existentes (Haga clic en Editar)</h3>';
        echo '<ul class="list-group">';
        foreach ($preguntasExistentes as $indice => $pregunta) {
            echo '<li class="list-group-item">';
            echo '<strong>ID ' . $indice . ':</strong> ' . htmlspecialchars($pregunta[0]) . ' ';
            echo '<a href="editar.php?id=' . $indice . '" class="btn btn-sm btn-info float-end">Editar</a>';
            echo '</li>';
        }
        echo '</ul>';
    }
}

include("inc/footer.php"); 
?>