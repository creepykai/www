<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actividad 3.1.b - Calculadora</title>
</head>
<body>
    <?php
    include_once 'functions.php';

    if (isset($_GET['numero1']) && isset($_GET['numero2'])) {
        mostrarResultado(
            (float) $_GET['numero1'], 
            (float) $_GET['numero2'], 
            (string) $_GET['operacion']
        );

    } else {
        mostrarFormularioCalculadora();
    }
    ?>
</body>
</html>