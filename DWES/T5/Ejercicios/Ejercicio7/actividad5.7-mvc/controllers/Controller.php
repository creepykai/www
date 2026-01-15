<?php

include_once "views/View.php";
include_once "models/Empresa.php";

class Controller {
    private $empresa;

    public function __construct() {
        if (isset($_SESSION['empresa'])) {
            $this->empresa = unserialize($_SESSION['empresa']);
        } else {
            $this->empresa = new Empresa();
            $_SESSION['empresa'] = serialize($this->empresa);
        }
    }

    public function main() {
        $view = new View();
        $view->header();
        $view->default_content();
        $view->footer();
        return $view;
    }

    public function add_employee_form() {
        $view = new View();
        $view->header();
        $view->add_employee_form();
        $view->footer();
        return $view;
    }

    public function add_employee() {
        $this->empresa->add_employee($_REQUEST['name'], $_REQUEST['salary']);
        $_SESSION['empresa'] = serialize($this->empresa);
        $view = new View();
        $view->header();
        $view->add_employee();
        $view->footer();
        return $view;
    }

    public function see_employees() {
        $view = new View();
        $view->header();
        $view->see_employees($this->empresa);
        // echo $this->empresa;
        $view->footer();
        return $view;
    }

}