<?php

class GamesView{

    public function showHome(){
        require 'templates/index.phtml';
    }

    public function showGames($games) {
        $count = count($games);
        require 'templates/lista_juegos.phtml';
    }

    //Esto esta mal creo, porque ya tengo un mostrar
    public function showPlatforms($platforms) {
        $count = count($platforms);
        require 'templates/lista_plataformas.phtml';
    }


    public function showError($error){
        require 'templates/error.phtml';
    }

}