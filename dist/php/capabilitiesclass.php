<?php

require_once 'connectionclass.php';

class Capabilities {
    public $user_id;
    public $service_id;

    function __construct($capabilities_bdd = NULL){
        $this->connexion = new Connexion();
        if ($capabilities_bdd = NULL){
            $this->user_id = $capabilities_bdd['user_id'];
            $this->service_id = $capabilities_bdd['service_id'];
        }
    }

    public function getAll(){
        $capabilities_result = mysqli_query($this->connexion->conn, "SELECT users.firstname AS nom_utilisateur, services.name AS nom_service FROM capabilities JOIN users ON capabilities.user_id = users.id JOIN services ON capabilities.service_id = services.id;");
    }
}