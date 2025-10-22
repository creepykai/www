<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mezclar letras de una frase</title>
</head>
<body>

    <h2>Mezclador de letras</h2>

    <form method="post" action="">
        <label for="frase">Introduce una frase:</label><br><br>
        <input type="text" name="frase" id="frase" required>
        <br><br>
        <input type="submit" value="Mezclar letras">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $frase = $_POST["frase"];
        $mezclada = str_shuffle($frase);
        echo "<div class='resultado'><strong>Frase original:</strong> $frase<br>";
        echo "<strong>Frase mezclada:</strong> $mezclada</div>";
    }
    ?>
</body>
</html>