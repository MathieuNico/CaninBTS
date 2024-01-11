<?php
session_start();
require_once 'connectionclass.php';
require_once 'animalsclass.php';


class Customer {
    public $connexion;
    public $id;
    public $firstname;
    public $lastname;
    public $telephone;
    public $postal_adress;
    public $commentary;

    function __construct($customer_bdd = NULL) {
        $this->connexion = new Connexion();
        if ($customer_bdd !== NULL) {
            $this->id = $customer_bdd['id'];
            $this->firstname = $customer_bdd['firstname'];
            $this->lastname = $customer_bdd['lastname'];
            $this->telephone = $customer_bdd['telephone'];
            $this->postal_adress = $customer_bdd['postal_adress'];
            $this->commentary = $customer_bdd['commentary'];
        }
    }

    public function getAppointments() {
        // Requête SQL pour récupérer les rendez-vous à venir avec toutes les informations rattachées
        $query = "
            SELECT 
                a.*,
                u.firstname AS user_firstname,
                a.is_paid,
                an.name AS animal_name,
                s.name AS service_name
            FROM 
                appointments AS a
            JOIN 
                users AS u ON a.user_id = u.id
            JOIN 
                animals AS an ON a.animal_id = an.id
            JOIN 
                services AS s ON a.service_id = s.id
            WHERE
                a.date_start >= CURDATE()
        ";
    
        $stmt = $this->connexion->getPDO()->prepare($query);
        $stmt->execute();
    
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $results;
    }

    public function insertCustomer($formData) {
        // Validate and sanitize user input
        $name = $this->sanitizeInput($formData['name']);
        $prenom = $this->sanitizeInput($formData['prenom']);
        $email = $this->sanitizeInput($formData['email']);
        $phone = $this->sanitizeInput($formData['phone']);
        $adress = $this->sanitizeInput($formData['adress']);
        $commentary = $this->sanitizeInput($formData['commentaire']);
    
        // Prepare the insertion query for the customer
        $insertClientQuery = "INSERT INTO customers (`firstname`, `lastname`, `telephone`, `mail`, `postal_adress`, `commentary`) 
                              VALUES (:firstname, :lastname, :telephone, :mail, :postal_adress, :commentary)";
        
        // Utilize prepared statements to avoid SQL injection
        $stmt = $this->connexion->getPDO()->prepare($insertClientQuery);
        $stmt->bindParam(':firstname', $name, PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':telephone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':mail', $email, PDO::PARAM_STR);
        $stmt->bindParam(':postal_adress', $adress, PDO::PARAM_STR);
        $stmt->bindParam(':commentary', $commentary, PDO::PARAM_STR);
    
        // Execute the prepared statement
        if ($stmt->execute()) {
            // Retrieve the ID of the newly inserted customer
            return $this->connexion->getPDO()->lastInsertId();
        } else {
            // Handle the error, log or throw an exception
            return false;
        }
    }

    public function searchCustomer($searchData) {
        // Validate and sanitize user input
        $searchTerm = '%' . $searchData['search'] . '%';
        
        // Utiliser LEFT JOIN pour récupérer les informations sur les clients et les animaux
        $searchQuery = "
            SELECT customers.*, animals.*
            FROM customers
            LEFT JOIN animals ON customers.id = animals.customer_id
            WHERE customers.mail LIKE :searchTerm OR customers.lastname LIKE :searchTerm
        ";
    
        $stmt = $this->connexion->getPDO()->prepare($searchQuery);
        $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
        $stmt->execute();
    
        $results = array(); // Initialisez un tableau pour stocker les résultats
    
        while ($rowData = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Ajouter les données au tableau des résultats
            $results[] = array('customer' => $rowData, 'animal' => $rowData);
        }
    
        return $results; // Retourne les résultats
    }

    public function calculateRevenue() {
        // Récupérez la connexion PDO depuis la classe Connexion
        $pdo = $this->connexion->getPDO();

        // Requête SQL
        $sql = "SELECT ROUND(SUM(s.price), 2) AS chiffre_affaire
        FROM appointments a
        JOIN services s ON a.service_id = s.id";

        // Exécution de la requête
        $stmt = $pdo->query($sql);

        // Récupération du résultat
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Retourne le chiffre d'affaires
        return $result['chiffre_affaire'];
    }

    public function updateCustomer($customerId, $newData) {
        // Utilisez des requêtes préparées pour éviter les attaques par injection SQL
        $updateQuery = "UPDATE customers SET lastname = ?, firstname = ?, mail = ? WHERE id = ?";
        $stmt = $this->connexion->getPDO()->prepare($updateQuery);
    
        // Vérifiez si la requête a réussi
        if ($stmt->execute([$newData['lastname'], $newData['firstname'], $newData['mail'], $customerId])) {
            return true; // La mise à jour a réussi
        } else {
            return false; // La mise à jour a échoué
        }
    }

    public function countTotalCustomers() {
        // Récupérez la connexion PDO depuis la classe Connexion
        $pdo = $this->connexion->getPDO();
    
        // Requête SQL pour compter le nombre total de lignes dans la table customer
        $sql = "SELECT COUNT(*) AS total_customers FROM customers";
    
        // Exécution de la requête
        $stmt = $pdo->query($sql);
    
        // Récupération du résultat
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Retourne le nombre total de clients
        return $result['total_customers'];
    }

    public function countFutureAppointments() {
        // Requête SQL pour récupérer les rendez-vous à venir avec toutes les informations rattachées
        $query = "
            SELECT 
                COUNT(*) as count
            FROM 
                appointments AS a
            JOIN 
                users AS u ON a.user_id = u.id
            JOIN 
                animals AS an ON a.animal_id = an.id
            JOIN 
                services AS s ON a.service_id = s.id
            WHERE
                a.date_start >= CURDATE()
        ";
    
        $stmt = $this->connexion->getPDO()->prepare($query);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['count'];
    }

    public function getAppointmentDetails($appointmentId) {
        // Si l'ID est présent, effectuer la requête pour obtenir les détails du rendez-vous
        if ($appointmentId) {
            // Vous devrez adapter cette requête en fonction de votre structure de base de données
            $sql = "SELECT * FROM appointments WHERE id = $appointmentId";
            $result = $this->connexion->getPDO()->query($sql);

            if ($result && $result->rowCount() > 0) {
                $appointmentDetails = $result->fetch(PDO::FETCH_ASSOC);
                return $appointmentDetails;
            } else {
                // Gérer le cas où le rendez-vous n'est pas trouvé
                echo "Rendez-vous non trouvé.";
                return false;
            }
        }
        return false;
    }

    public function getAll() {
        $customers_result = mysqli_query($this->connexion->conn, "SELECT * FROM customers;");
        if (!$customers_result) {
            // Handle the error, log or throw an exception
            die("Database query failed.");
        }
        $customers = [];
        while ($customer_bdd = mysqli_fetch_assoc($customers_result)) {
            $customers[] = new Customer($customer_bdd);
        }
        return $customers;
    }

    // Additional method for input sanitization
    private function sanitizeInput($input) {
        // Implement your input sanitization logic here
        // Example: $sanitizedInput = mysqli_real_escape_string($this->connexion->conn, $input);
        return $input;
    }

}
?>
