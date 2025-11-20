<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actividad 3.1.a</title>
</head>
<body>
    <?php
    // 1. Cargamos las funciones
    include_once 'functions.php';

    // 2. Decisión: ¿Me han enviado el nombre?
    // Usamos !empty para comprobar si la variable NO está vacía 
    if (isset($_GET['nombre'])) {

        // CASO A: SÍ hay datos. 
        // Llamamos a la función y le pasamos los valores de la superglobal $_GET 
        // El orden es importante: debe coincidir con como definiste la función (nombre, apellidos, direccion, telefono)
        mostrarDatos(
            $_GET['nombre'], 
            $_GET['apellidos'], 
            $_GET['direccion'], 
            $_GET['telefono']
        );

    } else {
        
        // CASO B: NO hay datos (es la primera vez que entra).
        // Mostramos el formulario vacío.
        mostrarFormulario();
        
    }
    ?>
</body>
</html>