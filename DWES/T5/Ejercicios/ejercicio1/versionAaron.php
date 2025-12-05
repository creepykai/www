<?php
    // Su version se basa en recoger los datos de un formulario con GET
    class Titulo
    {
        private $texto;
        private $posicion;
        private $colorTexto;
        private $colorFondo;

        function __construct(string $texto = "", string $posicion = "centro", string $colorTexto = "negro", string $colorFondo = "blanco")
        {
            $this->texto = $texto;
            $this->posicion = $posicion;
            $this->colorTexto = $colorTexto;
            $this->colorFondo = $colorFondo;
        }

        function __toString() : string
        {
            $cad = "($this->texto, $this->posicion, $this->colorTexto, $this->colorFondo)";
            return $cad;
        }

        // Métodos getter individuales
        public function obtenerTitulo() : string
        {
            return $this->texto;
        }

        public function obtenerPosicion() : string
        {
            return $this->posicion;
        }

        public function obtenerColorTexto() : string
        {
            return $this->colorTexto;
        }

        public function obtenerColorFondo() : string
        {
            return $this->colorFondo;
        }

        // Método para obtener todos los valores
        public function obtenerTodosLosValores() : string
        {
            return "Texto: " . $this->texto . ", Posición: " . $this->posicion . ", Color Texto: " . $this->colorTexto . ", Color Fondo: " . $this->colorFondo;
        }
    }

    // Recogemos los datos solo si se ha enviado el formulario
    if ($_GET) {
        // Usamos el operador de fusión de null (??) para asignar valores por defecto si no vienen en el GET
        // Nota: El constructor ya tiene valores por defecto, pero aquí manejamos la entrada del usuario.

        $var_texto = $_GET["texto"] ?? "";
        $var_posicion = $_GET["posicion"] ?? "centro";
        $var_colorTexto = $_GET["colorTexto"] ?? "negro";
        $var_colorFondo = $_GET["colorFondo"] ?? "blanco";

        // Aseguramos que si vienen vacíos (pero definidos), se usen los defaults visuales o del constructor
        if (empty($var_texto)) $var_texto = "";
        if (empty($var_posicion)) $var_posicion = "centro";
        if (empty($var_colorTexto)) $var_colorTexto = "negro";
        if (empty($var_colorFondo)) $var_colorFondo = "blanco";

        $titulo = new Titulo($var_texto, $var_posicion, $var_colorTexto, $var_colorFondo);

        echo "<h2>Resultados:</h2>";
        echo "<strong>ToString:</strong> " . $titulo . "<br>";
        echo "<strong>Todos los valores:</strong> " . $titulo->obtenerTodosLosValores() . "<br>";
        echo "<strong>Título:</strong> " . $titulo->obtenerTitulo() . "<br>";
        echo "<strong>Posición:</strong> " . $titulo->obtenerPosicion() . "<br>";
        echo "<strong>Color Texto:</strong> " . $titulo->obtenerColorTexto() . "<br>";
        echo "<strong>Color Fondo:</strong> " . $titulo->obtenerColorFondo() . "<br>";
    }

    ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 1 - Versión Aaron</title>
    </head>

    <body>
        <h1>Configuración de Título</h1>
        <form action="" method="GET">
            <label for="texto">Texto:</label>
            <input type="text" name="texto" id="texto" placeholder="Introduce el texto"><br><br>

            <label for="posicion">Posición:</label>
            <select name="posicion" id="posicion">
                <option value="centro">Centro</option>
                <option value="izquierda">Izquierda</option>
                <option value="derecha">Derecha</option>
            </select><br><br>

            <label for="colorTexto">Color Texto:</label>
            <input type="text" name="colorTexto" id="colorTexto" placeholder="Ej: red, #000000"><br><br>

            <label for="colorFondo">Color Fondo:</label>
            <input type="text" name="colorFondo" id="colorFondo" placeholder="Ej: white, #FFFFFF"><br><br>

            <input type="submit" value="Enviar">
        </form>
    </body>
    </html>
    