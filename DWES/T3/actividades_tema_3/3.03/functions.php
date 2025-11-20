<?php
declare(strict_types=1); 

function mostrarFormulario(){
    echo '<form action="index.php" method="GET">';
    
    echo '<label for="texto">Texto:</label>';
    echo '<input type="text" id="texto" name="texto" required><br><br>';
    
    echo '<label for="estilo">Estilo:</label>';
    echo '<select id="estilo" name="estilo">';
    echo '<option value="solid">Liso (Solid)</option>';
    echo '<option value="double">Doble (Double)</option>';
    echo '<option value="dotted">Punteado (Dotted)</option>';
    echo '<option value="hidden">Oculto (Hidden)</option>';
    echo '</select><br><br>';
    
    echo '<label for="tamano">Tamaño (px):</label>';
    echo '<input type="number" id="tamano" name="tamano" min="0" max="10" value="1" required><br><br>';
    
    echo '<label for="color">Color:</label>';
    echo '<select id="color" name="color">';
    echo '<option value="black">Negro</option>';
    echo '<option value="red">Rojo</option>';
    echo '<option value="blue">Azul</option>';
    echo '<option value="yellow">Amarillo</option>';
    echo '</select><br><br>';
    
    echo '<input type="submit" value="Enviar">';
    echo '</form>';
}

function mostrarResultado(string $texto, string $estilo, int $tamano, string $color){
    
    echo "<h2>Resultado:</h2>";
    echo '<div style="border: ' . $tamano . 'px ' . $estilo . ' ' . $color . '; padding: 10px; width: fit-content;">';
    echo $texto;
    echo '</div>';
    
    echo '<br><a href="index.php">Volver</a>';
}
?>