<?php
declare(strict_types=1); // Obliga a usar los tipos estrictos (mejor control de errores)

// Carga automática de todas las librerías instaladas con Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Incluye los resolvers (definen qué devuelve cada campo del esquema)
include_once __DIR__ . '/rootresolver.php';

// Importa las clases principales del paquete GraphQL
use GraphQL\Utils\BuildSchema;
use GraphQL\Server\StandardServer;

// 1️⃣ Carga y construye el esquema GraphQL desde el archivo schema.graphql
$schema = BuildSchema::build(file_get_contents(__DIR__ . '/schema.graphql'));

// 2️⃣ Crea el servidor GraphQL con el esquema y los resolvers
$server = new StandardServer([
  'schema' => $schema,                 // Define las consultas posibles
  'rootValue' => $root_fields_Resolver // Define las funciones que devuelven los datos
]);

// 3️⃣ Atiende las peticiones HTTP (por ejemplo, las que hagas con curl o Postman)
$server->handleRequest();
