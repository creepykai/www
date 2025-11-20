<?php
const precioArticulo1 = 5.99;
const precioArticulo2 = 12.49;
const precioArticulo3 = 19.99;
const IVA = .20;

$articulo1 = $_GET['articulo1'] ?? 0; // TODO tener en cuenta números negativos
$articulo2 = $_GET['articulo2'] ?? 0; // TODO tener en cuenta números negativos
$articulo3 = $_GET['articulo3'] ?? 0; // TODO tener en cuenta números negativos

$precio = precioArticulo1 * $articulo1 + precioArticulo2 * $articulo2 + precioArticulo3 * $articulo3;
$precioIva = $precio * IVA;

if (($articulo1 + $articulo2 + $articulo3) > 20) {
    $dto = .25;
}
else if (($articulo1 + $articulo2 + $articulo3) > 10) {
    $dto = .10;
}
else if (($articulo1 + $articulo2 + $articulo3) >= 5) {
    $dto = .05;
}
else {
    $dto = 0;
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Actividad 3.2</title>
    </head>
    <body>
        <table border="0">
            <tr>
                <th width="150px">Artículo</th>
                <th width="150px">Precio</th>
                <th width="150px">Unidades</th>
                <th width="150px">Subtotal</th>
            </tr>
            <tr>
                <td>Artículo 1</td>
                <td align="center"><?= precioArticulo1 ?>€</td>
                <td align="center"><?= $articulo1 ?></td>
                <td align="center"><?= precioArticulo1 * $articulo1 ?>€</td>
            </tr>
            <tr>
                <td>Artículo 2</td>
                <td align="center"><?= precioArticulo2 ?>€</td>
                <td align="center"><?= $articulo2 ?></td>
                <td align="center"><?= precioArticulo2 * $articulo2 ?>€</td>
            </tr>
            <tr>
                <td>Artículo 3</td>
                <td align="center"><?= precioArticulo3 ?>€</td>
                <td align="center"><?= $articulo3 ?></td>
                <td align="center"><?= precioArticulo3 * $articulo3 ?>€</td>
            </tr>
            <tr></tr>
            <tr>
                <td></td>
                <td></td>
                <td align="right">Dto. (xx%)</td>
                <td align="center"><?= $dto ?>% - <?= $precio * $dto ?>€</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td align="right">IVA (20%)</td>
                <td align="center"><?= IVA * 100 ?>%</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td align="right">TOTAL</td>
                <td align="center"><?= $precio + $precioIva - ($precio * $dto)?></td>
            </tr>
        </table>
    </body>
</html>