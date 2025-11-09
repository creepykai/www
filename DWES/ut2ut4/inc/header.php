<?php
include('model.php');

$usuarioLogueado = null;
$esAdmin = false;

if (isset($_GET['login'])) {
    
    $jugadores = read_players();
    
    foreach ($jugadores as $jugador) {
        if (isset($_GET['username']) && isset($_GET['password']) &&
            $_GET['username'] == $jugador[0] && 
            $_GET['password'] == $jugador[1]) {
            
            $usuarioLogueado = $jugador[0];
            
            if ($usuarioLogueado == 'elchokas') {
                $esAdmin = true;
            }
            break;
        }
    }
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
                        <a href="index.php" class="btn btn-light btn-sm">Desconectar</a>
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