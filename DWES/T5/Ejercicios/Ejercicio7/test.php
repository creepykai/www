<?php

$e1 = new EmpleadoModificado();
$e2 = new EmpleadoModificado("Pepe", 2000);
$e3 = new EmpleadoModificado("Ana", "Becario");
$e4 = new EmpleadoModificado("Luis", "Gerente");
$e5 = new EmpleadoModificado("Maria", "Fijo");

$phtml = ''. $e1 . '<br>' . $e2 . '<br>' . $e3 . '<br>' . $e4 . '<br>' . $e5;
echo $phtml;

