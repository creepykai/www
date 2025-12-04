<?php
$archivo_csv = 'visitas.csv';
$nombre_cookie = 'ultima_visita';

$pagina_actual_raw = $_GET['pag'] ?? 'inicio';
$pagina_actual = strtolower($pagina_actual_raw);

$datos_visitas = [];
if (is_readable($archivo_csv)) {
    $gestor = fopen($archivo_csv, 'r');
    if ($gestor) {
        if (fgetcsv($gestor) === false) {}
        
        while (($linea = fgetcsv($gestor)) !== false) {
            if (count($linea) >= 2) {
                $clave_pagina = strtolower($linea[0]);
                $datos_visitas[$clave_pagina] = (int)$linea[1];
            }
        }
        fclose($gestor);
    } 
} 

if (isset($datos_visitas[$pagina_actual])) {
    $datos_visitas[$pagina_actual]++;
} else {
    $datos_visitas[$pagina_actual] = 1;
}

if (is_writable($archivo_csv)) {
    $gestor = fopen($archivo_csv, 'w');
    if ($gestor) {
        fputcsv($gestor, ['pagina', 'visitas']);
        
        foreach ($datos_visitas as $pagina => $visitas) {
            fputcsv($gestor, [$pagina, $visitas]);
        }
        fclose($gestor);
    } 
} 

$ultima_visita_registrada = $_COOKIE[$nombre_cookie] ?? 'No hay registro de tu última visita (cookie no encontrada)';

setcookie($nombre_cookie, $pagina_actual, time() + (86400 * 30), "/"); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>DWES - Contador de Visitas</title>
</head>
<body>
    <h1>Contador y Registro de Visitas con CSV y Cookies</h1>
    
    <h2>Página: <?php echo ucfirst($pagina_actual); ?></h2>

    <div>
        <h3>Estadísticas de la Página</h3>
        <p>Visitas totales de esta página (según CSV): 
            <strong><?php echo $datos_visitas[$pagina_actual]; ?></strong>
        </p>
        <p>Tu última visita registrada fue a: 
            <strong><?php echo ucfirst($ultima_visita_registrada); ?></strong>
        </p>
    </div>
    
    <a href="index.php?pag=inicio">• Inicio (index.php?pag=inicio)</a><br>
    <a href="index.php?pag=contacto">• Contacto (index.php?pag=contacto)</a><br>
    <a href="index.php?pag=blog">• Blog (index.php?pag=blog)</a><br>
    
</body>
</html>