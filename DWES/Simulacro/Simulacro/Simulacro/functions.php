<?php
function extraer_datos(): array {
    $fichero = "./usuarios.txt";
    $datos = [];

    if (file_exists($fichero)) {
        $contador = 0;
        $temp = [];
        foreach (file($fichero) as $linea) {
            if ($contador < 3) {
                $temp[$contador] = trim($linea);
                $contador++;
            }
            else {
                $datos[] = $temp;
                $contador = 0;
                $temp = [];
                $temp[$contador] = trim($linea);
                $contador++;
            }
        }
        $datos[] = $temp;
    }
    // print_r($datos);
    return $datos;
}


function comprobar_usuario($user, $pass, $datos): string {
    foreach ($datos as $usuario) {
        // var_dump(trim($usuario[0]));
        if ($user == $usuario[0] && $pass == $usuario[1]) {
            return $usuario[2];
        }
    }
    return "";
}