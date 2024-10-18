<?php

class GamesView{
    private $user = null;

    public function __construct($user) {
        $this->user = $user;
    }


    public function showHome(){
        require 'templates/index.phtml';
    }

    public function showForm($platforms){
        require 'templates/form_game.phtml';
    }

    public function showFormEdit($game){
        require 'templates/form_game_edit.phtml';
    }
    
    public function showGames($games) {
        $count = count($games);
        require 'templates/lista_juegos.phtml';
    }

    public function showPlatforms($platforms) {
        $count = count($platforms);
        require 'templates/lista_plataformas.phtml';
    }

    public function showError($error){
        require 'templates/error.phtml';
    }

    public function showFormPlataforma(){
        require 'templates/addplataform.phtml';
    }

}