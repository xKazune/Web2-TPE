<?php
require_once './app/models/games.model.php';
require_once './app/views/games.view.php';

class GamesController{
    private $model;
    private $view;

    public function __construct($res) {
        $this->model = new GamesModel();
        $this->view = new GamesView($res->user);
    }

    public function showHome(){
        return $this->view->showHome();
    }

    //Muestra todos los juegos. ¿Con detalles?
    public function showGames() {
        // obtengo los juegos de la DB
        $games = $this->model->getGames();

        // mando los juegos a la vista
        return $this->view->showGames($games);
    }

    //Muestra el listado de las plataformas.
    public function showPlatforms(){
        $platforms = $this->model->getPlatforms();
        return $this->view->showPlatforms($platforms);
    }

    //Muestro el formulario
    public function showForm(){
        return $this->view->showForm();
    }

    //Agrega un Juego
    public function addGame() {
        //HAGO TODAS LAS VERIFICACIONES NECESARIAS
        //DEBERIA VERIFICAR QUE LA PLATAFORMA O EL GENERO EXISTAN EN SU TABLA?

        if (!isset($_POST['title']) || empty($_POST['title'])) {
            return $this->view->showError('Falta agregar el titulo del juego.');
        }
        if (!isset($_POST['genre']) || empty($_POST['genre'])) {
            return $this->view->showError('Falta agregar el genero del juego.');
        }
        if (!isset($_POST['platform']) || empty($_POST['platform'])) {
            return $this->view->showError('Falta agregar la plataforma del juego.');
        }

        $title = $_POST['title'];
        $genre = $_POST['genre'];
        $platform = $_POST['platform'];
    
        $id = $this->model->insertGame($title, $genre, $platform);
    
        // redirijo a la lista de juegos, ¿Funciona asi?
        //  No funciono
        //showGames();
        header('Location: ' . BASE_URL);
    }

    //Borrar un juego
    public function deleteGame($id) {
        // obtengo el juego por el id que pase
        $game = $this->model->getGame($id);

        //Compruebo que el juego exista
        if (!$game) {
            return $this->view->showError("No existe el juego con el id=$id");
        }

        // borro el juego
        $this->model->removeGame($id);

        header('Location: ' . BASE_URL);
    }

    //Busco el juego por el ID
    public function getGame($id) {    
        $query = $this->db->prepare('SELECT * FROM videojuegos WHERE id = ?');
        $query->execute([$id]);   
    
        $game = $query->fetch(PDO::FETCH_OBJ);
    
        return $game;
    }

    //Muestra los juegos de X Plataformas.
    public function showGamesPlatforms(){

    }

    //Muestra un error.
    public function showError($error){
        return $this->view->showError($error);
    }


    //Formulario de editar el juego
    public function showFormEdit($id){
        $game = $this->model->getGame($id);
        if (!$game) {
            return $this->view->showError("No existe el juego con el id=$id");
        }
        return $this->view->showFormEdit($game);
    }

    //Editar un juego FALTA
    public function editGame($id){
        $game = $this->model->getGame($id);
        if (!$game) {
            return $this->view->showError("No existe el juego con el id=$id");
        }

        //tengo que abrir un formulario y poder hacer que rellene los datos
        $this->model->changeGame($id);
    }
    


}




