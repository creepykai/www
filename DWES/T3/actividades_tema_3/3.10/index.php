<?php
$barcelona = ['Barcelona' => 0, 'Coruña' => 1188, 'Madrid' => 621, 'Sevilla' => 1046];
$corunia = ['Barcelona' => 1188, 'Coruña' => 0, 'Madrid' => 609, 'Sevilla' => 947];
$madrid = ['Barcelona' => 621, 'Coruña' => 609, 'Madrid' => 0, 'Sevilla' => 538];
$sevilla = ['Barcelona' => 1046, 'Coruña' => 947, 'Madrid' => 538, 'Sevilla' => 0];

$distancias = [
    'Barcelona' => $barcelona,
    'Coruña' => $corunia,
    'Madrid' => $madrid,
    'Sevilla' => $sevilla
];
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Actividad 3.10</title>
    </head>
    <body>
        <?php
        if (!isset($_POST['ciudad1']) && !isset($_POST['ciudad2'])) {
            ?>
            <form method="post">
                <select name="ciudad1" id="ciudad1">
                    <?php
                    foreach ($distancias as $clave => $ciudad1) {
                        echo "<option value='$clave'>$clave</option>";
                    }
                    ?>
                </select>
                <select name="ciudad2" id="ciudad2">
                    <?php
                    foreach ($distancias as $clave => $ciudad2) {
                        echo "<option value='$clave'>$clave</option>";
                    }
                    ?>
                </select>
                <button type="submit">Enviar</button>
            </form>
        <?php
        }
        else {
            $ciudad1 = $_POST['ciudad1'] ?? 'Barcelona';
            $ciudad2 = $_POST['ciudad2'] ?? 'Barcelona';

            echo "$ciudad1 - $ciudad2: {$distancias[$ciudad1][$ciudad2]} Km";
        }
        ?>
    </body>
</html>
