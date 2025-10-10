<?php
$nom = $_GET['nombre'] ?? ''; /* Si se usa $_REQUEST cambiando el método (que por defecto es GET) */
$ape = $_GET['apellido'] ?? '';
$dir = $_GET['direccion'] ?? '';
$tlf = $_GET['telefono'] ?? '';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Actividad 1</title>
    </head>
    <body>
        <h1>Datos recibidos</h1>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Dirección</th>
                <th>Teléfono</th>
            </tr>
            <tr>
                <td><?= $nom ?></td>
                <td><?= $ape ?></td>
                <td><?= $dir ?></td>
                <td><?= $tlf ?></td>
            </tr>
        </table>
    </body>
</html>




