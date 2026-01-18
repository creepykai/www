<?php
include_once 'controllers/ovniController.php';

$action = $_GET['action'] ?? 'main';

$controller = new ovniController();

if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    $controller->main();
}
