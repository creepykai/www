<?php
declare(strict_types=1);
require_once 'proceso.php';

$rutaArchivoUsuarios = 'usuarios.txt';
$usuariosSistema = cargarUsuarios($rutaArchivoUsuarios);

$mensaje = '';
$usuario = $_GET['usuario'] ?? '';
$clave = $_GET['clave'] ?? '';

$cookieUltimoUsuario = $_COOKIE['ultimoUsuario'] ?? '';
$cookieUltimoRol = $_COOKIE['ultimoRol'] ?? '';

if ($usuario !== '' && $clave !== '') {
    $resultadoAutenticacion = verificarCredenciales($usuario, $clave, $usuariosSistema);

    if ($resultadoAutenticacion !== null) {
        $rol = $resultadoAutenticacion['rol'];
        $mensaje = 'Conectado usuario ' . $usuario . ' (' . $rol . ')';
        
        setcookie('ultimoUsuario', $usuario, time() + (86400 * 30));
        setcookie('ultimoRol', $rol, time() + (86400 * 30));
        
        $cookieUltimoUsuario = $usuario;
        $cookieUltimoRol = $rol;
        
    } else {
        $mensaje = 'El usuario no existe o la contraseña es incorrecta.';
        
        $cookieUltimoUsuario = $_COOKIE['ultimoUsuario'] ?? '';
        $cookieUltimoRol = $_COOKIE['ultimoRol'] ?? '';
    }
} else {
    $mensaje = 'Acceso a la página. Introduce credenciales vía URL.';
}

imprimirResultado($mensaje);
imprimirInfoCookie($cookieUltimoUsuario, $cookieUltimoRol);