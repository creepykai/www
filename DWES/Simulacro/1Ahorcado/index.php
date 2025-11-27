<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actividad 3.1.a</title>
</head>
<body>
    <?php
    include_once 'proceso.php';
    
    if (isset($_GET['nombre']) || isset($_GET['palabra_secreta'])) {
        ahorcado();
    } else {
      mostrarFormulario();
    }
    ?>
</body>
</html>