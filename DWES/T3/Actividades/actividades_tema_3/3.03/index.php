<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Actividad 3.3</title>
    </head>
    <body>
        <?php
        if (!isset($_POST['texto']) && !isset($_POST['tamaño']) && !isset($_POST['estilo']) && !isset($_POST['color'])) {
        ?>
        <form action="" method="post">
            <h1>Formatos en Texto</h1>
            Texto:<br />
            <textarea name="texto" id="texto" cols="100%" rows="6"></textarea>
            <fieldset>
                <legend>Características del borde</legend>
                Tamaño:
                <input type="number" name="tamaño" id="tamaño" />
                <br />
                <div>
                    Estilo:<br />
                    <select name="estilo" id="estilo">
                        <option value="solid">Liso</option>
                        <option value="double">Doble</option>
                        <option value="dotted">Punteado</option>
                        <option value="hidden">Oculto</option>
                    </select>
                </div>
                <div>
                    Color:<br />
                    <select name="color" id="color">
                        <option value="black">Negro</option>
                        <option value="red">Rojo</option>
                        <option value="azblueul">Azul</option>
                        <option value="yellow">Amarillo</option>
                    </select>
                </div>
            </fieldset>
            <br />
            <button type="submit">Enviar</button>
        </form>
        <?php
        }
        else {
            $texto = $_POST['texto'] ?? '';
            $tamaño = $_POST['tamaño'] ?? 0;
            $estilo = $_POST['estilo'] ?? 'solid';
            $color = $_POST['color'] ?? 'black';
            ?>
        <div><?= $texto ?></div>
        <style>
            div {
                height: 200px;
                width: 200px;
                border: <?= $tamaño ?>px <?= $estilo ?> <?= $color ?>;
            }
        </style>
        <?php
        }
        ?>
    </body>
</html>