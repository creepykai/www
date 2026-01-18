<?php
class ovniView
{
    private $phtml;
    function __construct()
    {
        $this->phtml = "";
    }

    function Header(): void
    {
        $phtml = "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset=\"utf-8\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/ovni.css\">
    <title>Avistamientos OVNI</title>
</head>
<body>
<main>
	<header>
		<h1><a href=\"index.php\">Avistamientos OVNI</a></h1>
	</header>
	<article>";
        $this->phtml .= $phtml;
    }

    function Footer(): void
    {

        $phtml = "
    </article>
    <footer>
		<span style=\"font-size:15px\">DWES 2024/2025</span>
    </footer>
</main>
</body>
</html>";
        $this->phtml .= $phtml;
    }

    function not_found(string $type, mixed $id): void
    {
        $phtml = "
        <p>No se encontró $type con ID $id</p>";
        $this->phtml .= $phtml;
    }

    function error(string $message): void
    {
        $phtml = "
		<p class='error'>Error: $message</p>";
        $this->phtml .= $phtml;
    }

    function select(array $list): void
    {
        $phtml = "
        <form method=\"get\" action=\"index.php\">
			<label for='ovniSelect'>Selecciona un caso:</label>
			<select name=\"id\" id='ovniSelect'>";

        foreach ($list as $id => $year) {
            $phtml .= "<option value=\"$id\">Caso $id ($year)</option>";
        }
        $phtml .= "</select>
             <button type=\"submit\" name=\"action\" value=\"datos\">Ver Datos</button>
        </form>";
        $this->phtml .= $phtml;
    }

    function showData(array $headers, array $data): void
    {
        if (empty($data)) return;

        $phtml = "
        <div class='ficha-ovni'>
            <h2>Detalles del Caso</h2>
            <ul>";

        foreach ($data as $index => $value) {
            $label = $headers[$index] ?? "Campo $index";
            $valSafe = htmlspecialchars($value);

            $phtml .= "<li><strong>$label:</strong> $valSafe</li>";
        }

        $phtml .= "
            </ul>
        </div>";
        $this->phtml .= $phtml;
    }

    public function getPhtml(): string
    {
        return $this->phtml;
    }
}
