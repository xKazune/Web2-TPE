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
        // 2. Ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM videojuegos');
        $query->execute();
    
        // 3. Obtengo los datos en un arreglo de objetos
        $games = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $games;
    }

    public function getGame($id) {    
        $query = $this->db->prepare('SELECT * FROM videojuegos WHERE id = ?');
        $query->execute([$id]);   
    
        $games = $query->fetch(PDO::FETCH_OBJ);
    
        return $games;
    }

    public function insertTask($title, $description, $category, $finished = false) { 
        $query = $this->db->prepare('INSERT INTO videojuegos(titulo, descripcion, categoria, finalizada) VALUES (?, ?, ?, ?)');
        $query->execute([$title, $description, $category, $finished]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }

    public function eraseGame($id) {
        $query = $this->db->prepare('DELETE FROM videojuegos WHERE id = ?');
        $query->execute([$id]);
    }
 
 
}