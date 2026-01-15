<?php

// Esta clase es un MODELO.
// Su trabajo es hablar con la BASE DE DATOS (MySQL/MariaDB) para sacar o guardar información.
// Recuerda: Al controlador no le importa CÓMO sacamos los datos, solo quiere que se los demos.
class BasicPokemonBdModel {
    // Aquí guardamos la "conexión" activa con la base de datos.
    private $con;

    // El constructor se ejecuta automáticamente cuando hacemos "new BasicPokemonBdModel()".
    // Aquí nos conectamos a la base de datos.
    public function __construct(string $db="miniDex", string $host="mariadb", string $user="root", string $pass="root") {
        // Intentamos conectar usando la librería `mysqli`.
        $this->con = new mysqli($host, $user, $pass, $db);
        
        // Si hay un error (ej. contraseña mal, servidor apagado), paramos todo y mostramos el error.
        if ($this->con->connect_error) {
            die('(' . $this->con->connect_errno . ') ' . $this->con->connect_error);
        }
    }

    // Método para cerrar la conexión cuando ya no la necesitemos.
    // Es de buena educación limpiar y cerrar lo que abres.
    public function closeConnection() {
        $this->con->close();
    }

    // Esta función privada ayuda a ejecutar consultas SQL de forma segura.
    // "Privada" significa que solo se puede usar DENTRO de esta clase.
    // Usa "Prepared Statements" (sentencias preparadas) para evitar hackeos (Inyección SQL).
    private function get_items(string $query, string $types, array $values, bool $single_result=false) : ?array {
        
        $stmt = $this->con->stmt_init();
        $stmt->prepare($query); // Prepara la consulta SQL (ej. "SELECT * FROM ... WHERE id = ?")
        
        // Vincula los valores reales a los interrogantes (?) de la consulta.
        // `...$values` "desempaqueta" el array de valores.
        $status = $stmt->bind_param($types, ...$values);
        if($status == false)
            return null; // Falló al vincular
            
        // Ejecuta la consulta en la base de datos.
        $status = $stmt->execute();
        if($status == false) {
            $stmt->close();
            return null; // Falló al ejecutar (ej. error en SQL)
        }
        
        // Obtenemos el resultado.
        $item_set = $stmt->get_result();
        $stmt->close();

        if($item_set == false)
            return null; // No devolvió nada (o error)

        // Si solo queríamos 1 resultado (ej. buscar un pokemon por ID)...
        if($single_result == true)
            $item = $item_set->fetch_assoc(); // ...devuelve solo una fila.
        else
            $item = $item_set->fetch_all(MYSQLI_ASSOC); // ...si no, devuelve TODAS las filas encontradas.
            
        $item_set->free_result(); // Liberamos memoria.
        return $item;
    }

    // Esta función devuelve la lista de pokemons para el desplegable (select).
    // Devuelve un array con 'value' (el ID) y 'option' (el nombre).
    public function get_poke_list_as_value_option() : array {
        // Ejecutamos una consulta SQL directa.
        // SELECT `id` AS `value` -> Renombramos la columna 'id' a 'value'
        // SELECT `name_es` AS `option` -> Renombramos 'name_es' a 'option'
        $poke_set = $this->con->query("SELECT `pokemon`.`id` AS `value`, `pokemon`.`name_es` AS `option`
        FROM `pokemon`
        ORDER BY `value`");
        
        // Convertimos el resultado de la BBDD a un array de PHP.
        $poke_list = $poke_set->fetch_all(MYSQLI_ASSOC);
        $poke_set->free_result();
        return $poke_list;
    }

    // Esta función devuelve TODA la info de un pokemon específico.
    public function get_poke_data(int $poke_id) : array {
        // La consulta SQL con un interrogante (?) para, más tarde, poner ahí el ID de forma segura.
        $query = "SELECT * FROM pokemon WHERE ID = ?";
        
        // Llamamos a nuestra función auxiliar 'get_items'.
        // "i" significa que el parámetro es un Entero (Integer).
        // [$poke_id] es el valor que sustituirá al interrogante.
        // true = queremos solo 1 resultado.
        $data = $this->get_items($query, "i", [$poke_id], true);
        
        $ret = [];
        if($data != null) $ret = $data;
        return $ret; // Devuelve el array con los datos (nombre, tipo, peso, etc.)
    }
}