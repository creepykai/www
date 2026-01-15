<?php

class View {
    private $phtml;

    public function __construct() {
        $this->phtml = "";
    }

    public function __toString() {
        return $this->phtml;
    }

    public function header(): void {
        $this->phtml .= "
<!DOCTYPE html>
<html>
    <head>
        <title>Ejercicio 5.7 MVC</title>
    </head>
    <body>";
    }

    public function footer(): void {
        $this->phtml .= "
    </body>
</html>";
    }

    public function default_content(): void {
        $this->phtml .= "
        <h1>Empresa</h1>
        <a href='index.php?action=add_employee_form'>Añadir empleado</a><br />
        <a href='index.php?action=see_employees'>Ver empleados</a><br />";
    }

    public function add_employee_form(): void {
        $this->phtml .= "
        <a href='index.php'>Atrás</a><br />
        <form action='index.php' method='get'>
            <input type='text' name='name' placeholder='Nombre' required /><br />
            <input type='number' name='salary' placeholder='Salrio' required /><br />
            <button type='submit'>Guardar</button>
        </form>";
    }

    public function add_employee(): void {
        $this->phtml .= "
        <a href='index.php'>Atrás</a><br />
        <p>Empleado añadido correctamente</p>";
    }

    public function see_employees($empresa): void {
        $this->phtml .= "
        <a href='index.php'>Atrás</a><br />" . $empresa;
    }
}