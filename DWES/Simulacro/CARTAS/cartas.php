<?php
// Iniciar sesión para mantener el estado del juego
session_start();

// Definiciones de la baraja francesa
$palos = ['corazones', 'diamantes', 'treboles', 'picas'];
// Usamos los mismos valores que en el original: A, 2-10, J, Q, K
$valores = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];

// --- FUNCIONES DE INICIALIZACIÓN/TERMINACIÓN ---

// Función para inicializar la baraja completa
function crear_baraja($palos, $valores) : array {
    $baraja = [];
    foreach ($palos as $palo) {
        foreach ($valores as $valor) {
            $baraja[] = ['valor' => $valor, 'palo' => $palo];
        }
    }
    shuffle($baraja); // Mezclar la baraja
    return $baraja;
}

// Función para terminar y reiniciar el juego
function finalizar_partida() {
    session_destroy();
}

// --- MANEJO DE ACCIONES ---

// 1. Finalizar partida (se usa GET para la acción de finalizar) [cite: 6, 11]
if (isset($_GET['finalizar'])) {
    finalizar_partida();
}

// 2. Selección de jugadores / Inicio de partida [cite: 2]
if (!isset($_SESSION['num_jugadores'])) {
    // Si se envía el formulario de inicio
    if (isset($_GET['num_jugadores'])) {
        $num_jugadores = intval($_GET['num_jugadores']);
        if ($num_jugadores >= 1 && $num_jugadores <= 4) {
            // Inicializar el estado del juego en la sesión
            $_SESSION['num_jugadores'] = $num_jugadores;
            $_SESSION['turno'] = 1; // El juego comienza con el Jugador 1
            $_SESSION['puntos'] = [];
            for ($i = 1; $i<= $num_jugadores ; $i++) {
                $_SESSION['puntos'][$i] = 0;
            } // Puntos iniciales a 0 para todos
            $_SESSION['baraja'] = crear_baraja($palos, $valores); // Crear y guardar la baraja 
            $_SESSION['historial'] = []; // Guardar el historial de rondas
        }
    } else {
        // Mostrar el formulario de selección de jugadores
        ?>
        <h1>Juego: Adivina la carta</h1>
        <form method="get" action="">
            <label for="num_jugadores">Número de jugadores (1 a 4)</label>
            <select name="num_jugadores" id="num_jugadores">
                <?php for ($i = 1; $i <= 4; $i++): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
            <button type="submit">Jugar</button>
        </form>
        <?php
        exit;
    }
}

// Estado del juego desde la sesión
$num_jugadores = $_SESSION['num_jugadores'];
$turno = $_SESSION['turno'];
$puntos = $_SESSION['puntos'];
$baraja = $_SESSION['baraja'];
$historial = $_SESSION['historial'];

// --- LÓGICA DEL JUEGO / PROCESAR PREDICCIÓN ---

$mensaje_ronda = '';

if (isset($_GET['adivinar'])) {
    $valor_predicho = $_GET['valor'] ?? null;
    $palo_predicho = $_GET['palo'] ?? null;
    $jugador_actual = $turno; // El turno actual es el que hizo la predicción

    if (in_array($valor_predicho, $valores) && in_array($palo_predicho, $palos)) {

        // 1. Sacar la carta de la baraja (usando pop ya que está barajada) 
        $carta_sacada = array_pop($_SESSION['baraja']);

        // 2. Calcular puntos [cite: 4]
        $puntos_ganados = 0;
        if ($valor_predicho === $carta_sacada['valor']) $puntos_ganados += 5; // 5 puntos por valor
        if ($palo_predicho === $carta_sacada['palo']) $puntos_ganados += 2; // 2 puntos por palo

        // 3. Actualizar puntos totales [cite: 4]
        $_SESSION['puntos'][$jugador_actual] += $puntos_ganados;

        // 4. Guardar historial de la ronda
        $ronda_historial = [
            'jugador' => $jugador_actual,
            'prediccion' => ['valor' => $valor_predicho, 'palo' => $palo_predicho],
            'sacada' => $carta_sacada,
            'puntos' => $puntos_ganados,
        ];
        $_SESSION['historial'][] = $ronda_historial;

        // 5. Preparar mensaje de resultado
        $ruta_carta = "cards/{$carta_sacada['palo']}/{$carta_sacada['valor']}_de_{$carta_sacada['palo']}.jpg";

        $mensaje_ronda = "
            <hr>
            <h3>Resultado de la ronda (Jugador $jugador_actual)</h3>
            <p>Tu predicción: **$valor_predicho de " . ucfirst($palo_predicho) . "**</p>
            <h3>La carta era: **{$carta_sacada['valor']} de " . ucfirst($carta_sacada['palo']) . "**</h3>
        ";

        if (file_exists($ruta_carta)) {
            $mensaje_ronda .= "<img src='$ruta_carta' alt='Carta sacada' style='width:120px; border: 1px solid #333;'> [cite: 5]";
        } else {
            $mensaje_ronda .= "<p>No se encontró la imagen de la carta.</p>";
        }

        $mensaje_ronda .= "<p>Puntos obtenidos en la ronda: **$puntos_ganados**</p>";

        // 6. Avanzar turno
        $nuevo_turno = $turno + 1;
        if ($nuevo_turno > $num_jugadores) {
            $nuevo_turno = 1;
        }
        $_SESSION['turno'] = $nuevo_turno;

        // 7. Comprobar condiciones de fin de partida 
        if ($_SESSION['puntos'][$jugador_actual] >= 20) {
            $_SESSION['partida_terminada'] = "El **Jugador $jugador_actual** ha alcanzado los 20 puntos y ¡ha ganado la partida!";
        } elseif (count($_SESSION['baraja']) === 0) {
            $_SESSION['partida_terminada'] = "¡La baraja se ha acabado! Fin de la partida.";
        }
    } else {
        $mensaje_ronda = "<p style='color: red;'>Predicción inválida. Intenta de nuevo.</p>";
    }
}


// --- MOSTRAR PANTALLA DE JUEGO O FIN DE PARTIDA ---

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Adivina la Carta</title>
</head>
<body>
    <h1>Adivina la carta</h1>

    <?php if (isset($_SESSION['partida_terminada'])): ?>
        <h2>Partida Finalizada</h2>
        <p><strong><?php echo $_SESSION['partida_terminada']; ?></strong></p>
        <?php echo mostrar_puntuaciones_totales($_SESSION['puntos']); ?>
        <form method="get" action="">
            <button type="submit" name="finalizar" value="1">Empezar otra partida</button>
        </form>

    <?php else: ?>
        <?php echo $mensaje_ronda; ?>

        <h2>Turno del Jugador <?php echo $_SESSION['turno']; ?></h2>

        <form method="get" action="">
            <input type="hidden" name="adivinar" value="1">

            <label for="valor">¿Qué valor tendrá la siguiente carta?</label>
            <select name="valor" id="valor">
                <?php foreach ($valores as $v): ?>
                    <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                <?php endforeach; ?>
            </select>
            
            <label for="palo">¿De qué palo?</label>
            <select name="palo" id="palo">
                <?php foreach ($palos as $p): ?>
                    <option value="<?php echo $p; ?>"><?php echo ucfirst($p); ?></option>
                <?php endforeach; ?>
            </select>
            
            <button type="submit">Adivinar</button>
        </form>

        <hr>
        
        <?php echo mostrar_puntuaciones_totales($_SESSION['puntos']); ?>

        <form method="get" action="">
            <button type="submit" name="finalizar" value="1">Finalizar partida</button> [cite: 6]
        </form>

    <?php endif; ?>

</body>
</html>

<?php
// Función auxiliar para mostrar las puntuaciones totales
function mostrar_puntuaciones_totales($puntos) {
    $html = "<h3>Puntuaciones totales</h3>";
    $html .= "<ul>";
    foreach ($puntos as $jugador => $puntuacion) {
        $html .= "<li>Jugador $jugador: **$puntuacion** puntos</li>";
    }
    $html .= "</ul>";
    return $html;
}
?>