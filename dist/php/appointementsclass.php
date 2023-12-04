<?php

// require_once 'include/session.php';
require_once 'connectionclass.php';

// Récupère les données de la table 'animals'
require_once 'animalsclass.php';

// Créer une instance de la classe animals
   $animalInstance = new Animal();

// Récupérer tous les clients
   $animals = $animalInstance->getAll();


// Inclure la classe Customer
require_once 'customerclass.php';

// ... (autres inclusions et code) ...

// Créer une instance de la classe Customer
$customerInstance = new Customer();

// Récupérer tous les clients
$customers = $customerInstance->getAll();



// Récupère les données de la table 'services'
require_once 'servicesclass.php';

// Créer une instance de la classe Services
$servicesInstance = new Services();

// Récupérer tous les services
$services = $servicesInstance->getAll();



// Récupère les données de la table 'user'
require_once 'usersclass.php';

// Créer une instance de la classe Services
$userInstance = new User();

// Récupérer tous les services
$users = $userInstance->getAll();



class Appointment {
    public $id;
    public $date_start;
    public $date_end;
    public $is_paid;
    public $user_id;
    public $animal_id;
    public $service_id;
    public $connexion;

    public function __construct($appointment_bdd = NULL) {
        $this->connexion = new Connexion();
        if ($appointment_bdd !== NULL) {
            $this->id = $appointment_bdd['id'];
            $this->date_start = $appointment_bdd['date_start'];
            $this->date_end = $appointment_bdd['date_end'];
            $this->is_paid = $appointment_bdd['is_paid'];
            $this->user_id = $appointment_bdd['user_id'];
            $this->animal_id = $appointment_bdd['animal_id'];
            $this->service_id = $appointment_bdd['service_id'];
        }
    }

    public function getAll() {
        $appointments_result = mysqli_query($this->connexion->conn, "SELECT * FROM appointments;");
        if (!$appointments_result) {
            die("Database query failed.");
        }
        $appointments = [];
        while ($appointment_bdd = mysqli_fetch_assoc($appointments_result)) {
            $appointments[] = new Appointment($appointment_bdd);
        }
        return $appointments;
    }
    
}
?>