<?php

include_once "versionAaron.php";

$e1 = new EmpleadoModificado();
$e2 = new EmpleadoModificado("Pepe", 2000);
$e3 = new EmpleadoModificado("Ana", "Becario");
$e4 = new EmpleadoModificado("Luis", "Gerente");
$e5 = new EmpleadoModificado("Maria", "Fijo");

$phtml = ''. $e1 . '<br>' . $e2 . '<br>' . $e3 . '<br>' . $e4 . '<br>' . $e5;

$e = new ReflectionClass("EmpleadoModificado");

$phtml .= "<pre>" . print_r($e->getMethods(), true) . "</pre>"
."<pre>" . print_r($e->getProperties(), true) . "</pre>";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php echo $phtml; ?>
</body>
</html>


