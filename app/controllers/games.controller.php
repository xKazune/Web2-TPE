<?php
require_once './app/models/games.model.php';
require_once './app/views/games.view.php';

class GamesController{
    private $model;
    private $view;

    public function __construct() {
        $this->model = new GamesModel();
        $this->view = new GamesView();
    }

    public function showGames() {
        // obtengo los juegos de la DB
        $games = $this->model->getGames();

        // mando las tareas a la vista
        return $this->view->showGames($games);
    }
}