<?php
declare(strict_types=1); 

function jugar(string $nombre, int $jugada) {
    $dado_1 = rand(1, 6);
    $dado_2 = rand(1, 6);
    $suma = $dado_1 + $dado_2;

    echo "<h1>Suerte, $nombre</h1>";
    echo "<h2>Tu apuesta: $jugada</h2>";

    echo "<div class='tablero-dados'>";
    // Usamos la ruta 'dados/' y extensión .png
    echo "<img src='dados/dado$dado_1.png' alt='Dado $dado_1' class='dado'>";
    echo "<img src='dados/dado$dado_2.png' alt='Dado $dado_2' class='dado'>";
    echo "</div>";

    echo "<h3>Resultado final: $suma</h3>";

    if ($suma === $jugada) {
        echo "<h1 class='ganador'>¡¡¡Enhorabuena $nombre, has ganado!!!</h1>";
    } else {
        echo "<h1 class='perdedor'>¡¡¡$nombre has perdido!!!</h1>";
    }
    
    echo '<br><a href="index.php"><button>Volver a intentar</button></a>';
}

function pedir_jugada() {
    // Usamos el estilo clásico de echo con comillas simples
    // Action vacío para enviar al mismo fichero
    echo '<form action="" method="GET">';
    
    echo '<p>';
    echo '<label for="nombre">Nombre:</label><br>';
    echo '<input type="text" name="nombre" id="nombre" placeholder="Tu Nombre" required />';
    echo '</p>';
    
    echo '<p>';
    echo '<label for="jugada">Adivina la suma (2-12):</label><br>';
    echo '<input type="number" name="jugada" id="jugada" min="2" max="12" placeholder="Ej: 7" required />';
    echo '</p>';
    
    echo '<button type="submit">Lanzar Dados</button>';
    echo '</form>';
}
?>