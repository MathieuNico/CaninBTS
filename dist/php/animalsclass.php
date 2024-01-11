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
    public $comment;
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
            $this->comment = $animal_bdd['comment'];
            $this->customer_id = $animal_bdd['customer_id'];
        }
    }

    public function countTotalAnimal() {
        // Récupérez la connexion PDO depuis la classe Connexion
        $pdo = $this->connexion->getPDO();
    
        // Requête SQL pour compter le nombre total de lignes dans la table customer
        $sql = "SELECT COUNT(*) AS total_animals FROM animals";
    
        // Exécution de la requête
        $stmt = $pdo->query($sql);
    
        // Récupération du résultat
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Retourne le nombre total de clients
        return $result['total_animals'];
    }

    public function searchAnimal($searchData) {
        // Validate and sanitize user input
        $searchTerm = '%' . $searchData['search'] . '%';
    
        // Utilisez des requêtes préparées pour éviter les attaques par injection SQL
        $searchQuery = "SELECT c.*, a.*
                        FROM customers c
                        LEFT JOIN animals a ON c.id = a.customer_id
                        WHERE a.name LIKE :searchTerm";
    
        $stmt = $this->connexion->getPDO()->prepare($searchQuery);
        $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
        $stmt->execute();
    
        $results = array(); // Initialisez un tableau pour stocker les résultats
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = array('customer' => $row);
        }
    
        return $results; // Retourne les résultats
    }

    public function updateAnimal($customerId, $newData) {
        // Utilisez des requêtes préparées pour éviter les attaques par injection SQL
        $updateQuery = "UPDATE animals SET `name` = ?, breed = ? WHERE customer_id = ?";
        $stmt = $this->connexion->getPDO()->prepare($updateQuery);
    
        // Vérifiez si la requête a réussi
        if ($stmt->execute([$newData['name'], $newData['breed'], $customerId])) {
            return true; // La mise à jour a réussi
        } else {
            return false; // La mise à jour a échoué
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