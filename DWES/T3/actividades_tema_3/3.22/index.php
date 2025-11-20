<?php
// Activamos tipado estricto (Regla de oro)
declare(strict_types=1);

include_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzería PHP</title>
    <style>
        /* Estilos Generales */
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f9; margin: 0; padding: 20px; color: #333; }
        
        /* Contenedores */
        .contenedor-principal { max-width: 600px; margin: 0 auto; }
        .contenedor-factura { max-width: 500px; margin: 20px auto; font-family: 'Courier New', Courier, monospace; border: 1px solid #333; padding: 20px; background: white; box-shadow: 5px 5px 15px rgba(0,0,0,0.1); }
        
        /* Formulario */
        .formulario-pedido { background: #fff3e0; padding: 25px; border-radius: 10px; border: 1px solid #e67e22; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        fieldset { margin-bottom: 20px; border: 1px solid #ddd; background: white; padding: 15px; border-radius: 8px; }
        legend { background: #e67e22; color: white; padding: 4px 10px; border-radius: 4px; font-weight: bold; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px; }
        select { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; font-size: 1rem; background-color: #fff; }
        
        /* Checkboxes Grid */
        .grid-ingredientes { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; margin-top: 10px; }
        .grid-ingredientes label { display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 0.95rem; }
        
        /* Botones */
        .btn-calcular { width: 100%; padding: 15px; background: #d35400; color: white; font-weight: bold; border: none; cursor: pointer; font-size: 1.1em; border-radius: 6px; margin-top: 10px; transition: background 0.3s ease; }
        .btn-calcular:hover { background: #a04000; }
        a { color: #d35400; text-decoration: none; font-weight: bold; }
        a:hover { text-decoration: underline; }
        
        /* Títulos */
        .titulo { text-align: center; color: #d35400; margin-bottom: 30px; font-size: 2.5rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.1); }
        .titulo-factura { text-align: center; border-bottom: 2px dashed #333; padding-bottom: 15px; margin-top: 0; text-transform: uppercase; letter-spacing: 1px; }
        
        /* Tabla Factura */
        .tabla-factura { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .tabla-factura td { padding: 8px 0; border-bottom: 1px dotted #ccc; }
        .tabla-factura tr:last-child td { border-bottom: none; }
        .precio { text-align: right; font-weight: bold; }
        .fila-total { border-top: 2px solid #333; font-weight: bold; font-size: 1.2em; background-color: #f9f9f9; }
        .fila-total td { padding-top: 15px; padding-bottom: 5px; border-bottom: none; }
    </style>
</head>
<body>

    <?php
    // Lógica del Controlador
    // Comprobamos si existe el campo 'tamanio' que es el primero obligatorio
    if (isset($_GET['tamanio'])) {
        
        $tamanio = $_GET['tamanio'];
        $base = $_GET['base'];
        // Usamos operador de fusión de nulo (??) por si no seleccionan salsa
        $salsa = $_GET['salsa'] ?? 'ninguna';
        
        // IMPORTANTE: Los checkboxes llegan como array. Si no marca ninguno, llega null.
        // Usamos ?? [] para asegurar que siempre pasamos un array (aunque esté vacío)
        $ingredientes = $_GET['ingredientes'] ?? [];

        // Llamamos a la función de pintar factura pasándole los datos limpios
        mostrarFactura($tamanio, $base, $salsa, $ingredientes);

    } else {
        // Si no hay datos, mostramos el formulario de inicio
        mostrarFormulario();
    }
    ?>

</body>
</html>