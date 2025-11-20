<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Document</title>
    </head>
    <body>
        <!-- <iframe src="img/1.svg" frameborder="0"></iframe> -->
        <?php
        include_once "functions.php";
        if (isset($_POST["nombre"]) && !empty($_POST["nombre"]) && isset($_POST["jugada"]) && !empty($_POST["jugada"])) {
            $nombre = $_POST["nombre"];
            $jugada = $_POST["jugada"];
            jugar($nombre, $jugada);
        }
        else {
            pedir_jugada();
        }
        ?>
    </body>
</html>