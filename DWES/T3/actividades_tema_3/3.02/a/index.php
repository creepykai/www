<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
</head>
<body>
    <?php
    include 'functions.php';

    if (isset($_GET['articulo1']) && isset($_GET['articulo2']) && isset($_GET['articulo3'])) {
        mostrarFactura(
            (int) $_GET['articulo1'], 
            (int) $_GET['articulo2'], 
            (int) $_GET['articulo3']);
    } else {
        mostrarFormulario();
    }
    ?>
</body>
</html>
