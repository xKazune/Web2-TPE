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
        $platforms = $this->model->getPlatforms();
        return $this->view->showForm($platforms);
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
    
        $this->model->insertGame($title, $genre, $platform);
    
        // redirijo a la lista de juegos.
        header('Location: ' . BASE_URL . 'listarJuegos');
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

        header('Location: ' . BASE_URL . 'listarJuegos');
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

    //Editar un juego
    public function editGame(){
        //paso el id por el formulario
        $id = $_POST['game_id'];
        //verefico si existe el juego
        $game = $this->model->getGame($id);
        if (!$game) {
            return $this->view->showError("No existe el juego con el id=$id");
        }
        //hago las verificaciones restantes
        if (!isset($_POST['title']) || empty($_POST['title'])) {
            return $this->view->showError('Falta agregar el titulo del juego.');
        }
        if (!isset($_POST['genre']) || empty($_POST['genre'])) {
            return $this->view->showError('Falta agregar el genero del juego.');
        }
        $title = $_POST['title'];
        $genre = $_POST['genre'];
        //edito el juego
        $this->model->changeGame($id, $title, $genre);
        header('Location: ' . BASE_URL . 'listarJuegos');
    }

    //Muestro el formulario
    public function showFormPlataforma(){
        return $this->view->showFormPlataforma();
    }

    //Agrega una plataforma
    public function addPlataform() {
      
        if (!isset($_POST['plataforma']) || empty($_POST['plataforma'])) {
            return $this->view->showError('Falta agregar la plataforma');
        }
        if (!isset($_POST['compania']) || empty($_POST['compania'])) {
            return $this->view->showError('Falta agregar la empresa');
        }
        if (!isset($_POST['tipo']) || empty($_POST['tipo'])) {
            return $this->view->showError('Falta agregar el tipo');
        }
        

        $plataforma = $_POST['plataforma'];
        $compania = $_POST['compania'];
        $tipo = $_POST['tipo'];
        
    
        $id = $this->model->insertPlataform($plataforma , $compania,$tipo);
    
        // redirijo a la lista de juegos, ¿Funciona asi?
        //  No funciono
        //showGames();
        header('Location: ' . BASE_URL . 'listarPlataformas');
    }

    //Eliminar plataforma
    public function deletePlataform($id) {
        // obtengo la plataforma por el id que pase
        $plataform = $this->model->getPlataform($id);

        //Compruebo que la plataforma exista
        if (!$plataform) {
            return $this->view->showError("No existe el juego con el id=$id");
        }

        // borro la plataforma
        $this->model->removeGame($id);

        header('Location: ' . BASE_URL . 'listarPlataformas');
    }
}




