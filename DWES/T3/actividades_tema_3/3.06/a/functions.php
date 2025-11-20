<?php

function td($contador) {
    echo "<td>".$contador."</td>";
}


function tr($contador) {
    echo "<tr>";
    echo td($contador);
    echo "</tr>";
}

function tabla($contador, $columnas) {
    echo "<table>";
    for ($i = 0; $i < $columnas; $i++) {
        echo tr($contador);
    }
    echo "</table>";
}


function mostrar_tabla() {
    $filas = $_REQUEST['filas'];
    $columnas = $_REQUEST['columnas'];
    $contador = 1;

    for ($i = 0; $i < $filas; $i++) {
        echo tabla($contador, $columnas);
    }
    $contador++;
}


function pedir_filas_columnas() {
    ?>
    <form action="" method="post">
        <table>
            <tr>
                <td>Filas:</td>
                <td><input type="text" name="filas" pattern="[0-9]+" /></td>
            </tr>
            <tr>
                <td>Columnas:</td>
                <td><input type="text" name="columnas" pattern="[0-9]+" /></td>
            </tr>
            <tr align="center">
                <td colspan="2"><input type="submit" value="Siguiente" /></td>
            </tr>
        </table>
    </form>
<?php } ?>