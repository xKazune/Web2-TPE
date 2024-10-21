<?php
require_once "config.php";

class Model{
    protected $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=". MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
        $this->deploy();
    }

    private function _deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            $sql =<<<END
            // Copiamos las tablas del archivo exportado de phpmyadmin.
		    END;
            $this->db->query($sql);
        }
    }


}