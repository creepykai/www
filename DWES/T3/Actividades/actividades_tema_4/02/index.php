<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Actividad 2</title>
        <link rel="stylesheet" href="/bootstrap-5.3.8-dist/css/bootstrap.min.css" />
        <script src="/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <a href="index.php">Inicio</a>
        <?php
        if (isset($_POST["ruta"]) && !empty(trim($_POST["ruta"]))) {
            if (isset($_POST["accion"]) && !empty($_POST["accion"])) {
                $ruta = $_POST["ruta"];
                $accion = $_POST["accion"];

                include_once("functions.php");

                switch ($accion) {
                    case "mostrar":
                        mostrar_archivo($ruta);
                        break;
                    case "aniadir":
                        aniadir_titulo($ruta);
                        break;
                    default:
                        break;
                }
            }
        }
        else if (isset($_POST["titulo"]) && !empty($_POST["titulo"]) && isset($_POST["autor"]) && !empty($_POST["autor"]) && isset($_POST["ruta"]) && !empty($_POST["ruta"])) {
            echo "pasa por aquí";
            $titulo = trim($_POST["titulo"]);
            $autor = trim($_POST["autor"]);
            $ruta = trim($_POST["ruta"]);
            guardar_fichero($ruta, $titulo, $autor);
        }
        else {
        ?>
        <form action="" method="post">
            <table class="">
                <tr>
                    <td><label for="ruta">Ruta al fichero:</label></td>
                    <td><input type="text" name="ruta" id="ruta" pattern=".*\.csv" required /></td>
                </tr>
                <tr>
                    <td><label for="">Acción:</label></td>
                    <td>
                        <input type="radio" name="accion" id="mostrar" value="mostrar" checked /><label for="mostrar">Mostrar</label>
                        <input type="radio" name="accion" id="aniadir" value="aniadir" /><label for="aniadir">Añadir</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><button type="submit">Enviar</button></td>
                </tr>
            </table>
        </form>
        <?php } ?>
    </body>
</html>