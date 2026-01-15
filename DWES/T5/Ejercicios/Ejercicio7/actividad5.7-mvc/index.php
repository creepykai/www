<?php

session_start();

include_once "controllers/Controller.php";

if (isset($_REQUEST['action']) && !is_null($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
} else if (isset($_REQUEST['name']) && !is_null($_REQUEST['name']) && isset($_REQUEST['salary']) && !is_null($_REQUEST['salary'])) {
    $action = 'add_employee';
} else {
    $action = "main";
}

$controller = new Controller();
if(method_exists($controller, $action)) {
    $phtml = $controller->$action();
} else {
    $phtml = "";
}

echo $phtml;