<?php
$nom = $_GET['nombre'] ?? '';
$ape = $_GET['apellido'] ?? '';
$dir = $_GET['direccion'] ?? '';
$tlf = $_GET['telefono'] ?? '';
?>
        <meta charset="UTF-8">


        <tr>
            <th>Nombre</th>
        </tr>
        <tr>
            <td><?=$nom?></td>
        </tr>

