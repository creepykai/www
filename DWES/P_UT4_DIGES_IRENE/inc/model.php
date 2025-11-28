<?php
// Defino las rutas usando __DIR__ para que PHP sepa siempre dónde están los ficheros
// (salgo de la carpeta 'inc' con /../ para ir a la raíz)
define('FILE_JUGADORES', __DIR__ . '/../jugadores.csv');
define('FILE_PREGUNTAS', __DIR__ . '/../preguntas.txt');
define('FILE_PAISES',    __DIR__ . '/../paises.txt');
define('FILE_PARTIDAS',  __DIR__ . '/../partidas.csv');


// Funciones para leer jugadores y calcular puntuación cruzando datos con partidas.csv
function leerJugadores() : array {
    $jugadores = [];
    
    if (file_exists(FILE_JUGADORES)) {
        $lineas = file(FILE_JUGADORES, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lineas !== false) {
            foreach ($lineas as $linea) {
                $datos = explode(';', $linea);
                // Si el fichero no tiene 7 campos, lo descarto
                if (count($datos) >= 7) {
                    $datos[7] = 0; // Inicializo la puntuación a 0
                    $jugadores[] = $datos;
                }
            }
        }
    }

    //Ahora leo el historial de partidas para actualizar el récord de cada jugador

    if (file_exists(FILE_PARTIDAS)) {
        $lineasPartidas = file(FILE_PARTIDAS, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lineasPartidas !== false) {
            foreach ($lineasPartidas as $lp) {
                $partida = explode(';', $lp); 
                if (count($partida) >= 3) {
                    $usuarioPartida = $partida[1];
                    $puntosPartida = (int)$partida[2];

                    //Recorro todos los jugadores para actualizar su récord
                    foreach ($jugadores as &$j) {
                        if ($j[0] == $usuarioPartida) {
                            //Si el récord es mayor que el récord actual, lo actualizo
                            if ($puntosPartida > $j[7]) {
                                $j[7] = $puntosPartida;
                            }
                        }
                    }
                }
            }
        }
    }
    return $jugadores;
}


//Lee los paises del txt para el perfil
function leerPaises() : array {
    if (!file_exists(FILE_PAISES)) return [];
    
    $contenido = file(FILE_PAISES, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    //Si falla, devuelve un array vacío
    return $contenido === false ? [] : $contenido;
}

//Lee las preguntas del txt para jugar
function leerPreguntas() : array {
    $preguntas = [];
    if (file_exists(FILE_PREGUNTAS)) {
        $lineas = file(FILE_PREGUNTAS, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lineas !== false) {
            foreach ($lineas as $linea) {
                $datos = explode(';', $linea);
                if (count($datos) >= 6) {
                    $preguntas[] = $datos;
                }
            }
        }
    }
    return $preguntas;
}

//Lee una pregunta por id para editar
function leerPreguntaPorId(int $id) : ?array {
    $todas = leerPreguntas();
    return $todas[$id] ?? null;
}

//Busca un jugador por usuario para editar
function buscarJugadorPorUsuario(string $usuario) : ?array {
    $jugadores = leerJugadores();
    foreach ($jugadores as $jugador) {
        if ($jugador[0] === $usuario) {
            return $jugador;
        }
    }
    return null;
}

//Guarda una pregunta en el txt para editar
function guardarPregunta(array $datos, ?int $id = null) : bool {
    $todas = leerPreguntas();
    
    $nuevaLineaArray = [
        $datos['pregunta'],
        $datos['opcion1'],
        $datos['opcion2'],
        $datos['opcion3'],
        $datos['categoria'],
        $datos['correcta']
    ];
    //Si el id es null, es una nueva pregunta, sino es una pregunta existente
    if ($id !== null && isset($todas[$id])) {
        $todas[$id] = $nuevaLineaArray;
    } else {
        $todas[] = $nuevaLineaArray;
    }

    $contenido = "";
    foreach ($todas as $p) {
        $contenido .= implode(';', $p) . PHP_EOL;
    }
    
    return file_put_contents(FILE_PREGUNTAS, $contenido) !== false;
}
    
//Guarda un jugador en el txt para editar
function guardarJugador(array $datos, string $usuario) : bool {
    $jugadores = leerJugadores();
    $encontrado = false;
    
    $nuevoRegistro = [
        $datos['username'],
        $datos['password'],
        $datos['nombreCompleto'],
        $datos['pais'],
        $datos['telefono'],
        $datos['correo'],
        $datos['avatar']
    ];

    foreach ($jugadores as $key => $j) {
        if ($j[0] == $usuario) {
            $jugadores[$key] = $nuevoRegistro; 
            $encontrado = true;
            break;
        }
    }

    if (!$encontrado) {
        $jugadores[] = $nuevoRegistro;
    }

    $contenido = "";
    foreach ($jugadores as $j) {
        $camposGuardar = array_slice($j, 0, 7);
        $contenido .= implode(';', $camposGuardar) . PHP_EOL;
    }

    return file_put_contents(FILE_JUGADORES, $contenido) !== false;
}

function guardarPartida(string $usuario, int $puntos, int $totales, int $acertadas) : bool {
    $fecha = date('Y-m-d H:i:s');
    $linea = implode(';', [$fecha, $usuario, $puntos, $totales, $acertadas]) . PHP_EOL;
    return file_put_contents(FILE_PARTIDAS, $linea, FILE_APPEND) !== false;
}
?>