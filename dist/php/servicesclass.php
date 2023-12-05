<?php 

//recuperation de la connextion
require_once 'connectionclass.php';

class Services {
    public $connection;
    public $id;
    public $name;
    public $price;

    public function __construct($services_bdd = NULL) {
       $this->connexion = new connexion();
       if ($services_bdd !== NULL) {
        $this->id = $services_bdd['id'];
        $this->name = $services_bdd['name'];
        $this->price = $services_bdd['price'];
       }
    }

    public function getAll() {
        $services_result = mysqli_query($this->connexion->conn,"SELECT * FROM services;");
        if (!$services_result) {
            die("Database query failed.");
        }
        $services = [];
        while ($service_bdd = mysqli_fetch_assoc($services_result)) {
            $services[] = new Services($service_bdd);
        }
        return $services;
    }

}

?>