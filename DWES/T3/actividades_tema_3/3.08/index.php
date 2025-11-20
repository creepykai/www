<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Juego de Dados</title>
        <style>
            .dado {
                height: 150px;
                margin: 10px;
            }
            .ganador { color: green; }
            .perdedor { color: red; }
            .tablero-dados { margin: 20px 0; }
        </style>
    </head>
    <body>
        <?php
        include_once "functions.php";

        if (isset($_GET["nombre"]) && isset($_GET["jugada"])) {
            
            $nombre = $_GET["nombre"];
            // Casting a int obligatorio por el strict_types
            $jugada = (int) $_GET["jugada"];
            
            jugar($nombre, $jugada);

        } else {
            pedir_jugada();
        }
        ?>
    </body>
</html>