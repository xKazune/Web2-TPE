<?php 

class GamesModel{
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=web2tpe;charset=utf8', 'root', '');
    }

    //Obtengo los juegos
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
        $query = $this->db->prepare('INSERT INTO videojuegos(titulo, genero, id_plataforma) VALUES (?, ?, ?)');
        $query->execute([$title, $genre, $platform]);
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

    //Edito el juego
    public function changeGame($id,$title,$genre){
        $query = $this->db->prepare('UPDATE videojuegos SET titulo = ?, genero = ? WHERE id_videojuego = ?');
        $query->execute([$title,$genre,$id]);
    }

    //Agrego la plataforma
    public function insertPlataform($plataforma, $compania,$tipo) { 
        $query = $this->db->prepare('INSERT INTO plataformas(nombrePlataforma, fabricante, tipo) VALUES (?, ?, ?)');
        $query->execute([$plataforma, $compania,$tipo]);
    }

    public function getPlataform($id) {    
        $query = $this->db->prepare('SELECT * FROM plataformas WHERE id_plataforma = ?');
        $query->execute([$id]);   
        $plataforms = $query->fetch(PDO::FETCH_OBJ);
        return $plataforms;
    }

    public function removePlataform($id) {
        $query = $this->db->prepare('DELETE FROM plataformas WHERE id_plataforma = ?');
        $query->execute([$id]);
    }

    public function changePlatform($id, $plataforma, $compania, $tipo){
        $query = $this->db->prepare('UPDATE plataformas SET nombrePlataforma = ?, fabricante = ?, tipo = ? WHERE id_plataforma = ?');
        $query->execute([$plataforma,$compania,$tipo,$id]);
    }
 
}