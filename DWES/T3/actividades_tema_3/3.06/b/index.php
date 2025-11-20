<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Document</title>
        <meta name="author" content="David Ramos" />
    </head>
    <body>
        <?php
        include_once 'functions.php';
        
        if (!empty($_REQUEST['nombre']) && !empty($_REQUEST['apellido']) && !empty($_REQUEST['direccion']) && !empty($_REQUEST['telefono'])) {
            mostrar_resultados();
        }
        else {
            mostrar_formulario();
        }
        ?>
    </body>
</html>