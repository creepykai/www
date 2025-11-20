<?php
declare(strict_types=1);

function mostrarFormulario(){
    // Tu formulario estaba bien, solo añado saltos de línea para verlo mejor
    echo '<form action="index.php" method="GET">';
    echo '<p><label for="articulo1">Articulo 1 (5.99€):</label>';
    echo '<input type="number" id="articulo1" name="articulo1" min="0" value="0"></p>';
    echo '<p><label for="articulo2">Articulo 2 (12.49€):</label>';
    echo '<input type="number" id="articulo2" name="articulo2" min="0" value="0"></p>';
    echo '<p><label for="articulo3">Articulo 3 (19.99€):</label>';
    echo '<input type="number" id="articulo3" name="articulo3" min="0" value="0"></p>';
    echo '<p><input type="submit" value="Generar Factura"></p>';
    echo '</form>';
}

function mostrarFactura(int $articulo1, int $articulo2, int $articulo3){
    // 1. Cálculos de subtotales
    $subtotal1 = $articulo1 * 5.99;
    $subtotal2 = $articulo2 * 12.49;
    $subtotal3 = $articulo3 * 19.99;
    
    // Base Imponible inicial
    $baseImponible = $subtotal1 + $subtotal2 + $subtotal3;

    // 2. Calcular Descuento según unidades (Lógica del PDF pág 11)
    $totalUnidades = $articulo1 + $articulo2 + $articulo3;
    $descuento = 0; // Importante inicializar a 0
    $porcentaje = 0; // Para mostrarlo en el texto luego

    if ($totalUnidades > 20) {
        $porcentaje = 25;
        $descuento = $baseImponible * 0.25;
    } elseif ($totalUnidades >= 11) {
        $porcentaje = 10;
        $descuento = $baseImponible * 0.10;
    } elseif ($totalUnidades >= 5) {
        $porcentaje = 5;
        $descuento = $baseImponible * 0.05;
    }
    // Si es menor de 5, no entra en ningún if y se queda en 0 (correcto)

    // 3. Calcular la Nueva Base (Base - Descuento)
    $baseConDescuento = $baseImponible - $descuento;

    // 4. Calcular IVA (sobre la base rebajada)
    $iva = $baseConDescuento * 0.20;

    // 5. Total Final
    $total = $baseConDescuento + $iva;
    
    $fecha = date("d/m/Y");
    // 2. Pintar la Tabla (Formato PDF UT03 Pág 11)
    echo "<h3>Factura - Fecha: $fecha</h3>";
    echo "<table border='1' cellpadding='5' style='border-collapse:collapse;'>";
    
    // Cabecera
    echo "<tr><th>Artículo</th><th>Precio</th><th>Unidades</th><th>Subtotal</th></tr>";

    // Fila Artículo 1
    echo "<tr>";
    echo "<td>Artículo 1</td>";
    echo "<td>5.99€</td>";
    echo "<td>$articulo1</td>";
    // Fíjate en la concatenación con el punto (.)
    echo "<td>" . number_format($subtotal1, 2) . "€</td>"; 
    echo "</tr>";

    // Fila Artículo 2
    echo "<tr>";
    echo "<td>Artículo 2</td>";
    echo "<td>12.49€</td>";
    echo "<td>$articulo2</td>";
    echo "<td>" . number_format($subtotal2, 2) . "€</td>";
    echo "</tr>";

    // Fila Artículo 3
    echo "<tr>";
    echo "<td>Artículo 3</td>";
    echo "<td>19.99€</td>";
    echo "<td>$articulo3</td>";
    echo "<td>" . number_format($subtotal3, 2) . "€</td>";
    echo "</tr>";

    // Fila Base Imponible (Opcional pero recomendada)
    echo "<tr><td colspan='3' align='right'><b>Base Imponible</b></td>";
    echo "<td>" . number_format($baseImponible, 2) . "€</td></tr>";

    // Fila IVA
    echo "<tr><td colspan='3' align='right'><b>IVA (20%)</b></td>";
    echo "<td>" . number_format($iva, 2) . "€</td></tr>";

    // Fila TOTAL
    echo "<tr><td colspan='3' align='right'><b>TOTAL</b></td>";
    echo "<td>" . number_format($total, 2) . "€</td></tr>";

    echo "<tr><td colspan='3' align='right'><b>Descuento</b></td>";
    echo "<td>" . number_format($descuento, 2) . "€</td></tr>";

    echo "</table>";
    echo "<br><a href='index.php'>Volver</a>";
}
?>