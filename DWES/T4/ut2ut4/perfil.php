<?php
$title = "Mi Perfil";
include("inc/header.php"); 


$datosPerfil = [];
$mensaje = "";
$errores = [];

// --- 1. LÓGICA DE CARGA DE DATOS (Si el usuario está logueado) ---
// Si hay un usuario logueado, precargamos sus datos
if ($usuarioLogueado !== null) {
    $datosJugador = buscarJugadorPorUsuario($usuarioLogueado);
    if ($datosJugador) {
        // Mapeamos los datos del array del modelo a un array asociativo para el formulario
        $datosPerfil = [
            'username' => $datosJugador[0],
            'password' => $datosJugador[1], // Se mostrará la contraseña en claro 
            'nombreCompleto' => $datosJugador[2],
            'pais' => $datosJugador[3],
            'telefono' => $datosJugador[4],
            'correo' => $datosJugador[5],
            'avatar' => $datosJugador[6],
        ];
    }
}

// --- 2. LÓGICA DE GUARDADO Y VALIDACIÓN ---
if (isset($_GET['guardar_perfil'])) {
    
    // Recoger los datos del formulario (GET)
    $datosRecibidos = [
        'username' => $_GET['username'] ?? null,
        'password' => $_GET['password'] ?? null,
        'nombreCompleto' => $_GET['nombre_completo'] ?? null,
        'pais' => $_GET['pais'] ?? null,
        'telefono' => $_GET['telefono'] ?? null,
        'correo' => $_GET['correo'] ?? null,
        'avatar' => $_GET['avatar'] ?? null,
    ];

    // Recargar datos recibidos para persistencia en el formulario
    $datosPerfil = array_merge($datosPerfil, $datosRecibidos);
    
    // --- VALIDACIONES A NIVEL DE SERVIDOR (Requisito 24) ---
    
    // Validar campos obligatorios (Usuario y Contraseña)
    if (empty($datosRecibidos['username']) || empty($datosRecibidos['password'])) {
        $errores[] = "El nombre de usuario y la contraseña son obligatorios.";
    }
    
    // 1. Teléfono: 9 cifras, empezando por 6, 7 o 9 
    $regexTelefono = '/^[679]\d{8}$/';
    if (!empty($datosRecibidos['telefono']) && !preg_match($regexTelefono, $datosRecibidos['telefono'])) {
        $errores[] = "El teléfono debe ser de 9 cifras y empezar por 6, 7 o 9.";
    }

    // 2. Correo: x@y.z (solo letras, números, puntos o guiones bajos) 
    $regexCorreo = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+$/';
    if (!empty($datosRecibidos['correo']) && !preg_match($regexCorreo, $regexCorreo)) {
        // Nota: La regex del enunciado es restrictiva, la he implementado de forma compatible.
        $errores[] = "El correo debe tener el formato x@y.z (solo letras, números, puntos o guiones bajos).";
    }

    // 3. Campos numéricos: Han de ser solo cifras (Aplicado al teléfono y simulación de otros) 
    // La validación del teléfono ya cubre esto.

    
    // --- PROCESAMIENTO FINAL ---
    if (empty($errores)) {
        if (guardarJugador($datosRecibidos, $datosRecibidos['username'])) {
             // Si el usuario ya existe, habrá que sustituir los datos [cite: 28] (simulado)
            $mensaje = "✅ Datos guardados y validados correctamente (simulado en jugadores.csv).";

        } else {
            $mensaje = "❌ Error al intentar guardar los datos.";
        }
    } else {
        $mensaje = "❌ Datos no válidos. Por favor, corrige los errores.";
    }
}

?>

<h2>Configuración del Perfil</h2>
<p>Define tus datos de jugador. El nombre de usuario no se podrá cambiar una vez creado[cite: 21].</p>

<?php
if ($mensaje != "") {
    // Si hay un mensaje, lo mostramos
    $claseAlerta = empty($errores) ? 'alert-success' : 'alert-danger';
    echo "<div class='alert $claseAlerta'>$mensaje</div>";
}
// Mostrar lista de errores si existen
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
               <?php if ($usuarioLogueado !== null) echo 'readonly'; // Si está logueado, no se puede cambiar ?>
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
            $paises = leerPaises(); // Cargar países del modelo
            foreach ($paises as $pais) {
                // Seleccionar el país guardado
                $seleccionado = ($datosPerfil['pais'] ?? '') === $pais ? 'selected' : '';
                echo "<option value=\"$pais\" $seleccionado>$pais</option>";
            }
            ?>
        </select>
    </div>

    <div class="col-12">
        <label class="form-label">Avatar (simulado)</label>
        <div>
            <input type="radio" name="avatar" value="avatar1.png" id="avatar1" 
                   <?php if (($datosPerfil['avatar'] ?? 'avatar1.png') === 'avatar1.png') echo 'checked'; ?>>
            <label for="avatar1">Avatar 1</label>
            
            <input type="radio" name="avatar" value="avatar2.png" id="avatar2"
                   <?php if (($datosPerfil['avatar'] ?? 'avatar1.png') === 'avatar2.png') echo 'checked'; ?>>
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