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

    public function getBreedData() {
        $query = "SELECT breed, COUNT(*) as count FROM animals GROUP BY breed";
        $result = mysqli_query($this->connexion->conn, $query);
        if (!$result) {
            die("Database query failed.");
        }
 
        $breedData = [];
        while ($data = mysqli_fetch_assoc($result)) {
            $breedData[] = [
                'breed' => $data['breed'],
                'count' => $data['count'],
            ];
        }
        return $breedData;
    }

    public function getagedata(){
        $age = "SELECT CASE WHEN age > 10 THEN 'Chien agé' WHEN age >= 5 AND age <= 10 THEN 'Entre 5 et 10 ans' WHEN age < 5 THEN '< 5 ans' END AS category_age, COUNT(*) AS number_animal_age FROM animals GROUP BY category_age";
        $resultage = mysqli_query($this->connexion->conn, $age);
        if (!$resultage) {
            die("Database query failed.");
        }
        $ageData = [];
        while ($datage = mysqli_fetch_assoc($resultage)){
            $ageData[] = [
                'age' => $datage['number_animal_age'],
                'resu' => $datage['category_age'],
            ];
        }
        return $ageData;
        // Affecte Donnée de la requête pour Diagramme Race à la variable $donne
    }

    public function getweight(){
        $weight = "SELECT CASE WHEN weight > 30 AND weight < 50 THEN 'Poids normal' WHEN weight >= 50 THEN 'Poids élevé' WHEN weight <= 30 THEN 'Poids léger' END AS category_weight, COUNT(*) AS number_animal FROM animals GROUP BY category_weight";
        $resuweight = mysqli_query($this->connexion->conn, $weight);
        if(!$resuweight){
            die("Database query failed.");
        }
        $weightdata = [];
        while ($datweight = mysqli_fetch_assoc($resuweight)){
            $weightdata[] = [
                'weight' => $datweight['number_animal'],
                'category' => $datweight['category_weight'],
            ];
        }
        return $weightdata;

    }

    
}
?>