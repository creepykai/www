<?php
declare(strict_types=1);

const PALABRAS_ALEATORIAS = [
    "Queso",
    "Fresa",
    "Mochi",
    "Percha",
    "Comida"
];

const MAX_ERRORES = 10;

function mostrarFormulario(){
    echo '<h2>Adivina la palabra</h2>';
    echo '<form action="index.php" method="GET">';
    echo '<label for="nombre">Nombre del jugador:</label>';
    echo '<input type="text" id="nombre" name="nombre" required>';
    echo '<input type="submit" value="Jugar">';
    echo '</form>';
}

const ABECEDARIO = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","ñ","o","p","q","r","s","t","u","v","w","x","y","z"];

function definirPalabraSecreta(): string {
    $palabra_secreta = PALABRAS_ALEATORIAS[rand(0, count(PALABRAS_ALEATORIAS) - 1)];
    return strtolower($palabra_secreta);
}

function mostrar_imagen_ahorcado(int $errores): void {
    echo '<div>';
    echo '<img src= "hangman/' . $errores . '.jpg">';
    echo '</div>';
}

function mostrar_tablero(string $palabra_secreta, string $letras_adivinadas_str, string $nombre_jugador, int $errores): void {
    
    $letras_adivinadas = str_split($letras_adivinadas_str);
    $letras_erroneas = [];
    
    foreach ($letras_adivinadas as $letra) {
        if (!str_contains($palabra_secreta, $letra)) {
            $letras_erroneas[] = $letra;
        }
    }
    
    echo '<h1>Adivina la palabra</h1>';
    echo '<p>Jugador ' . htmlspecialchars($nombre_jugador) . ' predijo: ' . end($letras_adivinadas) . '</p>';
    
    if (!empty($letras_adivinadas) && $errores > 0) {
        $ultima_letra = end($letras_adivinadas);
        if (in_array($ultima_letra, $letras_erroneas)) {
             echo '<p>Esa letra no aparece en la palabra</p>';
        } else {
             echo '<p>Esa letra aparece en la palabra</p>';
        }
    }

    echo '<p>Quedan ' . (MAX_ERRORES - $errores) . ' intentos</p>';

    mostrar_imagen_ahorcado($errores);

    $salida_palabra = '';
    
    for ($i = 0; $i < strlen($palabra_secreta); $i++) {
        $letra = $palabra_secreta[$i];
        if (str_contains($letras_adivinadas_str, $letra)) {
            $salida_palabra .= $letra . ' ';
        } else {
            $salida_palabra .= '_ ';
        }
    }
    
    echo '<h2>' . $salida_palabra . '</h2>';
}

function ahorcado(): void {
    
    $nombre_jugador = $_GET['nombre'] ?? 'Invitado';

    $palabra_secreta = $_GET['palabra_secreta'] ?? '';
    $letras_adivinadas_str = strtolower($_GET['letras_adivinadas'] ?? ''); 
    $errores = (int) ($_GET['errores'] ?? 0);
    $letra_recibida = strtolower($_GET['Letra'] ?? '');
    
    if (empty($palabra_secreta) || isset($_GET['reiniciar'])) {
        $palabra_secreta = definirPalabraSecreta();
        $letras_adivinadas_str = '';
        $errores = 0;
        $letra_recibida = '';
    }

    $juego_activo = true;
    $mensaje = '';

    if (!empty($letra_recibida) && $juego_activo) {
        
        if (!str_contains($letras_adivinadas_str, $letra_recibida)) {
            
            $letras_adivinadas_str .= $letra_recibida;
            
            if (!str_contains($palabra_secreta, $letra_recibida)) {
                $errores++;
            }
        }
    }

    mostrar_tablero($palabra_secreta, $letras_adivinadas_str, $nombre_jugador, $errores);

    if ($errores >= MAX_ERRORES) {
        $juego_activo = false;
        $mensaje = '¡El juego ha terminado! Has perdido. La palabra era: ' . htmlspecialchars($palabra_secreta);
    }

    $letras_pendientes = 0;
    foreach (str_split($palabra_secreta) as $letra) {
        if (!str_contains($letras_adivinadas_str, $letra)) {
            $letras_pendientes++;
        }
    }

    if ($letras_pendientes === 0) {
        $juego_activo = false;
        $mensaje = '¡Felicidades, has ganado! La palabra era: ' . htmlspecialchars($palabra_secreta);
    }
    
    if (!empty($mensaje)) {
        echo '<h2>' . $mensaje . '</h2>';
    }


    if ($juego_activo) {
        echo '<form action="index.php" method="GET">';
        echo '<label for="Letra">Letra:</label>';
        echo '<select id="estilo" name="Letra">';
        
        foreach (ABECEDARIO as $letra) {
            if (!str_contains($letras_adivinadas_str, $letra)) {
                echo '<option value="' . $letra . '">'. $letra .'</option>';
            }
        }

        echo '</select><br><br>';
        echo '<input type="submit" value="Adivinar">';
        echo '<input type="submit" name="reiniciar" value="Finalizar">';
        
        echo '<input type="hidden" name="nombre" value="' . htmlspecialchars($nombre_jugador) . '">';
        echo '<input type="hidden" name="palabra_secreta" value="' . htmlspecialchars($palabra_secreta) . '">';
        echo '<input type="hidden" name="letras_adivinadas" value="' . htmlspecialchars($letras_adivinadas_str) . '">';
        echo '<input type="hidden" name="errores" value="' . $errores . '">';
        
        echo '</form>';
        
    } else {
        echo '<h2>Juego nuevo</h2>';
        echo '<form action="index.php" method="GET">';
        echo '<input type="hidden" name="nombre" value="' . htmlspecialchars($nombre_jugador) . '">';
        echo '<input type="submit" name="reiniciar" value="Jugar de nuevo">';
        echo '</form>';
    }
}