<?php
declare(strict_types=1); //Tipado estricto 1 = TRUE 0 = FALSE

function mostrarFormulario(){
    echo '<form action="index.php" method="GET">';
    echo '<label for="nombre">Nombre:</label>';
    echo '<input type="text" id="nombre" name="nombre">';
    echo '<label for="apellidos">Apellidos:</label>';
    echo '<input type="text" id="apellidos" name="apellidos">';
    echo '<label for="direccion">Direccion:</label>';
    echo '<input type="text" id="direccion" name="direccion">';
    echo '<label for="telefono">Telefono:</label>';
    echo '<input type="text" id="telefono" name="telefono">';
    echo '<input type="submit" value="Enviar">';
    echo '</form>';
}

function mostrarDatos(string $name, string $apellidos, string $direccion, string $telefono){
    echo '<table>';
    echo '<tr>';
    echo '<th>Nombre</th>';
    echo '<th>Apellidos</th>';
    echo '<th>Direccion</th>';
    echo '<th>Telefono</th>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>'.$name.'</td>';
    echo '<td>'.$apellidos.'</td>';
    echo '<td>'.$direccion.'</td>';
    echo '<td>'.$telefono.'</td>';
    echo '</tr>';
    echo '</table>';
}
?>
