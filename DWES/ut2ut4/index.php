<?php
$title = "Bienvenida"; 

include("inc/header.php"); 
?>

<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
        <h2 class="display-5 fw-bold">¡Bienvenido al Juego!</h2>
        <p class="col-md-8 fs-4">
            Por favor, conéctate usando el formulario de la cabecera para jugar.
        </p>
        <p>
            Si eres un usuario nuevo o quieres cambiar tus datos, ve a la sección 
            <a href="perfil.php">Perfil</a>.
        </p>
    </div>
</div>

<?php
include("inc/footer.php"); 
?>