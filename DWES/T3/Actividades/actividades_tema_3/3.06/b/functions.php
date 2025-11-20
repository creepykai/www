<?php

function mostrar_resultados() {
    $nombre = $_REQUEST['nombre'];
    $apellido = $_REQUEST['apellido'];
    $direccion = $_REQUEST['direccion'];
    $telefono = $_REQUEST['telefono'];

    ?>
    <table>
        <tr>
            <td>Nombre:</td>
            <td><?php echo $nombre ?></td>
        </tr>
        <tr>
            <td>Apellido:</td>
            <td><?php echo $apellido ?></td>
        </tr>
        <tr>
            <td>Dirección:</td>
            <td><?php echo $direccion ?></td>
        </tr>
        <tr>
            <td>Teléfono:</td>
            <td><?php echo $telefono ?></td>
        </tr>
    </table>
    <?php
}

function mostrar_formulario() {
    ?>
    <form action="" method="post">
        <table>
            <tr>
                <td>Nombre:</td>
                <td><input type="text" name="nombre" pattern="[A-Za-z]+" /></td>
            </tr>
            <tr>
                <td>Apellido:</td>
                <td><input type="text" name="apellido" pattern="[A-Za-z]+" /></td>
            </tr>
            <tr>
                <td>Dirección:</td>
                <td><input type="text" name="direccion" pattern="[A-Za-z0-9\s]+" /></td>
            </tr>
            <tr>
                <td>Teléfono:</td>
                <td><input type="text" name="telefono" pattern="[0-9]{9}" /></td>
            </tr>
            <tr align="center">
                <td colspan="2"><input type="submit" value="Enviar" /></td>
            </tr>
        </table>
    </form>
    <?php
}

?>