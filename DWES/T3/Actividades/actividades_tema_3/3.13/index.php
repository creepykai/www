<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Actividad 3.11</title>
        <style>
            img {
                height: 256px;
            }
        </style>
    </head>
    <body>
        <form action="" method="get">
            <table>
                <tr align="center">
                <?php
                if (isset($_GET["carta"])) {
                    $cartaSeleccionada = $_GET["carta"];
                    $cartas = [
                        "spades1",
                        "spades2",
                        "spades3"
                    ];
                    shuffle($cartas);

                    ?>
                    <td><label for="carta1"><img src="./picas1-9/<?= $cartas[0] ?>.png" alt="Carta 1" /></label></td>
                    <td><label for="carta2"><img src="./picas1-9/<?= $cartas[1] ?>.png" alt="Carta 2" /></label></td>
                    <td><label for="carta3"><img src="./picas1-9/<?= $cartas[2] ?>.png" alt="Carta 3" /></label></td>
                    <?php
                    switch ($cartaSeleccionada) {
                        case "carta1":
                            if ($cartas[0] == "spades1") {
                                echo "<p>Seleccionaste la carta 1. Has ganado.</p>";
                            }
                            else {
                                echo "<p>Seleccionaste la carta 1. Intentalo de nuevo.</p>";
                            }
                            break;
                        case "carta2":
                            if ($cartas[1] == "spades1") {
                                echo "<p>Seleccionaste la carta 2. Has ganado.</p>";
                            }
                            else {
                                echo "<p>Seleccionaste la carta 2. Intentalo de nuevo.</p>";
                            }
                            break;
                        case "carta3":
                            if ($cartas[2] == "spades1") {
                                echo "<p>Seleccionaste la carta 3. Has ganado.</p>";
                            }
                            else {
                                echo "<p>Seleccionaste la carta 3. Intentalo de nuevo.</p>";
                            }
                            break;
                        default:
                            break;
                    }
                }
                else {
                ?>
                    <td><label for="carta1"><img src="./picas1-9/back.png" alt="Carta 1" /></label></td>
                    <td><label for="carta2"><img src="./picas1-9/back.png" alt="Carta 2" /></label></td>
                    <td><label for="carta3"><img src="./picas1-9/back.png" alt="Carta 3" /></label></td>
                <?php } ?>
                </tr>
                <tr align="center">
                    <td><input type="radio" name="carta" id="carta1" value="carta1" /></td>
                    <td><input type="radio" name="carta" id="carta2" value="carta2" /></td>
                    <td><input type="radio" name="carta" id="carta3" value="carta3" /></td>
                </tr>
                <tr>
                    <td colspan="3"><button type="submit">Barajar</button></td>
                </tr>
            </table>
        </form>
    </body>
</html>