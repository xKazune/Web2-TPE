<?php
require_once 'libs/response.php';
require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/middlewares/verify.auth.middleware.php';
require_once 'app/controllers/games.controller.php';
require_once 'app/controllers/auth.controller.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response();

// Accion por defecto al abrir la pagina
$action = 'index'; 
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

// tabla de ruteo

// index -> GamesController->showHome();
// listarJuegos  -> GamesController->showGames();
// listarPlataformas  -> GamesController->showPlataforms();
// agregar -> GamesController->addGame();
// borrar -> GamesController->deleteGame();
// login -> GamesController->showLogin();
// formJuego -> GamesController->showForm();
// formEditar -> GamesController->showFormEdit();
// editar -> GamesController->editGame();

$params = explode('/', $action);

switch ($params[0]) {
    case 'index':
        sessionAuthMiddleware($res);
        $controller = new GamesController($res);
        $controller->showHome();
        break;
    case 'listarJuegos':
        //REVISAR EL SESSIONAUTHMIDDLEWARE
        sessionAuthMiddleware($res);
        $controller = new GamesController($res);
        $controller->showGames();
        break;
    case 'listarPlataformas':
        sessionAuthMiddleware($res);
        $controller = new GamesController($res);
        $controller->showPlatforms();
        break;
    case 'agregar':
        sessionAuthMiddleware($res);//setea $res -> user si existe session
        verifyAuthMiddleware($res);//verifica que el usuario este logueado o redirije a la sesion
        $controller = new GamesController($res);
        $controller->addGame();
        break;
    case 'borrar':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new GamesController($res);
        $controller->deleteGame($params[1]);
        break;
    case 'showLogin':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    case 'formJuego':
        sessionAuthMiddleware($res);
        $controller = new GamesController($res);
        $controller->showForm();
        break;
    case 'formEditar':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new GamesController($res);
        $controller->showFormEdit($params[1]);
        break;
    case 'editar':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new GamesController($res);
        $controller->editGame($params[1]);
        break;
    case 'error':
        sessionAuthMiddleware($res);
        //$controller = new GamesController();
        $controller->showError("404 Page Not Found");
        break;
    default:
        //Asi esta bien que se controle?
        $controller = new GamesController();
        $error= "404 Page Not Found";
        $controller->showError($error); 
        break;
}