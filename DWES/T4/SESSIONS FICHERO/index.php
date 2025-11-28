<?php
include_once "functions.php";

$datos = extraer_datos();

if (isset($_GET["user"]) && !empty($_GET["user"]) && isset($_GET["pass"]) && !empty($_GET["pass"])) {
    $user = $_GET["user"];
    $pass = $_GET["pass"];

    $rol = comprobar_usuario($user, $pass, $datos);

    if(!empty($rol)) {
        setcookie("last_user", $user, time() + 604800);
        setcookie("last_role", $rol, time() + 604800);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
    </head>
    <body>
        <?php
        $datos = extraer_datos();
        // print_r($datos);

        // if (isset($_GET["user"]) && !empty($_GET["user"]) && isset($_GET["pass"]) && !empty($_GET["pass"])) {
        //     $user = $_GET["user"];
        //     $pass = $_GET["pass"];

        //     $rol = comprobar_usuario($user, $pass, $datos);
        if (isset($user) && !empty($user) && isset($pass) && !empty($pass)){
            if (!empty($rol)) {
                echo "<p>Conectado usuario $user ($rol)</p>";
            }
            else {
                echo "<p>El usuario no existe</p>";
            }

            if (isset($_COOKIE["last_user"]) && !empty($_COOKIE["last_user"]) && isset($_COOKIE["last_role"]) && !empty($_COOKIE["last_role"])) {
                echo "<p>El último usuario registrado fue: {$_COOKIE['last_user']} ({$_COOKIE['last_role']})</p>";
            }
            else {
                echo "<p>No hay registro del último usuario registrado (cookie no encontrada)</p>";
            }
        }
        // else {
        //     ?>
            <!-- <form action="" method="get">
        //         <label for="usuario">Usuario</label>
        //         <input type="text" name="user" id="usuario" required /><br />
        //         <label for="contrasenia">Contraseña</label>
        //         <input type="password" name="pass" id="contrasenia" required /><br />
        //         <button type="submit">Entrar</button>
        //     </form> -->
            <?php
        // }
        // ?>
        <h2>Páginas de prueba:</h2>
        <ul>
            <li><a href="index.php?user=ana&pass=1234">ana</a></li>
            <li><a href="index.php?user=luis&pass=abcd">luis</a></li>
            <li><a href="index.php?user=marta&pass=pass123">marta</a></li>
            <li><a href="index.php?user=pepe&pass=cafe">no eexiste</a></li>
            <li><a href="index.php?user=ana&pass=123">contraseña mal</a></li>
        </ul>
    </body>
</html>