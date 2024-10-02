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

    public function showError($error){
        return $this->view->showError($error);
    }

    public function addGame(){
        if(!isset($_POST['title']) || empty($_POST['title'])) {
            return $this->view->showError('Falta completar el título');
        }
    
        if (!isset($_POST['category']) || empty($_POST['priority'])) {
            return $this->view->showError('Falta completar la prioridad');
        }
        
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        
            $id = $this->model->insertTask($title, $description, $category);
        
            // redirijo al home 
            header('Location: ' . BASE_URL);
        }
        
        public function deleteGame($id) {
            // obtengo la tarea por id
            $game = $this->model->getGame($id);
    
            if (!$game) {
                return $this->view->showError("No existe la tarea con el id=$id");
            }
    
            // borro la tarea y redirijo
            //$this->model->eraseGame($id);
    
            //header('Location: ' . BASE_URL);
        }
    


}




