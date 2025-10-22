<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GraphQL\Type\Schema;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Server\StandardServer;
use GraphQL\Error\DebugFlag;
use GraphQL\Error\FormattedError;

$peliculasData = [
    ['id' => '1', 'titulo' => 'Blade Runner', 'anio' => 1982, 'actoresIds' => ['1', '2']],
    ['id' => '2', 'titulo' => 'Inception', 'anio' => 2010, 'actoresIds' => ['3', '4']],
    ['id' => '3', 'titulo' => 'The Matrix', 'anio' => 1999, 'actoresIds' => ['5', '6']],
    ['id' => '4', 'titulo' => 'Interstellar', 'anio' => 2014, 'actoresIds' => ['7', '8']],
];

$actoresData = [
    ['id' => '1', 'nombre' => 'Harrison Ford', 'peliculasIds' => ['1']],
    ['id' => '2', 'nombre' => 'Rutger Hauer', 'peliculasIds' => ['1']],
    ['id' => '3', 'nombre' => 'Leonardo DiCaprio', 'peliculasIds' => ['2']],
    ['id' => '4', 'nombre' => 'Joseph Gordon-Levitt', 'peliculasIds' => ['2']],
    ['id' => '5', 'nombre' => 'Keanu Reeves', 'peliculasIds' => ['3']],
    ['id' => '6', 'nombre' => 'Laurence Fishburne', 'peliculasIds' => ['3']],
    ['id' => '7', 'nombre' => 'Matthew McConaughey', 'peliculasIds' => ['4']],
    ['id' => '8', 'nombre' => 'Anne Hathaway', 'peliculasIds' => ['4']],
];


function findPeliculaById(array $peliculas, string $id): ?array {
    foreach ($peliculas as $p) if ($p['id'] === $id) return $p;
    return null;
}

function findActorById(array $actores, string $id): ?array {
    foreach ($actores as $a) if ($a['id'] === $id) return $a;
    return null;
}

$types = [];

$types['Actor'] = new ObjectType([
    'name' => 'Actor',
    'fields' => function () use (&$types, &$peliculasData) {
        return [
            'id' => Type::nonNull(Type::id()),
            'nombre' => Type::nonNull(Type::string()),
            'peliculas' => [
                'type' => Type::listOf($types['Pelicula']),
                'resolve' => function ($actor) use (&$peliculasData) {
                    $result = [];
                    foreach ($actor['peliculasIds'] as $pid) {
                        $p = findPeliculaById($peliculasData, (string)$pid);
                        if ($p) $result[] = $p;
                    }
                    return $result;
                }
            ],
        ];
    }
]);

$types['Pelicula'] = new ObjectType([
    'name' => 'Pelicula',
    'fields' => function () use (&$types, &$actoresData) {
        return [
            'id' => Type::nonNull(Type::id()),
            'titulo' => Type::nonNull(Type::string()),
            'anio' => Type::nonNull(Type::int()),
            'actores' => [
                'type' => Type::listOf($types['Actor']),
                'resolve' => function ($pelicula) use (&$actoresData) {
                    $result = [];
                    foreach ($pelicula['actoresIds'] as $aid) {
                        $a = findActorById($actoresData, (string)$aid);
                        if ($a) $result[] = $a;
                    }
                    return $result;
                }
            ],
        ];
    }
]);

$queryType = new ObjectType([
    'name' => 'Query',
    'fields' => [
        'peliculas' => [
            'type' => Type::listOf($types['Pelicula']),
            'resolve' => fn() => $GLOBALS['peliculasData']
        ],
        'peliculaPorId' => [
            'type' => $types['Pelicula'],
            'args' => ['id' => Type::nonNull(Type::id())],
            'resolve' => fn($root, $args) => findPeliculaById($GLOBALS['peliculasData'], (string)$args['id'])
        ],
        'actores' => [
            'type' => Type::listOf($types['Actor']),
            'resolve' => fn() => $GLOBALS['actoresData']
        ],
        'actorPorId' => [
            'type' => $types['Actor'],
            'args' => ['id' => Type::nonNull(Type::id())],
            'resolve' => fn($root, $args) => findActorById($GLOBALS['actoresData'], (string)$args['id'])
        ],
    ]
]);

$schema = new Schema(['query' => $queryType]);

try {
    $server = new StandardServer([
        'schema' => $schema,
        'debugFlag' => DebugFlag::INCLUDE_DEBUG_MESSAGE | DebugFlag::INCLUDE_TRACE,
    ]);
    $server->handleRequest();
} catch (Throwable $e) {
    $error = FormattedError::createFromException($e);
    echo json_encode(['errors' => [$error]]);
}

