<?php
// 1) Comprobación básica
if (
    !isset($_GET['udsA']) || $_GET['udsA'] === '' ||
    !isset($_GET['udsB']) || $_GET['udsB'] === '' ||
    !isset($_GET['udsC']) || $_GET['udsC'] === ''
) {
    echo 'Faltan unidades. <a href="factura.html">Volver</a>';
    exit;
}

// 2) Lectura y conversión
$unidadesA = (float) $_GET['udsA'];
$unidadesB = (float) $_GET['udsB'];
$unidadesC = (float) $_GET['udsC'];

// 3) Validaciones mínimas
if ($unidadesA < 0 || $unidadesB < 0 || $unidadesC < 0) {
    echo 'Las unidades no pueden ser negativas. <a href="factura.html">Volver</a>';
    exit;
}

// 4) Precios (enunciado)
$precioA = 5.99;
$precioB = 12.49;
$precioC = 19.99;

// 5) Subtotales
$subtotalA = $unidadesA * $precioA;
$subtotalB = $unidadesB * $precioB;
$subtotalC = $unidadesC * $precioC;

// 6) Total sin IVA
$totalSinIVA = $subtotalA + $subtotalB + $subtotalC;

// 7) Unidades totales para tramo de descuento
$unidadesTotales = $unidadesA + $unidadesB + $unidadesC;

// 8) Descuento según tramos
$porcentajeDescuento = 0;   // en tanto por uno: 0.05, 0.10, 0.25...
$textoDescuento = 'Sin descuento';

if ($unidadesTotales >= 5 && $unidadesTotales <= 10) {
    $porcentajeDescuento = 0.05;
    $textoDescuento = '5%';
} elseif ($unidadesTotales >= 11 && $unidadesTotales <= 20) {
    $porcentajeDescuento = 0.10;
    $textoDescuento = '10%';
} elseif ($unidadesTotales > 20) {
    $porcentajeDescuento = 0.25;
    $textoDescuento = '25%';
}

// 9) Aplicación del descuento SOBRE el total sin IVA
$importeDescuento = $totalSinIVA * $porcentajeDescuento;
$totalTrasDescuento = $totalSinIVA - $importeDescuento;

// 10) IVA del 20% aplicado después del descuento
$iva = $totalTrasDescuento * 0.20;
$totalFinal = $totalTrasDescuento + $iva;

// 11) Fecha
$fecha = date('d/m/Y');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Factura con descuento</title>
</head>
<body>
  <h1>Factura</h1>
  <p><strong>Fecha:</strong> <?php echo $fecha; ?></p>
  <p><strong>Unidades totales:</strong> <?php echo $unidadesTotales; ?></p>

  <table border="1" cellpadding="8" cellspacing="0" width="420">
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

    <!-- Resumen -->
    <tr>
      <td colspan="3" style="text-align:right;">Total (sin IVA)</td>
      <td><?php echo $totalSinIVA; ?> €</td>
    </tr>
    <tr>
      <td colspan="3" style="text-align:right;">Descuento (<?php echo $textoDescuento; ?>)</td>
      <td><?php echo $importeDescuento; ?> €</td>
    </tr>
    <tr>
      <td colspan="3" style="text-align:right;">Total tras descuento</td>
      <td><?php echo $totalTrasDescuento; ?> €</td>
    </tr>
    <tr>
      <td colspan="3" style="text-align:right;">IVA (20%)</td>
      <td><?php echo $iva; ?> €</td>
    </tr>
    <tr>
      <td colspan="3" style="text-align:right; font-weight:bold;">TOTAL</td>
      <td><strong><?php echo $totalFinal; ?> €</strong></td>
    </tr>
  </table>

  <p style="margin-top:16px;"><a href="factura.html">Volver</a></p>
</body>
</html>
