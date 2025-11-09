<?php
$title = "Mi Perfil";

$datosGuardados = [];
$mensaje = "";

if (isset($_GET['guardar_perfil'])) {

    $datosGuardados = [
        'username' => $_GET['username'] ?? null,
        'password' => $_GET['password'] ?? null,
        'nombre_completo' => $_GET['nombre_completo'] ?? null,
        'pais' => $_GET['pais'] ?? null,
        'telefono' => $_GET['telefono'] ?? null,
        'correo' => $_GET['correo'] ?? null,
        'avatar' => $_GET['avatar'] ?? null,
    ];
    
    $mensaje = "Datos recibidos en el array.";
}

include("inc/header.php"); 
?>

<h2>Configuración del Perfil</h2>
<p>Define tus datos de jugador. El nombre de usuario no se podrá cambiar una vez creado.</p>

<?php
if ($mensaje != "") {
    echo "<p style='color:green;'>$mensaje</p>";
}
?>

<form method="GET" action="perfil.php" class="row g-3">
    
    <div class="col-md-6">
        <label for="username" class="form-label">Nombre de Usuario*</label>
        <input type="text" class="form-control" id="username" name="username">
    </div>
    
    <div class="col-md-6">
        <label for="password" class="form-label">Contraseña*</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    
    <div class="col-12">
        <label for="nombre_completo" class="form-label">Nombre Completo</label>
        <input type="text" class="form-control" id="nombre_completo" name="nombre_completo">
    </div>
    
    <div class="col-md-6">
        <label for="correo" class="form-label">Correo Electrónico</label>
        <input type="text" class="form-control" id="correo" name="correo">
    </div>

    <div class="col-md-6">
        <label for="telefono" class="form-label">Teléfono</label>
        <input type="text" class="form-control" id="telefono" name="telefono">
    </div>
    
    <div class="col-md-6">
        <label for="pais" class="form-label">País</label>
        
        <select class="form-select" id="pais" name="pais">
            <?php
            $paises = read_countries();
            foreach ($paises as $pais) {
                echo "<option value=\"$pais\">$pais</option>";
            }
            ?>
        </select>
    </div>

    <div class="col-12">
        <label class="form-label">Avatar (simulado)</label>
        <div>
            <input type="radio" name="avatar" value="avatar1.png" id="avatar1" checked>
            <label for="avatar1">Avatar 1</label>
            
            <input type="radio" name="avatar" value="avatar2.png" id="avatar2">
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