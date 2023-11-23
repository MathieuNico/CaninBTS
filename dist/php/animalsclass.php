<?php

// require_once 'include/session.php';
require_once 'connectionclass.php';

 
class Animal {
   
    public $connexion;
    public $id;
    public $name;
    public $breed;
    public $age;
    public $weight;
    public $height;
    public $commentary;
    public $customer_id;
 
    function __construct($animal_bdd = NULL) {
        $this->connexion = new Connexion();
        if ($animal_bdd !== NULL) {
            $this->id = $animal_bdd['id'];
            $this->name = $animal_bdd['name'];
            $this->breed = $animal_bdd['breed'];
            $this->age = $animal_bdd['age'];
            $this->weight = $animal_bdd['weight'];
            $this->height = $animal_bdd['height'];
            $this->commentary = $animal_bdd['commentary'];
            $this->customer_id = $animal_bdd['customer_id'];
        }
    }

    public function insertAnimal($formData, $customerId) {
        // Récupérer les données du formulaire pour l'animal
        $namedog = $formData["nameDog"];
        $race = $formData["race"];
        $age = $formData["age"];
        $poids = $formData["poids"];
        $taille = $formData["taille"];
        $commentairedog = $formData["commentairedog"];

        // Préparez et exécutez la requête d'insertion pour l'animal avec la clé étrangère
        $insertAnimalQuery = "INSERT INTO animals (`name`, `breed`, `age`, `weight`, `height`, `comment`, `customer_id`) VALUES ('$namedog', '$race', '$age', '$poids', '$taille', '$commentairedog', '$customerId')";

        return $this->connexion->query($insertAnimalQuery) === TRUE;
    }
 
    public function getAll() {
        $animals_result = mysqli_query($this->connexion->conn, "SELECT * FROM animals;");
        if (!$animals_result) {
            die("Database query failed.");
        }
        $animals = [];
        while ($animal_bdd = mysqli_fetch_assoc($animals_result)) {
            $animals[] = new Animal($animal_bdd);
        }
        return $animals;
    }
}
 
?>