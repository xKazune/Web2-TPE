<?php

class GamesView{
    public function showGames($games) {
        // la vista define una nueva variable con la cantida de tareas
        $count = count($games);

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion
        require 'templates/prueba.php';
    }
}