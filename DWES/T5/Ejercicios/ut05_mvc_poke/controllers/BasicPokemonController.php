<?php
// IMPORTANTE: En el MVC, el Controlador necesita tener acceso tanto a los Modelos (datos)
// como a las Vistas (diseño HTML). Por eso incluimos estos ficheros aquí.
include_once "models/BasicPokemonJsonModel.php";
// include_once "models/BasicPokemonBdModel.php"; // Esta línea está comentada porque ahora mismo usamos JSON, no Base de Datos.
include_once "views/BasicView.php";

// La clase Controlador es como el "jefe de orquesta". Recibe órdenes (del index.php)
// y coordina al Modelo (quien tiene la info) y a la Vista (quien la muestra).
class BasicPokemonController {

	// Esta es la acción por defecto (página principal).
	// Se ejecuta cuando entras y no pides nada específico.
	public function main() : string {
		
		$error = '';
		
		// Un bloque Try-Catch sirve para "intentar" hacer algo arriesgado.
		// Si falla (por ejemplo, no se puede leer el fichero de datos), capturamos el error para que la web no se rompa.
		try {
			// [PASO 1: MODELO]
			// Creamos una instancia del Modelo. El modelo es el "experto en datos".
			// Aquí elegimos usar el modelo que lee JSON.
			$m = new BasicPokemonJsonModel();
			
			// Le pedimos al modelo: "¡Dame la lista de pokemons!".
			// Al controlador NO le importa cómo lo consigue el modelo (si es de un fichero, de internet o BBDD).
			$dex = $m->get_poke_list_as_value_option();
			
			// Cerramos la "conexión" con el modelo (limpieza).
			$m->closeConnection();
		} catch(Throwable $t) {
			// Si algo falló arriba, guardamos el mensaje de error aquí.
			$error = $t->getMessage();
		}

		// [PASO 2: VISTA]
		// Ahora que tenemos los datos, llamamos a la Vista.
		// La Vista es la "diseñadora". Le pasamos el título de la página.
		// El 'null' es porque en la portada no estamos viendo ningún pokemon concreto.
		$v = new BasicView(null, "Pokédex");
		
		// Le decimos a la vista: "Pinta la cabecera HTML (<html><body>...)"
		$v->header();
		
		// Si hubo un error antes, le decimos a la vista que lo pinte en rojo.
		if(!empty($error)) {
			$v->error($error);
		}
		
		// Si tenemos datos (la lista de pokemons), le decimos a la vista que pinte el selector/desplegable.
		if(count($dex) >= 1) {
			$v->select($dex, "poke");
		}
		
		// Le decimos a la vista: "Pinta el cierre de página (</body></html>)"
		$v->footer();

		// Finalmente, devolvemos todo el HTML generado (como un gran texto) a quien nos llamó (index.php).
		return $v->getPhtml();
	}

	// Esta función se ejecuta cuando el usuario quiere ver un Pokémon específico.
	// Por ejemplo: index.php?action=poke&id=25 (Pikachu)
	public function poke() : string {
		
		// Comprobamos si nos han pasado un ID en la dirección URL (el parámetro $_GET['id']).
		// Si no hay ID, no podemos buscar nada, así que les mandamos de vuelta a la página principal.
		if(empty($_GET['id'])) {
			return $this->main();
		}
		
		// Guardamos el ID que nos han pedido.
		$id = $_GET['id'];

		// Preparamos variables por defecto.
		$title = "Pokémon $id";
		$error = '';
		$poke_data = []; // Aquí guardaremos los datos del pokemon.

		// [PASO 1: MODELO] - Pedir datos
		try {
			$m = new BasicPokemonJsonModel();
			// $m = new BasicPokemonBdModel(); // Podríamos cambiar esto si quisiéramos usar BBDD y el código de abajo no cambiaría.
			
			// Le pedimos al modelo: "Dame todos los datos del pokemon con este ID".
			$poke_data = $m->get_poke_data($id);
			
			$m->closeConnection();
		} catch(Throwable $t) {
			$error = $t->getMessage();
		}

		// [PASO 2: VISTA] - Mostrar datos
		// Creamos la vista, pasándole el ID del pokemon actual y el título.
		$v = new BasicView($id, $title);
		$v->header();
		
		if(!empty($error)) {
			$v->error($error);
		}
		
		// Si encontramos datos del pokemon...
		if(count($poke_data) >= 1) {
			// ... le decimos a la vista que pinte una tabla bonita con esa información.
			$v->table($poke_data);
		} else {
			// Si no encontramos nada (array vacío), le decimos a la vista que muestre un mensaje de "No encontrado".
			$v->not_found("pokémon", $id);
		}
		$v->footer();

		// Devolvemos el HTML cocinado.
		return $v->getPhtml();
	}

	// Esta función se usa si el usuario intenta hacer una acción que no existe.
	// Ejemplo: index.php?action=volar (y no tenemos función volar).
	function showMethodError() {

		// Miramos qué acción intentaron hacer.
		$action = $_GET['action'] ?? '';

		$v = new BasicView(null, "Method $action");
		$v->header();
		// La vista tiene un método especial para decir "Oye, esa acción no existe".
		$v->no_action($action);
		$v->footer();

		return $v->getPhtml();
	}
}
