<?php
session_start();

$palos = ['hearts', 'diamonds', 'clubs', 'spades'];
$valores = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];

function crearBarajaCompleta($palos, $valores) : array {
    $baraja = [];
    foreach ($palos as $palo) {
        foreach ($valores as $valor) {
            $baraja[] = ['valor' => $valor, 'palo' => $palo];
        }
    }
    shuffle($baraja);
    return $baraja;
}

function crearBarajaFija($paloFijo, $valores) : array {
    $baraja = [];
    foreach ($valores as $valor) {
        $baraja[] = ['valor' => $valor, 'palo' => $paloFijo];
    }
    shuffle($baraja);
    return $baraja;
}

function finalizarPartida() {
    session_destroy();
}

function calcularPuntosRonda(string $valorPredicho, array $cartaSacada, string $paloFijo) : int {
    $puntosGanados = 0;
    
    if ($valorPredicho === $cartaSacada['valor']) {
        $puntosGanados += 5; 
    }
    
    return $puntosGanados;
}

if (isset($_GET['finalizar'])) {
    finalizarPartida();
}

$nombreJugador = $_SESSION['nombreJugador'] ?? '';
$paloFijo = $_SESSION['paloFijo'] ?? '';
$puntos = $_SESSION['puntos'] ?? [1 => 0];
$historial = $_SESSION['historial'] ?? [];
$mensajeRonda = '';
$valoresParaSelect = [];

if (isset($_SESSION['nombreJugador'])) {
    
    if (isset($_GET['adivinar'])) {
        $valorPredicho = $_GET['valor'] ?? null;
        $jugadorActual = 1;

        if (in_array($valorPredicho, $valores)) {
            
            $ultimo_indice = count($_SESSION['baraja']) - 1;
            $cartaSacada = $_SESSION['baraja'][$ultimo_indice];
            unset($_SESSION['baraja'][$ultimo_indice]);
    
            $puntosGanados = calcularPuntosRonda($valorPredicho, $cartaSacada, $paloFijo);
    
            $_SESSION['puntos'][$jugadorActual] += $puntosGanados;
            
            $puntos = $_SESSION['puntos']; 
    
            $rondaHistorial = [
                'jugador' => $nombreJugador,
                'prediccion' => ['valor' => $valorPredicho],
                'sacada' => $cartaSacada,
                'puntos' => $puntosGanados,
            ];
            $_SESSION['historial'][] = $rondaHistorial;
    
            $rutaCarta = "cards/{$cartaSacada['palo']}/{$cartaSacada['valor']}.jpg";
    
            $mensajeRonda = "<h3>Jugador $nombreJugador predijo: $valorPredicho</h3><h3>La carta era:</h3>";
    
            if (file_exists($rutaCarta)) {
                $mensajeRonda .= "<img src='$rutaCarta' alt='Carta sacada' style='width:120px; border: 1px solid #333;'>";
            } else {
                $mensajeRonda .= "<p>No se encontró la imagen de la carta.</p>";
            }
    
            $mensajeRonda .= "<p>Puntos obtenidos: $puntosGanados</p>";
    
            if ($_SESSION['puntos'][$jugadorActual] >= 20) {
                $_SESSION['partidaTerminada'] = "¡$nombreJugador ha alcanzado los 20 puntos y ha ganado la partida!";
            } elseif (count($_SESSION['baraja']) === 0) {
                $_SESSION['partidaTerminada'] = "¡La baraja se ha acabado! Fin de la partida.";
            }
        } else {
            $mensajeRonda = "<p style='color: red;'>Predicción de valor inválida. Intenta de nuevo.</p>";
        }
    }
    
    $valoresEnBarajaUnicos = [];
    foreach ($_SESSION['baraja'] as $carta) {
        $valoresEnBarajaUnicos[$carta['valor']] = true; 
    }

    $valoresParaSelect = [];
    foreach ($valores as $valorOriginal) {
        if (isset($valoresEnBarajaUnicos[$valorOriginal])) {
            $valoresParaSelect[] = $valorOriginal;
        }
    }

} else {
    
    if (isset($_GET['nombre']) && isset($_GET['paloFijo'])) {
        $nombre = trim($_GET['nombre']);
        $paloFijo = $_GET['paloFijo'];

        if (!empty($nombre) && in_array($paloFijo, $palos)) {
            $_SESSION['nombreJugador'] = $nombre;
            $_SESSION['paloFijo'] = $paloFijo; 
            $_SESSION['puntos'] = [1 => 0];
            $_SESSION['baraja'] = crearBarajaFija($paloFijo, $valores);
            $_SESSION['historial'] = [];
            
            $nombreJugador = $nombre;
            $paloFijo = $paloFijo;
            $puntos = $_SESSION['puntos'];

            $valoresEnBarajaUnicos = [];
            foreach ($_SESSION['baraja'] as $carta) {
                $valoresEnBarajaUnicos[$carta['valor']] = true; 
            }

            $valoresParaSelect = [];
            foreach ($valores as $valorOriginal) {
                if (isset($valoresEnBarajaUnicos[$valorOriginal])) {
                    $valoresParaSelect[] = $valorOriginal;
                }
            }
        }
    } else {
        ?>
        <h1>Juego: Adivina la carta (Un Jugador)</h1>
        <form action="" method="get">
            <label for="nombre">Ingresa tu Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>
            <br><br>
            <label for="paloFijo">Elige el Palo de la Baraja para Jugar:</label>
            <select name="paloFijo" id="paloFijo">
                <?php foreach ($palos as $p): ?>
                    <option value="<?php echo $p; ?>"><?php echo ucfirst($p); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Empezar Partida</button>
        </form>
        <?php
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Adivina la Carta</title>
</head>
<body>
    <h1>Adivina la carta</h1>

    <?php if (isset($_SESSION['partidaTerminada'])): ?>
        <h2>Partida Finalizada</h2>
        <p><strong><?php echo $_SESSION['partidaTerminada']; ?></strong></p>
        <?php echo mostrarPuntuacionesTotales($puntos, $nombreJugador); ?>
        <form method="get" action="">
            <button type="submit" name="finalizar" value="1">Empezar otra partida</button>
        </form>

    <?php elseif (isset($_SESSION['nombreJugador'])): ?>
        <?php echo $mensajeRonda; ?>
        <form method="get" action="">
            <input type="hidden" name="adivinar" value="1">
            <?php echo mostrarPuntuacionesTotales($puntos, $nombreJugador); ?> <br><br>
            <label for="valor">Valor:</label>
            <select name="valor" id="valor">
                <?php 
                foreach ($valoresParaSelect as $v): ?>
                    <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                <?php endforeach; ?>
            </select>
            
            <button type="submit">Adivinar</button>
        </form> <br>

        <form method="get" action="">
            <button type="submit" name="finalizar" value="1">Finalizar</button>
        </form>

    <?php endif; ?>

</body>
</html>

<?php
function mostrarPuntuacionesTotales($puntos) {
    $puntuacion = $puntos[1] ?? 0; 
    $html = "Puntuación Total: $puntuacion puntos";
    return $html;
}
?>