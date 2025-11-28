<?php
$title = "Mi Perfil";
//Incluyo el header para cargar la sesión y defino el titulo de la pagina
include("inc/header.php"); 


$datosPerfil = [];
$mensaje = "";
$errores = [];

//Si el usuario está logueado, se cargan los datos del perfil
if ($usuarioLogueado !== null) {
    $datosJugador = buscarJugadorPorUsuario($usuarioLogueado);
    if ($datosJugador) {
        $datosPerfil = [
            'username' => $datosJugador[0],
            'password' => $datosJugador[1], 
            'nombreCompleto' => $datosJugador[2],
            'pais' => $datosJugador[3],
            'telefono' => $datosJugador[4],
            'correo' => $datosJugador[5],
            'avatar' => $datosJugador[6],
        ];
    }
}

//Si se envía el formulario de perfil, se guardan los datos
if (isset($_GET['guardar_perfil'])) {
    
    $datosRecibidos = [
        'username' => $_GET['username'] ?? null,
        'password' => $_GET['password'] ?? null,
        'nombreCompleto' => $_GET['nombre_completo'] ?? null,
        'pais' => $_GET['pais'] ?? null,
        'telefono' => $_GET['telefono'] ?? null,
        'correo' => $_GET['correo'] ?? null,
        'avatar' => $_GET['avatar'] ?? null,
    ];

    $datosPerfil = array_merge($datosPerfil, $datosRecibidos);

    //Validación de datos
    if (empty($datosRecibidos['username']) || empty($datosRecibidos['password'])) {
        $errores[] = "El nombre de usuario y la contraseña son obligatorios.";
    }
    
    $regexTelefono = '/^[679]\d{8}$/';
    if (!empty($datosRecibidos['telefono']) && !preg_match($regexTelefono, $datosRecibidos['telefono'])) {
        $errores[] = "El teléfono debe ser de 9 cifras y empezar por 6, 7 o 9.";
    }

    $regexCorreo = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+$/';
    if (!empty($datosRecibidos['correo']) && !preg_match($regexCorreo, $datosRecibidos['correo'])) {
        $errores[] = "El correo debe tener el formato x@y.z (solo letras, números, puntos o guiones bajos).";
    }

    if (empty($errores)) {
        if (guardarJugador($datosRecibidos, $datosRecibidos['username'])) {
            $mensaje = "Datos guardados y validados correctamente.";

        } else {
            $mensaje = "Error al intentar guardar los datos.";
        }
    } else {
        $mensaje = "Datos no válidos. Por favor, corrige los errores.";
    }
}

?>

<h2>Configuración del Perfil</h2>
<p>Define tus datos de jugador. El nombre de usuario no se podrá cambiar una vez creado.</p>

<?php
if ($mensaje != "") {
    $claseAlerta = empty($errores) ? 'alert-success' : 'alert-danger';
    echo "<div class='alert $claseAlerta'>$mensaje</div>";
}
if (!empty($errores)) {
    echo '<div class="alert alert-danger"><ul>';
    foreach ($errores as $error) {
        echo "<li>$error</li>";
    }
    echo '</ul></div>';
}
?>

<form method="GET" action="perfil.php" class="row g-3">
    
    <div class="col-md-6">
        <label for="username" class="form-label">Nombre de Usuario*</label>
        <input type="text" class="form-control" id="username" name="username" 
               value="<?php echo htmlspecialchars($datosPerfil['username'] ?? ''); ?>"
               <?php if ($usuarioLogueado !== null) echo 'readonly'; ?>
        >
    </div>
    
    <div class="col-md-6">
        <label for="password" class="form-label">Contraseña*</label>
        <input type="password" class="form-control" id="password" name="password" 
               value="<?php echo htmlspecialchars($datosPerfil['password'] ?? ''); ?>" 
        >
    </div>
    
    <div class="col-12">
        <label for="nombre_completo" class="form-label">Nombre Completo</label>
        <input type="text" class="form-control" id="nombre_completo" name="nombre_completo"
               value="<?php echo htmlspecialchars($datosPerfil['nombreCompleto'] ?? ''); ?>"
        >
    </div>
    
    <div class="col-md-6">
        <label for="correo" class="form-label">Correo Electrónico</label>
        <input type="text" class="form-control" id="correo" name="correo"
               value="<?php echo htmlspecialchars($datosPerfil['correo'] ?? ''); ?>"
        >
    </div>

    <div class="col-md-6">
        <label for="telefono" class="form-label">Teléfono</label>
        <input type="text" class="form-control" id="telefono" name="telefono"
               value="<?php echo htmlspecialchars($datosPerfil['telefono'] ?? ''); ?>"
        >
    </div>
    
    <div class="col-md-6">
        <label for="pais" class="form-label">País</label>
        
        <select class="form-select" id="pais" name="pais">
            <?php
            $paises = leerPaises();
            foreach ($paises as $pais) {
                $seleccionado = ($datosPerfil['pais'] ?? '') === $pais ? 'selected' : '';
                echo "<option value=\"$pais\" $seleccionado>$pais</option>";
            }
            ?>
        </select>
    </div>

    <div class="col-12">
        <label class="form-label">Avatar</label>
        <div>
            <input type="radio" name="avatar" value="avatar1.jpg" id="avatar1" 
                   <?php if (($datosPerfil['avatar'] ?? 'avatar1.jpg') === 'avatar1.jpg') echo 'checked'; ?>>
            <label for="avatar1">Avatar 1</label>
            
            <input type="radio" name="avatar" value="avatar2.jpg" id="avatar2"
                   <?php if (($datosPerfil['avatar'] ?? 'avatar2.jpg') === 'avatar2.jpg') echo 'checked'; ?>>
            <label for="avatar2">Avatar 2</label>
            </div>
        </div>

    <div class="col-12 mt-4">
        <button type="submit" name="guardar_perfil" class="btn btn-primary">Confirmar datos</button>
    </div>
</form>

<?php
include("inc/footer.php"); 
?>