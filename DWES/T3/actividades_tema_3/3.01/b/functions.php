<?php
declare(strict_types=1);

function mostrarFormularioCalculadora(){
    echo '<form action="index.php" method="GET">';
    echo '<label for="numero1">Numero 1:</label>';
    echo '<input type="number" id="numero1" name="numero1">';
    echo '<label for="numero2">Numero 2:</label>';
    echo '<input type="number" id="numero2" name="numero2">';
    echo '<label for="operacion">Operacion:</label>';
    echo '<select id="operacion" name="operacion">';
    echo '<option value="suma">Suma</option>';
    echo '<option value="resta">Resta</option>';
    echo '<option value="multiplicacion">Multiplicacion</option>';
    echo '<option value="division">Division</option>';
    echo '</select>';
    echo '<input type="submit" value="Enviar">';
    echo '</form>';
}

function mostrarResultado(float $numero1, float $numero2, string $operacion){
    switch ($operacion) {
        case 'suma':
            $resultado = $numero1 + $numero2;
            break;
        case 'resta':
            $resultado = $numero1 - $numero2;
            break;
        case 'multiplicacion':
            $resultado = $numero1 * $numero2;
            break;
        case 'division':
            if ($numero2 == 0) {
                echo 'Error: No se puede dividir entre 0';
                return;
            } else {
                $resultado = $numero1 / $numero2;
            }
            break;
        case 'modulo':
            $resultado = $numero1 % $numero2;
            break;
        default:
            echo 'Error: Operacion no valida';
            return;
    }
    echo 'El resultado es: ' . $resultado;
}
