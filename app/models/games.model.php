<?php 

class GamesModel{
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=web2tpe;charset=utf8', 'root', '');
    }

    public function getGames() {
        // 2. Ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM videojuegos');
        $query->execute();
    
        // 3. Obtengo los datos en un arreglo de objetos
        $games = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $games;
    }
}