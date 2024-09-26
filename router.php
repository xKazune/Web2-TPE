<?php
require_once 'app/controllers/games.controller.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// Accion por defecto al abrir la pagina
$action = 'listar'; 
//if (!empty( $_GET['action'])) {
//    $action = $_GET['action'];
//}


// Tabla de ruteo

// listar  -> GamesController->showGames();

$params = explode('/', $action);


switch ($params[0]) {
    case 'listar':
        $controller = new GamesController();
        $controller->showGames();
        break;
    default: 
        echo "404 Page Not Found"; //Deberia hacer que el controlador maneje esto.
        break;
}