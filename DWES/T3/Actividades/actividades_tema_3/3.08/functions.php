<?php

function jugar($nombre, $jugada) {
    $dado_1 = rand(1, 6);
    $dado_2 = rand(1, 6);

    echo "<h1>Suerte, $nombre</h1>";
    echo "<h1>Jugada: $jugada</h1>";

    echo "<iframe src='img/$dado_1.svg' frameborder='0'></iframe>";
    echo "<iframe src='img/$dado_2.svg' frameborder='0'></iframe>";

    if ($dado_1 + $dado_2 == $jugada) {
        echo "<h1>¡¡¡Enhorabuena $nombre, has ganado!!!</h1>";
    }
    else echo "<h1>¡¡¡$nombre eres malísimo/a, has perdido!!!</h1>";
}


function pedir_jugada() {
    ?>
    <form action="" method="post">
        <input type="text" name="nombre" id="nombre" placeholder="Nombre" required />
        <input type="number" name="jugada" id="jugada" placeholder="Adivina la suma de los dados" required />
        <button type="submit">Jugar</button>
    </form>
    <?php
}
?>