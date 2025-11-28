<?php
function leerJugadores() : array { 
    $jugadores = [
        ['perro', 'pass', 'Perro', 'España', '222222222', 'a@b.com', '003.jpg', 0],
        ['elchokas', 'chocas', 'El Chocas', 'España', '666666666', 'chocas@b.com', '000.jpg', 15],
        ['mochi', '1234', 'Irene Diges', 'España', '3423432423', 'idig@gmail.com', 'avatar1.png', 5]
    ];
    return $jugadores;
}

function leerPaises() : array { 
    $ret = ['España', 'Andorra', 'Francia', 'Portugal'];
    return $ret;
}

function leerPreguntas() : array { 
    $ret = [];
    // ... preguntas ...
    $ret[0] = ['Enunciado 1', 'No', 'OK', 'KO', 'Catt', 2];
    $ret[1] = ['Soy el 2', 'SI', 'NO', 'TAL VEZ', 'Catt2', 1];
    $ret[2] = ['Pregunta 3 de prueba', 'R1', 'R2', 'R3', 'Otra Catt', 3];
    return $ret;
}

function leerPreguntaPorId(int $id) : ?array {
    $preguntas = leerPreguntas();
    return $preguntas[$id] ?? null;
}

function guardarPregunta(array $datos, ?int $id = null) : bool {
    return true; 
}

function buscarJugadorPorUsuario(string $usuario) : ?array {
    $jugadores = leerJugadores();
    foreach ($jugadores as $jugador) {
        if ($jugador[0] === $usuario) {
            return $jugador;
        }
    }
    return null;
}

function guardarJugador(array $datos, string $usuario) : bool {
    return true; 
}
?>