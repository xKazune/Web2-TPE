<?php
require_once 'app/controllers/games.controller.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// Accion por defecto al abrir la pagina
$action = 'index'; 
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}


// Tabla de ruteo

// listar  -> GamesController->showGames();

$params = explode('/', $action);


switch ($params[0]) {
    case 'index':
        $controller = new GamesController();
        $controller->showHome();
        break;
    case 'listarJuegos':
        $controller = new GamesController();
        $controller->showGames();
        break;
    case 'listarPlataformas':
        $controller = new GamesController();
        $controller->showPlatforms();
        break;
    case 'nueva':
        $controller = new GamesController();
        $controller->addGame();
        break;
    case 'showLogin':
        $controller = new GamesController();
        $controller->showError("Falta por Hacer");
        break;
    case 'login':
        $controller = new GamesController();
        $controller->showError("Falta por Hacer");
        break;
    case 'error':
        $controller = new GamesController();
        $controller->showError("404 Page Not Found");
        break;
    default:
        //Asi esta bien que se controle?
        $controller = new GamesController();
        $error= "404 Page Not Found";
        $controller->showError($error); 
        break;
}