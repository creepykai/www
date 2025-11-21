<?php
// Define la función principal para simular el lanzamiento de dados y calcular pétalos.
declare(strict_types=1); 


function juego_dados() : int {
    $petalos = 0; // Inicializa el contador de pétalos.
    
    // Muestra el título principal.
    echo "<h2>Petalos Alrededor De La Rosa</h2>\n";
    
    // Simula el lanzamiento de 5 dados.
    for($i = 0; $i < 5; ++$i) {
        $dado = rand(1, 6); // Genera un número aleatorio entre 1 y 6.
        
        // Calcular pétalos según la cara del dado.
        // Solo las caras 3 y 5 tienen un punto central rodeado de pétalos.
        if ($dado == 3) {
            $petalos += 2; // El dado 3 tiene 2 pétalos alrededor del punto central.
        } else if ($dado == 5) {
            $petalos += 4; // El dado 5 tiene 4 pétalos alrededor del punto central.
        }
        
        // Muestra la imagen del dado correspondiente.
        echo "\t<img src=\"dados/dado$dado.png\" width=\"150px\" alt=\"Dado que muestra el número $dado\">\n";
    }
    
    return $petalos; // Devuelve el total de pétalos calculados.
}

// Define la función para imprimir el mensaje de resultado.
function imprimir_mensaje(string $nombre, int $prediccion, int $petalos) : void {
    // Convierte la predicción a entero para la comparación.
    $prediccion_int = intval($prediccion);
    
    echo "<div>\n";
    echo "<h3>Resultado</h3>\n";
    
    // Compara la predicción del usuario con el resultado real.
    if ($prediccion_int == $petalos) {
        // Mensaje de victoria.
        echo "<p style='color: green; font-weight: bold;'>¡Enhorabuena, $nombre!</p>";
    } else {
        // Mensaje de derrota.
        echo "<p style='color: red;'>Qué pena, $nombre.</p>";
    }
    
    // Muestra la predicción y el resultado real.
    echo "<p>Tú dijiste $prediccion_int pétalos y en realidad había $petalos.</p>";
    echo "</div>\n";
}
?>