<?php
declare(strict_types=1);

function cargarUsuarios(string $rutaArchivo): array
{
    $usuarios = [];
    if (file_exists($rutaArchivo)) {
        $lineas = file($rutaArchivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        $numeroLineas = count($lineas);
        
        for ($i = 0; $i < $numeroLineas; $i += 3) {
            if (isset($lineas[$i], $lineas[$i + 1], $lineas[$i + 2])) {
                $nombre = trim($lineas[$i]);
                $usuarios[$nombre] = [
                    'clave' => trim($lineas[$i + 1]),
                    'rol' => trim($lineas[$i + 2])
                ];
            }
        }
    }
    return $usuarios;
}

function verificarCredenciales(string $usuario, string $clave, array $usuarios): ?array
{
    if (isset($usuarios[$usuario])) {
        if ($usuarios[$usuario]['clave'] === $clave) {
            return $usuarios[$usuario];
        }
    }
    return null;
}

function imprimirEncabezado(): void
{
    echo '<!DOCTYPE html>';
    echo '<html lang="es">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>U.T. 4: Aplicaciones web con estado</title>';
    echo '</head>';
    echo '<body>';
    echo '<h1>Simulacro de Acceso</h1>';
}

function imprimirPie(): void
{
    echo '</body>';
    echo '</html>';
}

function imprimirResultado(string $mensaje): void
{
    imprimirEncabezado();
    echo '<p><strong>Resultado:</strong> ' . $mensaje . '</p>';
    echo '<h2>Páginas de prueba:</h2>';
    echo '<ul>';
    echo '<li><a href="index.php?usuario=ana&clave=1234">ana (admin)</a></li>';
    echo '<li><a href="index.php?usuario=luis&clave=abcd">luis (editor)</a></li>';
    echo '<li><a href="index.php?usuario=marta&clave=pass123">marta (invitado)</a></li>';
    echo '<li><a href="index.php?usuario=noexiste&clave=123">no existe</a></li>';
    echo '<li><a href="index.php?usuario=ana&clave=mal">contraseña mal</a></li>';
    echo '</ul>';
}

function imprimirInfoCookie(string $ultimoUsuario, string $ultimoRol): void
{
    echo '<h2>Información de la última conexión (Cookies)</h2>';
    if ($ultimoUsuario !== '' && $ultimoRol !== '') {
        echo '<p>El último usuario registrado fue: ' . $ultimoUsuario . ' (' . $ultimoRol . ')</p>';
    } else {
        echo '<p>No hay registro del último usuario registrado (cookie no encontrada)</p>';
    }
    imprimirPie();
}