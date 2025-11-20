<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Actividad 22</title>
        <link rel="stylesheet" href="/bootstrap-5.3.8-dist/css/bootstrap.min.css" />
        <script src="/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js" ></script>
    </head>
    <body class="m-5">
        <?php
        if (isset($_GET["tamanio"]) && !empty($_GET["tamanio"]) && isset($_GET["base"]) && !empty($_GET["base"]) && isset($_GET["salsa"]) && !empty($_GET["salsa"]) && isset($_GET["ingredientes"]) && !empty($_GET["ingredientes"])) {
            $tamanio = $_GET["tamanio"];
            $base = $_GET["base"];
            $salsa = $_GET["salsa"];
            $ingredientes = $_GET["ingredientes"];
            $resultado = 0;

            $resultado += $tamanio;
            $resultado += $base;
            $resultado += $salsa;
            foreach ($ingredientes as $ingrediente) {
                // Separamos el nombre y el precio usando el separador '|'
                $partes = explode('|', $ingrediente);
                $precio = (float)$partes[1];
                $resultado += $precio;
            }

            echo "<table class='table table-striped'>";
            echo "<thead><tr><th>Concepto</th><th>Precio</th></tr></thead>";
            echo "<tbody>";
            echo "<tr><td>Tamaño de la pizza</td><td>" . number_format((float)$tamanio, 2) . "€</td></tr>";
            echo "<tr><td>Base de la pizza</td><td>" . number_format((float)$base, 2) . "€</td></tr>";
            echo "<tr><td>Salsa de la pizza</td><td>" . number_format((float)$salsa, 2) . "€</td></tr>";
            foreach ($ingredientes as $ingrediente) {
                $partes = explode('|', $ingrediente);
                echo "<tr><td>Ingrediente (" . $partes[0] . ")</td><td>" . number_format((float)$partes[1], 2) . "€</td></tr>";
            }
            echo "<tr><td><strong>Total</strong></td><td><strong>" . number_format($resultado, 2) . "€</strong></td></tr>";
            echo "</tbody>";
            echo "</table>";

        }
        else {
        ?>
        <form method="get">
            <div class="row">
                <div class="col"><label for="tamanio" class="form-label">Tamaño de la pizza</label></div>
                <div class="col">
                    <select name="tamanio" id="tamanio" class="form-select">
                        <option value="" disabled selected>Seleccionar tamaño</option>
                        <option value="2.95">Mini (2.95€)</option>
                        <option value="4.95">Media (4.95€)</option>
                        <option value="8.95">Maxi (8.95€)</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col"><label for="base" class="form-label">Base para la pizza</label></div>
                <div class="col">
                    <select name="base" id="base" class="form-select">
                        <option value="" disabled selected>Seleccionar base</option>
                        <option value="0.0">Normal (+0€)</option>
                        <option value="1">Crujiente (+1€)</option>
                        <option value="2">Rellena (+2€)</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col"><label for="salsa" class="form-label">Salsa para la pizza</label></div>
                <div class="col">
                    <select name="salsa" id="salsa" class="form-select">
                        <option value="0.0" disabled selected>Seleccionar salsa</option>
                        <option value="0.0">Ninguna (+0€)</option>
                        <option value="0.95">Barbacoa (+0.95€)</option>
                        <option value="1.45">carbonara (+1.45€)</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col"><label class="form-label">Ingredientes para la pizza</label></div>
                <div class="col">
                    <div class="btn-group">
                        <input type="checkbox" name="ingredientes[]" id="pollo" class="btn-check" value="pollo|0.55" />
                        <label for="pollo" class="btn btn-outline-primary">Pollo (0.55€)</label>
                    </div>
                    <div class="btn-group">
                        <input type="checkbox" name="ingredientes[]" id="bacon" class="btn-check" value="bacon|0.75" />
                        <label for="bacon" class="btn btn-outline-primary">Bacon (0.75€)</label>
                    </div>
                    <div class="btn-group">
                        <input type="checkbox" name="ingredientes[]" id="jamon" class="btn-check" value="jamon|0.95" />
                        <label for="jamon" class="btn btn-outline-primary">Jamón (0.95€)</label>
                    </div>
                    <div class="btn-group">
                        <input type="checkbox" name="ingredientes[]" id="cebolla" class="btn-check" value="cebolla|0.45" />
                        <label for="cebolla" class="btn btn-outline-primary">Cebolla (0.45€)</label>
                    </div>
                    <div class="btn-group">
                        <input type="checkbox" name="ingredientes[]" id="aceitunas" class="btn-check" value="aceitunas|0.55" />
                        <label for="aceitunas" class="btn btn-outline-primary">Aceitunas (0.55€)</label>
                    </div>
                    <div class="btn-group">
                        <input type="checkbox" name="ingredientes[]" id="pimiento" class="btn-check" value="pimiento|0.65" />
                        <label for="pimiento" class="btn btn-outline-primary">Pimiento (0.65€)</label>
                    </div>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
        <?php } ?>
    </body>
</html>