<?php
function mostrar_archivo($ruta) {
    $fichero = fopen($ruta, "r");
    // $datos = fgetcsv($fichero, 0, ";");

    echo "<table class='table table-striped'>";
    echo "<tr>";
    echo "<td>Titulo</td>";
    echo "<td>Autor</td>";
    echo "</tr>";
    while (($linea = fgetcsv($fichero, 0, ";")) !== FALSE) {
        ?>
        <tr>
            <td><?= $linea[0] ?></td>
            <td><?= $linea[1] ?></td>
        </tr>
        <?php
    }
    fclose($fichero);
    echo "</table>";
}


function aniadir_titulo($ruta) {
    $fichero = fopen($ruta, "r");
    // $datos = fgetcsv($fichero, 0, ";");

    echo "<form method='post'>";
    echo "<input type='text' name='ruta' id='ruta' value='{$ruta}' disabled hidden />";
    echo "<table class='table table-striped'>";
    echo "<tr>";
    echo "<td>Titulo</td>";
    echo "<td>Autor</td>";
    echo "</tr>";
    while (($linea = fgetcsv($fichero, 0, ";")) !== FALSE) {
        ?>
        <tr>
            <td><?= $linea[0] ?></td>
            <td><?= $linea[1] ?></td>
        </tr>
        <?php
    }
    echo "<tr>";
    echo "<td><input id='titulo' name='titulo' /></td>";
    echo "<td><input id='autor' name='autor' /></td>";
    echo "</tr>";
    echo "<tr align='center'>";
    echo "<td colspan='2'><button type='submit' class='btn btn-primary'>Guardar</button></td>";
    echo "</tr>";

    fclose($fichero);
    echo "</table>";
    echo "</form>";
}


function guardar_fichero($ruta, $titulo, $autor) {
    $fichero = fopen($ruta, "a");
    echo "\n{$titulo},{$autor}";
    fwrite( $fichero, "\n{$titulo},{$autor}");
    fclose($fichero);
}




// $path = $_GET["path"];
// if (($fp = @fopen($path, "r+")) == FLASE) {
//     $phtml .= "<p>No se puede abrir \"$path\"</p><br />";
//     $phtml .= show_form();
// }
?>