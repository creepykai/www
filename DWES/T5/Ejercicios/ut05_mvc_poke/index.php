<?php
// Incluimos el controlador, que es quien contiene la lógica principal de la aplicación.
include "controllers/BasicPokemonController.php";

// [ROUTING / ENRUTAMIENTO]
// Aquí decidimos qué "acción" quiere realizar el usuario.
// Usamos el parámetro 'action' de la URL (ej: index.php?action=poke).

if (!isset($_GET['action'])) {
	// Si no hay ninguna acción en la URL, asumimos que quieren ver la página principal ("main").
	$action = "main";
} else {
	// Si hay acción, la guardamos. IMPORTANTE: Esto es lo que el usuario pide hacer.
	$action = $_GET['action'];
}

// Creamos (instanciamos) el Controlador. Él es quien sabe cómo ejecutar la acción.
$controller = new BasicPokemonController();

// Comprobamos si el controlador tiene una función con el mismo nombre que la acción.
// Ej: Si action="poke", buscamos si existe "function poke(){}" en el controlador.
if(method_exists($controller, $action))
	// Si existe, la ejecutamos.
	// El controlador nos devolverá el código HTML de la página lista para mostrar.
	$phtml = $controller->$action();
else 
	// Si no existe (el usuario se inventó la acción), mostramos un error.
	$phtml = $controller->showMethodError();

// Finalmente, imprimimos ("echo") el HTML en la pantalla del usuario.
echo $phtml;
?>