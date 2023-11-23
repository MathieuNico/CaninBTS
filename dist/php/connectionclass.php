<?php
class Connexion {
 
    public $host = "localhost";
    public $username = "root";
    public $password = "root";
    public $database = "toilettage";
    public $conn;
 
    function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    }

    // Méthode pour exécuter les requêtes SQL
    public function query($sql) {
        return $this->conn->query($sql);
    }
}
?>