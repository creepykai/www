<?php

// Esta clase también es un MODELO, igual que BasicPokemonBdModel. class BasicPokemonJsonModel {
// Pero en vez de usar una base de datos MySQL, ¡saca los datos de un fichero de texto (JSON)!
// Para el controlador (y para ti) el resultado es el mismo: le pides datos y te los da.
class BasicPokemonJsonModel {
    private $pokemon; // Aquí guardamos toda la lista de pokemons temporalmente en memoria.

    // El constructor se ejecuta al hacer "new BasicPokemonJsonModel()".
    public function __construct() {
        // 1. Leemos todo el contenido del fichero "pokemon.json" como un texto larguísimo.
        // __DIR__ es un truco para saber en qué carpeta está este archivo PHP.
        $json = file_get_contents(__DIR__ . "/../data/pokemon.json");
        
        // 2. Convertimos ese texto JSON a un array de PHP que podamos usar.
        // `true` significa que queremos un array asociativo (con claves y valores).
        $this->pokemon = json_decode($json, true);
    }


    // Como estamos leyendo un fichero y no conectando a un servidor, no hace falta "cerrar" nada.
    // Pero dejamos la función vacía para que el controlador pueda llamarla sin dar error.
    // (Esto se llama polimorfismo o respetar la interfaz: todos los modelos deben tener los mismos métodos).
    public function closeConnection() {
    }


    // Devuelve la lista simplificada (ID y Nombre) para el menú desplegable.
    public function get_poke_list_as_value_option() : array {
        $poke_list = [];
        
        // Recorremos todos los pokemons que cargamos del JSON uno a uno.
        foreach($this->pokemon as $p) {
            // Creamos un paquetito con solo lo que nos interesa: nombre y ID.
            $poke_option['option'] = $p['name_es'];
            $poke_option['value'] = $p['id'];
            
            // Lo añadimos a nuestra lista final.
            $poke_list[] = $poke_option;
        }
        return $poke_list;
    }

    // Busca toda la información de un pokemon concreto por su ID.
    public function get_poke_data(int $poke_id) : array {
        // Buscamos en qué posición del array está el pokemon con ese ID.
        // array_column: Saca una lista solo con los IDs.
        // array_search: Busca el ID en esa lista y nos dice la posición (0, 1, 2...).
        $key = array_search($poke_id, array_column($this->pokemon, 'id'));
        
        // Devolvemos los datos que están en esa posición.
        $ret = $this->pokemon[$key];
        return $ret;
    }
}