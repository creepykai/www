<?php
$nom = $_GET['nombre'] ?? ''; /*Si se usa _REQUEST cambiando el metodo (que por defecto es get)*/
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
        <table>
            <tr>
                <th>Nombre</th>
                <th>apellido</th>
            </tr>
            <tr>
                <td><?=$nom?></td>
                <td><?=$ape?></td>

            </tr>
        </table>



