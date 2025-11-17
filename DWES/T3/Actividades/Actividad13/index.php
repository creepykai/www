<?php
// 1. Definir las cartas (clave => imagen)
$cartas_juego = [
    "as" => "picas1-9/spades1.png",
    "dos" => "picas1-9/spades2.png",
    "tres" => "picas1-9/spades3.png"
];

// 2. Crear un array con las claves para barajar
$orden_cartas = ["as", "dos", "tres"];

// 3. Barajar para la muestra inicial [cite: 579]
// "muestra en pantalla... Tres cartas en orden aleatorio" [cite: 625]
shuffle($orden_cartas);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actividad 3.13 - Trileros (Inicio)</title>
    <style>
        body { text-align: center; font-family: sans-serif; }
        .tapete { display: flex; justify-content: center; gap: 20px; padding: 20px; }
        .tapete img { height: 200px; border: 3px solid #000; border-radius: 10px; }
        .boton-link {
            display: inline-block; font-size: 20px; padding: 15px 30px;
            background: #008CBA; color: white; text-decoration: none;
            border: none; border-radius: 5px; cursor: pointer; margin-top: 30px;
        }
    </style>
</head>
<body>
    <h1>Juego de los Trileros</h1>
    <p>¡Fíjate bien dónde está el As!</p>
    
    <!-- <div class="tapete">
        <?php
        // // Recorremos el array $orden_cartas que ya está barajado
        // // (ej. ["dos", "tres", "as"])
        // [cite_start]// Usamos un bucle foreach [cite: 192]
        // foreach ($orden_cartas as $clave_carta) {
        //     // Buscamos la imagen en el array asociativo
        //     $img_src = $cartas_juego[$clave_carta];
            
        //     // Mostramos la imagen
        //     echo '<img src="' . $img_src . '" alt="Carta ' . $clave_carta . '">';
        // }
        
        ?>
    </div> -->
    
    <a href="juego.php" class="boton-link">¡Barajar y Jugar!</a>
</body>
</html>