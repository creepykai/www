<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 3.3 - Formatos</title>
</head>
<body>
    <?php
    include_once 'functions.php'; // Mejor include_once para evitar errores

    // Comprobamos si el usuario ha enviado el texto
    if (isset($_GET['texto'])) {
        
        // Llamamos a la función pasando los datos.
        // ¡OJO! Convertimos el tamaño a entero (int) para cumplir el tipado estricto
        mostrarResultado(
            (string) $_GET['texto'],
            (string) $_GET['estilo'],
            (int) $_GET['tamano'], 
            (string) $_GET['color']
        );

    } else {
        // Si no hay datos, mostramos el formulario
        mostrarFormulario();
    }
    ?>
</body>
</html>