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
    
    public function getName(){
        $name_service = mysqli_query($this->connexion->conn,"SELECT services.name AS nom_service, COUNT(*) AS number_service FROM services JOIN appointments ON appointments.service_id = services.id GROUP BY services.name;");
        if (!$name_service) {
            die("Database query failed.");
        }
        $serv = [];
        while ($name_service_bdd = mysqli_fetch_assoc($name_service)) {
            $serv[] = [
                'name_service' => $name_service_bdd['nom_service'],
                'number_service' => $name_service_bdd['number_service'],
            ];
        }
        return $serv;
    }

}

?>