<?php
// 1) Comprobación básica de datos
if (
    !isset($_GET['udsA']) || $_GET['udsA'] === '' ||
    !isset($_GET['udsB']) || $_GET['udsB'] === '' ||
    !isset($_GET['udsC']) || $_GET['udsC'] === ''
) {
    echo 'Faltan unidades. <a href="factura.html">Volver</a>';
    exit;
}

// 2) Convertimos a número (float por simplicidad a este nivel)
$unidadesA = (float) $_GET['udsA'];
$unidadesB = (float) $_GET['udsB'];
$unidadesC = (float) $_GET['udsC'];

// 3) Validaciones mínimas: no negativas
if ($unidadesA < 0 || $unidadesB < 0 || $unidadesC < 0) {
    echo 'Las unidades no pueden ser negativas. <a href="factura.html">Volver</a>';
    exit;
}

// 4) Precios fijos (según enunciado)
$precioA = 5.99;
$precioB = 12.49;
$precioC = 19.99;

// 5) Cálculos por línea
$subtotalA = $unidadesA * $precioA;
$subtotalB = $unidadesB * $precioB;
$subtotalC = $unidadesC * $precioC;

// 6) Totales sin IVA, IVA y total con IVA
$totalSinIVA = $subtotalA + $subtotalB + $subtotalC;
$tipoIVA = 0.20; // 20%
$importeIVA = $totalSinIVA * $tipoIVA;
$totalConIVA = $totalSinIVA + $importeIVA;

// 7) Fecha de emisión
$fechaEmision = date('d/m/Y'); // formato día/mes/año simple
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Factura – Resultado</title>
</head>
<body>
  <h1>Factura</h1>
  <p><strong>Fecha de emisión:</strong> <?php echo $fechaEmision; ?></p>

  <table border="1" cellpadding="8" cellspacing="0" width="400">
    <tr style="background-color:#e0e0e0; font-weight:bold;">
        <td>Artículo</td>
        <td>Precio</td>
        <td>Unidades</td>
        <td>Subtotal</td>
    </tr>
    <tr>
        <td>Artículo A</td>
        <td><?php echo $precioA; ?> €</td>
        <td><?php echo $unidadesA; ?></td>
        <td><?php echo $subtotalA; ?> €</td>
    </tr>
    <tr>
        <td>Artículo B</td>
        <td><?php echo $precioB; ?> €</td>
        <td><?php echo $unidadesB; ?></td>
        <td><?php echo $subtotalB; ?> €</td>
    </tr>
    <tr>
        <td>Artículo C</td>
        <td><?php echo $precioC; ?> €</td>
        <td><?php echo $unidadesC; ?></td>
        <td><?php echo $subtotalC; ?> €</td>
    </tr>

    <!-- Filas del resumen -->
    <tr>
        <td colspan="3" style="text-align:right; font-weight:bold;">IVA (20%)</td>
        <td><?php echo $importeIVA; ?> €</td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:right; font-weight:bold;">TOTAL</td>
        <td><strong><?php echo $totalConIVA; ?> €</strong></td>
    </tr>
</table>

</body>
</html>
