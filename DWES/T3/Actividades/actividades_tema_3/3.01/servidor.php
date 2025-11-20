<?php
$nombre = $_POST['nombre'] ?? 'No tiene nombre';
$apellido = $_POST['apellido'] ?? 'No tiene apellido';
$direccion = $_POST['direccion'] ?? 'No tiene direccion';
$telefono = $_POST['telefono'] ?? 'No tiene telefono';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Actividad 3.1</title>
    </head>
    <body>
        <table>
            <tr>
                <td>Nombre:</td>
                <td><?= $nombre ?></td>
            </tr>
            <tr>
                <td>Apellido:</td>
                <td><?= $apellido ?></td>
            </tr>
            <tr>
                <td>Direccion:</td>
                <td><?= $direccion ?></td>
            </tr>
            <tr>
                <td>Telefono:</td>
                <td><?= $telefono ?></td>
            </tr>
        </table>
    </body>
</html>