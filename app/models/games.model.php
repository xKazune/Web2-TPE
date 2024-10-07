<?php 

class GamesModel{
    private $db;
    private $dbusers;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=web2tpe;charset=utf8', 'root', '');
       //Falta crear la base de datos de los logins.
       //$this->dbusers = new PDO('mysql:host=localhost;dbname=log;charset=utf8', 'root', '');
    }

    public function getGames() {
        //Ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM videojuegos');
        $query->execute();
    
        //Obtengo los datos en un arreglo de objetos
        $games = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $games;
    }

    //Obtengo las plataformas
    public function getPlatforms(){
        $query = $this->db->prepare('SELECT * FROM plataformas');
        $query->execute();
        $platforms = $query->fetchAll(PDO::FETCH_OBJ);
        return $platforms;
    }

    //Agrego el juego
    public function insertGame($title, $genre, $platform) { 
        //Asi esta bien que agregue la plataforma?
        $query = $this->db->prepare('INSERT INTO videojuegos(titulo, genero, id_plataforma) VALUES (?, ?, ?)');
        $query->execute([$title, $genre, $platform]);
    
        // ¿ESTO SERVIRA PARA ALGO?
        $id = $this->db->lastInsertId();
        return $id;
    }


    //obtengo el juego por el id
    public function getGame($id) {    
        $query = $this->db->prepare('SELECT * FROM videojuegos WHERE id_videojuego = ?');
        $query->execute([$id]);   
        $games = $query->fetch(PDO::FETCH_OBJ);
        return $games;
    }

    //borro el juego
    public function removeGame($id) {
        $query = $this->db->prepare('DELETE FROM videojuegos WHERE id_videojuego = ?');
        $query->execute([$id]);
    }
 
 
}