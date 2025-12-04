<?php

$palos = ['hearts', 'diamonds', 'clubs', 'spades'];
$valores = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];

function crearBarajaFija(string $paloFijo, array $valores): array
{
    $baraja = [];
    foreach ($valores as $valor) {
        $baraja[] = ['valor' => $valor, 'palo' => $paloFijo];
    }
    shuffle($baraja);
    return $baraja;
}

function evaluarAcierto(string $valorPredicho, array $cartaSacada): int
{
    return ($valorPredicho === $cartaSacada['valor']) ? 5 : 0;
}

function getPartidaData(array $palos, array $valores): array
{
    $data = [
        'nombreJugador' => '',
        'paloFijo' => '',
        'puntos' => 0,
        'baraja' => [], 
        'mensajeRonda' => '',
        'terminada' => false,
        'finalizar' => false,
    ];

    if (isset($_GET['finalizar'])) {
        $data['finalizar'] = true;
        return $data;
    }

    if (isset($_GET['nombreJugador'], $_GET['paloFijo'], $_GET['puntos'], $_GET['baraja_serializada'])) {
        $data['nombreJugador'] = $_GET['nombreJugador'];
        $data['paloFijo'] = $_GET['paloFijo'];
        $data['puntos'] = (int)$_GET['puntos'];

        $barajaSerializada = $_GET['baraja_serializada'];
        $baraja = unserialize($barajaSerializada);

        if (!is_array($baraja)) {
            $data['terminada'] = true;
            $data['mensajeRonda'] = "<p style='color: red;'>Error al recuperar el estado de la partida.</p>";
            return $data;
        }
        $data['baraja'] = $baraja;

        if (isset($_GET['adivinar'], $_GET['valor']) && count($data['baraja']) > 0) {
            $valorPredicho = $_GET['valor'];
            
            $cartaSacada = array_pop($data['baraja']);
            $data['baraja'] = $data['baraja']; 

            $puntosGanados = evaluarAcierto($valorPredicho, $cartaSacada);
            $data['puntos'] += $puntosGanados;

            $rutaCarta = "cards/{$cartaSacada['palo']}/{$cartaSacada['valor']}.jpg";

            $data['mensajeRonda'] = "<h3>Jugador {$data['nombreJugador']} predijo: $valorPredicho</h3>";
            $data['mensajeRonda'] .= "<h3>La carta era:</h3>";

            if (file_exists($rutaCarta)) {
                $data['mensajeRonda'] .= "<img src='$rutaCarta' alt='Carta sacada: {$cartaSacada['valor']} de {$cartaSacada['palo']}' style='width:120px; border: 1px solid #333;'>";
            } else {
                $data['mensajeRonda'] .= "<p>Carta: {$cartaSacada['valor']} de " . ucfirst($cartaSacada['palo']) . " (No se encontró la imagen).</p>";
            }

            $data['mensajeRonda'] .= "<p>Puntos obtenidos: $puntosGanados</p>";
            
            if (count($data['baraja']) === 0) {
                $data['terminada'] = true;
                $data['mensajeRonda'] .= "<h3>¡La baraja se ha acabado! Fin de la partida.</h3>";
            }
        } else if (isset($_GET['adivinar']) && count($data['baraja']) === 0) {
             $data['terminada'] = true;
             $data['mensajeRonda'] = "<h3>¡La baraja se ha acabado! Fin de la partida.</h3>";
        }
        
    } elseif (isset($_GET['nombre'], $_GET['paloFijo'])) {
        $nombre = trim($_GET['nombre']);
        $paloFijo = $_GET['paloFijo'];

        if (!empty($nombre) && in_array($paloFijo, $palos)) {
            $data['nombreJugador'] = $nombre;
            $data['paloFijo'] = $paloFijo;
            $data['puntos'] = 0;
            $data['baraja'] = crearBarajaFija($paloFijo, $valores);
        } else {
             return ['finalizar' => true];
        }
    }
    
    if (count($data['baraja']) === 0 && !$data['terminada'] && !empty($data['nombreJugador'])) {
        $data['terminada'] = true;
        $data['mensajeRonda'] .= "<h3>¡La baraja se ha acabado! Fin de la partida.</h3>";
    }

    return $data;
}

$partida = getPartidaData($palos, $valores);

if ($partida['finalizar'] || empty($partida['nombreJugador'])) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Adivina la Carta - Inicio</title>
    </head>
    <body>
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
    </body>
    </html>
    <?php
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Adivina la Carta - Partida</title>
</head>
<body>
    <div>
        <h1>Adivina la carta</h1>
        
        <?php echo $partida['mensajeRonda']; ?>
        <p>Jugador: <?php echo $partida['nombreJugador']; ?> | Palo Elegido: <?php echo ucfirst($partida['paloFijo']); ?> | Puntuación Total: <?php echo $partida['puntos']; ?> puntos</p>
      
        <?php if ($partida['terminada']): ?>
            <h2>Partida Finalizada</h2>
            <form method="get" action="">
                <button type="submit" name="finalizar" value="1">Empezar otra partida</button>
            </form>

        <?php else: 
            
            $barajaSerializada = serialize($partida['baraja']);
            
            $valoresRestantes = array_column($partida['baraja'], 'valor');
            $valoresParaSelect = array_unique($valoresRestantes); 
            
            ?>
            <form method="get" action="">
                <input type="hidden" name="adivinar" value="1">
                <input type="hidden" name="nombreJugador" value="<?php echo htmlspecialchars($partida['nombreJugador']); ?>">
                <input type="hidden" name="paloFijo" value="<?php echo htmlspecialchars($partida['paloFijo']); ?>">
                <input type="hidden" name="puntos" value="<?php echo $partida['puntos']; ?>">
                <input type="hidden" name="baraja_serializada" value="<?php echo htmlspecialchars($barajaSerializada); ?>">
                
                <label for="valor">Valor:</label>
                <select name="valor" id="valor">
                    <?php 
                    foreach ($valoresParaSelect as $v): ?>
                        <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                    <?php endforeach; ?>
                </select>
                
                <button type="submit">Adivinar</button>
            </form> 
            <br>
            
            <form method="get" action="">
                <button type="submit" name="finalizar" value="1">Finalizar Partida</button>
            </form>

            <p>Cartas restantes en la baraja: <?php echo count($partida['baraja']); ?></p>
            
        <?php endif; ?>
    </div>
</body>
</html>