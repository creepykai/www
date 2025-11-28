<?php
//Arranca la sesión si no está arrancada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//Carga el modelo
require_once __DIR__ . '/model.php';

//Recupero las variables de sesión
$usuarioLogueado = $_SESSION['usuarioLogueado'] ?? null;
$esAdmin = $_SESSION['esAdmin'] ?? false;

//Si el usuario está logueado y no hay partida, se crea una
if ($usuarioLogueado != null && !isset($_SESSION['partida'])) {
    $_SESSION['partida'] = [
        'puntuacionActual' => 0,            
        'preguntasRealizadas' => 0,         
        'acertadas' => 0,                   
        'racha' => 0,                       
        'preguntasYaHechas' => [],          
        'preguntasDisponibles' => leerPreguntas(),
    ];
}

//Hago accesible la partida para el resto de la página
$datosPartida = $_SESSION['partida'] ?? null;

//Maneja el login: COmpruebo si usuario y pass coinciden con el csv
if (isset($_GET['login'])) {
    
    $jugadores = leerJugadores(); 
    $loginExitoso = false; 
    
    foreach ($jugadores as $jugador) {
        if (isset($_GET['username']) && isset($_GET['password']) &&
            $_GET['username'] == $jugador[0] && 
            $_GET['password'] == $jugador[1]) {
            
            $_SESSION['usuarioLogueado'] = $jugador[0];
            
            //Si el usuario es el admin, se marca como admin
            if ($_SESSION['usuarioLogueado'] == 'elchokas') { 
                $_SESSION['esAdmin'] = true;
            } else {
                $_SESSION['esAdmin'] = false;
            }
            $loginExitoso = true;
            break;
        }
    }

    //Si el login es exitoso, se actualizan las variables de sesión
    if ($loginExitoso) {
        $usuarioLogueado = $_SESSION['usuarioLogueado'];
        $esAdmin = $_SESSION['esAdmin'];
    }
//Si el usuario está logueado y quiere desconectar, se destruye la sesión
} elseif ($usuarioLogueado != null && isset($_GET['desconectar'])) {
    session_unset();
    session_destroy();
    
    $usuarioLogueado = null;
    $esAdmin = false;
    $datosPartida = null;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title><?php echo $title ?? 'QUIZ'; ?></title>
</head>
<body style="background-color: #f8f9fa;"> <header class="fixed-top shadow-sm">

        <div class="text-white p-3" style="background-color: #2d0036;">
            <div class="container">
                
                <?php if ($usuarioLogueado != null): ?>
                    <div class="d-flex align-items-center gap-2">
                        <?php 
                            $datosUser = buscarJugadorPorUsuario($usuarioLogueado);
                            $archivoAvatar = $datosUser[6] ?? 'avatar1.jpg'; 
                        ?>
                        
                        <img src="<?php echo htmlspecialchars($archivoAvatar); ?>" 
                             alt="Avatar" 
                             class="rounded-circle" 
                             style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #e0aaff;">
                        
                        <span>Bienvenido, <strong><?php echo htmlspecialchars($usuarioLogueado); ?></strong></span>
                        
                        <a href="index.php?desconectar=true" class="btn btn-sm text-white ms-2" style="background-color: #b04279; border: none;">Desconectar</a>
                    </div>
                <?php else: ?>
                    <form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="d-flex align-items-center">
                        <input type="text" name="username" class="form-control form-control-sm me-2" placeholder="Usuario" style="background-color: #f3e5f5; border: none;">
                        <input type="password" name="password" class="form-control form-control-sm me-2" placeholder="Contraseña" style="background-color: #f3e5f5; border: none;">
                        <button type="submit" name="login" class="btn btn-sm text-white" style="background-color: #d81b60;">Conectar</button>
                    </form>
                <?php endif; ?>

            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #000000; border-bottom: 3px solid #4a148c;">
            <div class="container">
                <a class="navbar-brand text-uppercase fw-bold" href="index.php" style="color: #e0aaff;">Juego DWES</a>
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
                        <a class="nav-link <?php if (!$habilitado) echo 'disabled'; ?>" href="mejores.php">Ranking</a>
                    </li>
                </ul>
            </div>
        </nav>

    </header> 
    <main class="container my-4" style="padding-top: 20px;">