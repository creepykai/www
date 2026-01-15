<?php
// La CLASE VISTA.
// Su única responsabilidad es recibir datos (del controlador) y devolver CÓDIGO HTML bonito.
// No toma decisiones ni busca datos, solo "pinta".
class BasicView {

    private $id;
    private $title;
    private $phtml; // Aquí iremos acumulando todo el texto HTML que vamos generando.

    // Constructor: Recibe los datos básicos (ID del pokemon y título de la página) para empezar.
    function __construct(mixed $id, string $title) {
        
        $this->id = $id;
        $this->title = $title;
    }

    // Genera la parte de arriba del HTML: DOCTYPE, html, head, title, body...
	function header() : void {
		$phtml = "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta http-equiv=\"Content-Type\" content=\"text/html;\" charset=\"utf-8\">
    <!-- Enlazamos la hoja de estilos CSS para que se vea bonito -->
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/styles.css\">
    <title>{$this->title}</title>
</head>
<body>
<main>
	<header>
		<h1><a href=\"index.php\">Pokédex</a></h1>
	</header>
	<article>";
        // Guardamos este trozo de HTML en nuestra variable acumuladora.
        $this->phtml = $phtml;
	}

    // Genera la parte de abajo del HTML: cierre de etiquetas body y html.
    function footer() : void {
        
        $phtml = "
    </article>
    <footer>
		<span style=\"font-size:15px\">AMT 2024/12/20 Version 0.0.3</span>
    </footer>
</main>
</body>
</html>";
        // Añadimos (.=) este trozo al final de lo que ya teníamos.
        $this->phtml .= $phtml;
    }

    // Muestra un mensaje simple si no se encuentra lo que se buscaba.
    function not_found(string $type, mixed $id) : void {
        $phtml = "
        <p>Not found $type $id</p>";
        $this->phtml .= $phtml;
    }

    // Muestra un mensaje de error genérico.
    function error(string $message): void {
        $phtml = "
		<p>Error: $message</p>";
        $this->phtml .= $phtml;
    }

    // Muestra un error si la acción no existe.
    function no_action(string $action): void {
        $phtml = "
		<p>Error: Method $action don't exist</p>";
        $this->phtml .= $phtml;
    }

    // Genera el menú desplegable (select) con el botón OK.
    // Recibe la lista de opciones (value/option) del controlador.
    function select(array $list, string $button_action) : void {
        $phtml = "
        <form method=\"get\" action=\"index.php\">
			<select name=\"id\">";
        // Recorremos la lista y creamos una etiqueta <option> por cada pokemon.
        foreach($list as $item) {
                // value = lo que se envía al servidor (el ID).
                // option = lo que ve el usuario (el Nombre).
                $phtml .= "<option value=\"{$item['value']}\">{$item['option']}</option>";
        }
        $phtml .= "</select>
            <!-- El botón envía el formulario con action='poke' -->
            <button type=\"submit\" name=\"action\" value=\"$button_action\">OK</button>
        </form>";
        $this->phtml .= $phtml;
    }

    // Genera una tabla HTML con los detalles del pokemon.
    // Recibe un array asociativo (Clave => Valor).
    function table(array $data) : void {

        $phtml = "
        <table>
            <!-- Fila de cabecera de la tabla -->
            <tr class='list_header'>";
        // Recorremos las claves (ej: 'Nombre', 'Tipo', 'Peso') para ponerlas de título.
        foreach ($data as $k=> $v) {
            $phtml .= "
                <th>$k</th>";
        }
        $phtml .= "
            </tr>
            <!-- Fila de datos -->
            <tr>";
        // Recorremos los valores (ej: 'Pikachu', 'Eléctrico', '6kg') para ponerlos en las celdas.
        foreach ($data as $item) {
            $phtml .= "
                <td>$item</td>";
        }
		$phtml .= "
            </tr>
        </table>";
        $this->phtml .= $phtml;
    }

    // Un método "getter" simple para devolver todo el HTML que hemos ido pegando.
	public function getPhtml() : string {
		return $this->phtml;
	}
}
?>