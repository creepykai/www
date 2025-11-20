<?php
declare(strict_types=1);

// --- DATOS MAESTROS (Precios) ---
const PRECIOS_TAMANO = [
    'mini' => 2.95,
    'media' => 4.95,
    'maxi' => 8.95
];

const PRECIOS_BASE = [
    'normal' => 0.0,
    'crujiente' => 1.0,
    'rellena' => 2.0
];

const PRECIOS_SALSA = [
    'ninguna' => 0.0,
    'barbacoa' => 0.95,
    'carbonara' => 1.45
];

const PRECIOS_INGREDIENTES = [
    'pollo' => 0.55,
    'bacon' => 0.75,
    'jamon' => 0.95,
    'cebolla' => 0.45,
    'aceitunas' => 0.55,
    'pimiento' => 0.65
];

function mostrarFormulario() {
    echo '<div class="contenedor-principal">';
    echo '<h1 class="titulo">🍕 Pizzería DWES</h1>';
    
    // Action vacío envía al mismo archivo (index.php)
    echo '<form action="" method="GET" class="formulario-pedido">';
    
    // --- TAMAÑO ---
    echo '<fieldset>';
    echo '<legend><b>1. Tamaño:</b></legend>';
    echo '<select name="tamanio" required>';
    echo '<option value="" disabled selected>-- Elige tamaño --</option>';
    echo '<option value="mini">Mini (2.95€)</option>';
    echo '<option value="media">Media (4.95€)</option>';
    echo '<option value="maxi">Maxi (8.95€)</option>';
    echo '</select>';
    echo '</fieldset>';

    // --- BASE ---
    echo '<fieldset>';
    echo '<legend><b>2. Tipo de Base:</b></legend>';
    echo '<select name="base" required>';
    echo '<option value="normal">Normal (Gratis)</option>';
    echo '<option value="crujiente">Crujiente (+1.00€)</option>';
    echo '<option value="rellena">Rellena (+2.00€)</option>';
    echo '</select>';
    echo '</fieldset>';

    // --- SALSA ---
    echo '<fieldset>';
    echo '<legend><b>3. Salsa:</b></legend>';
    echo '<select name="salsa">';
    echo '<option value="ninguna">Sin Salsa</option>';
    echo '<option value="barbacoa">Barbacoa (+0.95€)</option>';
    echo '<option value="carbonara">Carbonara (+1.45€)</option>';
    echo '</select>';
    echo '</fieldset>';

    // --- INGREDIENTES (Bucle foreach para pintar checkboxes) ---
    echo '<fieldset>';
    echo '<legend><b>4. Ingredientes Extra:</b></legend>';
    echo '<div class="grid-ingredientes">';
    
    foreach (PRECIOS_INGREDIENTES as $nombre => $precio) {
        $nombreBonito = ucfirst($nombre);
        echo "<label><input type='checkbox' name='ingredientes[]' value='$nombre'> $nombreBonito ($precio €)</label>";
    }
    
    echo '</div>';
    echo '</fieldset>';

    echo '<button type="submit" class="btn-calcular">💸 Calcular Precio</button>';
    echo '</form>';
    echo '</div>';
}

function mostrarFactura(string $tamanio, string $base, string $salsa, array $ingredientesSeleccionados) {
    
    // 1. Recuperar precios
    $precioTamanio = PRECIOS_TAMANO[$tamanio];
    $precioBase = PRECIOS_BASE[$base];
    $precioSalsa = PRECIOS_SALSA[$salsa];

    // 2. Calcular ingredientes
    $totalIngredientes = 0;
    $filasIngredientes = "";

    foreach ($ingredientesSeleccionados as $ingrediente) {
        if (array_key_exists($ingrediente, PRECIOS_INGREDIENTES)) {
            $coste = PRECIOS_INGREDIENTES[$ingrediente];
            $totalIngredientes += $coste;
            // Concatenamos las filas de la tabla
            $filasIngredientes .= "<tr><td>+ Extra " . ucfirst($ingrediente) . "</td><td class='precio'>" . number_format($coste, 2) . "€</td></tr>";
        }
    }

    // 3. Total
    $total = $precioTamanio + $precioBase + $precioSalsa + $totalIngredientes;

    // 4. Pintar Factura
    echo '<div class="contenedor-factura">';
    echo '<h2 class="titulo-factura">🧾 TICKET DE COMPRA</h2>';
    
    echo '<table class="tabla-factura">';
    
    // Conceptos Fijos
    echo "<tr><td>Pizza " . ucfirst($tamanio) . "</td><td class='precio'>" . number_format($precioTamanio, 2) . "€</td></tr>";
    
    if ($precioBase > 0) {
        echo "<tr><td>Base " . ucfirst($base) . "</td><td class='precio'>" . number_format($precioBase, 2) . "€</td></tr>";
    }
    if ($precioSalsa > 0) {
        echo "<tr><td>Salsa " . ucfirst($salsa) . "</td><td class='precio'>" . number_format($precioSalsa, 2) . "€</td></tr>";
    }

    // Conceptos Variables
    echo $filasIngredientes;

    // Total
    echo "<tr class='fila-total'><td>TOTAL</td><td class='precio'>" . number_format($total, 2) . "€</td></tr>";
    
    echo '</table>';
    
    echo '<br><div style="text-align: center;"><a href="index.php">Hacer otro pedido</a></div>';
    echo '</div>';
}
?>