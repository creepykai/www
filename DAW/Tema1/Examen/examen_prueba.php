<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mezclar letras de una frase</title>
</head>
<body>
    <form method="post" action="">
        <label for="frase">Introduce una frase:</label><br><br>
        <input type="text" name="frase" id="frase" required>
        <br><br>
        <input type="submit" value="Mezclar letras">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $frase = trim($_POST["frase"]); // elimina espacios al principio y final
        $mezclada = str_shuffle($frase);
        echo "<div class='resultado'>";
        echo "<strong>Frase original:</strong> " . htmlspecialchars($frase) . "<br>";
        echo "<strong>Frase mezclada:</strong> " . htmlspecialchars($mezclada);
        echo "</div>";
    }
    ?>
</body>
</html>