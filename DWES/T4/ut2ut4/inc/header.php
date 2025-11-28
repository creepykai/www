<?php
session_start();

include('inc/model.php');

$usuarioLogueado = $_SESSION['usuarioLogueado'] ?? null;
$esAdmin = $_SESSION['esAdmin'] ?? false;

if ($usuarioLogueado != null && !isset($_SESSION['partida'])) {
    $_SESSION['partida'] = [
        'puntuacionActual' => 0,            
        'preguntasRealizadas' => 0,         
        'acertadas' => 0,                   
        'racha' => 0,                       
        'preguntasYaHechas' => [],          
        'preguntasDisponibles' => leerPreguntas(), // Carga las preguntas
    ];
}

// Hacemos la variable local accesible a todos los scripts
$datosPartida = $_SESSION['partida'] ?? null;

if (isset($_GET['login'])) {
    
    $jugadores = leerJugadores(); 
    $loginExitoso = false; 
    
    foreach ($jugadores as $jugador) {
        if (isset($_GET['username']) && isset($_GET['password']) &&
            $_GET['username'] == $jugador[0] && 
            $_GET['password'] == $jugador[1]) {
            
            // Login exitoso: Almacenar en la sesión
            $_SESSION['usuarioLogueado'] = $jugador[0];// Mecanismo de autentificación [cite: 96]
            
            if ($_SESSION['usuarioLogueado'] == 'elchokas') { // Restricción de acceso para Editar preguntas [cite: 29]
                $_SESSION['esAdmin'] = true;
            } else {
                $_SESSION['esAdmin'] = false;
            }
            $loginExitoso = true;
            break;
        }
    }

    if ($loginExitoso) {
        // Actualizar las variables locales para esta ejecución del script
        $usuarioLogueado = $_SESSION['usuarioLogueado'];
        $esAdmin = $_SESSION['esAdmin'];
    }

// Manejar la desconexión
} elseif ($usuarioLogueado != null && isset($_GET['desconectar'])) {// Destruir la información asociada al usuario actual no guardada [cite: 15]
    session_unset();
    session_destroy();
    
    // Actualizar variables locales
    $usuarioLogueado = null;
    $esAdmin = false;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title><?php echo $title; ?> - Juego DWES</title>
</head>
<body>

    <header class="fixed-top">

        <div class="bg-primary text-white p-3">
            <div class="container">
                
                <?php if ($usuarioLogueado != null): ?>
                    <div>
                        <span>Bienvenido, <?php echo $usuarioLogueado; ?></span>
                        <a href="index.php?desconectar=true" class="btn btn-light btn-sm">Desconectar</a>
                    </div>
                <?php else: ?>
                    <form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="d-flex">
                        <input type="text" name="username" class="form-control form-control-sm me-2" placeholder="Usuario">
                        <input type="password" name="password" class="form-control form-control-sm me-2" placeholder="Contraseña">
                        <button type="submit" name="login" class="btn btn-success btn-sm">Conectar</button>
                    </form>
                <?php endif; ?>

            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">Inicio</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="perfil.php">Perfil</a></li>
                    
                    <?php
                    $habilitado = ($usuarioLogueado != null);
                    ?>

                    <li class="nav-item">
                        <a class="nav-link <?php if (!$esAdmin) echo 'disabled'; ?>" href="editar.php">Editar Preguntas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (!$habilitado) echo 'disabled'; ?>" href="jugar.php">Jugar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (!$habilitado) echo 'disabled'; ?>" href="mejores.php">Mejores Jugadores</a>
                    </li>
                </ul>
            </div>
        </nav>

    </header> <main class="container my-4">