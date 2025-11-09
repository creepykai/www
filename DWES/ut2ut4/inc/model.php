<?php
function read_players() : array {
    $players = [
        ['perro', 'pass', 'Perro', 'España', '222222222', 'a@b.com', '003.jpg'],
        ['elchokas', 'chocas', 'El Chocas', 'España', '666666666', 'chocas@b.com', '000.jpg'],
        ['mochi', '1234', 'Irene Diges', 'España', '3423432423', 'idig@gmail.com', 'avatar1.png']
    ];
    return $players;
}

function read_countries() : array {
    $ret = ['España', 'Andorra', 'Francia', 'Portugal'];
    return $ret;
}

function read_questions() : array {
    $ret = [];
    
    $ret[0] = ['Enunciado 1', 'No', 'OK', 'KO', 'Catt', 2];
    $ret[1] = ['Soy el 2', 'SI', 'NO', 'TAL VEZ', 'Catt2', 1];

    return $ret;
}
?>