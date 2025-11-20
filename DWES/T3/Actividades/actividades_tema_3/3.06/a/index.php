<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Document</title>
        <meta name="author" content="David Ramos" />
        <link href="index.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
        include_once 'functions.php';
        
        if (!empty($_REQUEST['filas']) && !empty($_REQUEST['columnas'])) {
            mostrar_tabla();
        }
        else {
            pedir_filas_columnas();
        }
        ?>
    </body>
</html>