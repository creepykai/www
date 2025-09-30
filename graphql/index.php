<?php
declare(strict_types=1); #todo el tipo tiene que ser de modo php
global $root_fields_Resolver; #variable global

require_once __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/rootresolver.php'; //DIR dice que la ruta sea relativa

use GraphQL\Utils\BuildSchema; //use sería un import de python
use GraphQL\Server\StandardServer;

$contents = file_get_contents(__DIR__. '/schema.graphql');
$schema = BuildSchema::build($contents);
$server = new StandardServer([
    'schema' => $schema,
    'rootValue' => $root_fields_Resolver,
]);

try{
    $server->handleRequest();
} catch (Exception $e){
    echo json_encode(['error' => $e->getMessage()]);
                    // un error -> que manda un mensaje de error en json
}