<?php
declare(strict_types=1);

$fichero = 'contador.txt';
$visitas = 0;
$ultimo_acceso = 'Nunca'; // Valor por defecto

if (file_exists($fichero)) {
    // 1. Leemos todo el string
    $contenido = file_get_contents($fichero); 

    // 2. Troceamos la cadena para separar el número de la fecha
    // Si el archivo tiene "15 - 2023-10-01", queremos separar por " - "
    // BUSCA LA FUNCIÓN EN LA UNIDAD 3 (Diapositiva 85)
    $partes = explode(' - ', $contenido);
    
    // La función devuelve un array. 
    // $partes[0] será el número ("15")
    // $partes[1] será la fecha ("2023-10-01")
    
    if (isset($partes[0])) {
        $visitas = (int) $partes[0];
    }
    if (isset($partes[1])) {
        $ultimo_acceso = $partes[1];
    }
}

// 3. Incrementamos
$visitas++;

// 4. Obtenemos fecha actual (Función estándar de PHP date())
$fechaActual = date('Y-m-d H:i:s');

// 5. Preparamos el nuevo texto a guardar: "NUMERO - FECHA"
// BUSCA EL OPERADOR DE CONCATENACIÓN EN LA UNIDAD 3 (Diapositiva 77)
$nuevoContenido = $visitas . ' - ' . $fechaActual;

// 6. Guardamos
file_put_contents($fichero, $nuevoContenido);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contador Avanzado</title>
    <style>
        body { font-family: sans-serif; text-align: center; padding: 50px; }
        .dato { font-size: 2em; color: #2c3e50; margin: 20px; }
        .numero { font-weight: bold; color: #e74c3c; font-size: 3em; }
    </style>
</head>
<body>
    <h1>Estadísticas de Visitas</h1>
    
    <div class="dato">
        Visitas totales: <br>
        <span class="numero"><?php echo $visitas; ?></span>
    </div>

    <div class="dato">
        Último acceso anterior: <br>
        <strong><?php echo $ultimo_acceso; ?></strong>
    </div>
</body>
</html>