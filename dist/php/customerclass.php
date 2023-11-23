<?php
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

    public function insertCustomer($formData) {
        // Validate and sanitize user input
        $name = $this->sanitizeInput($formData['name']);
        $prenom = $this->sanitizeInput($formData['prenom']);
        $email = $this->sanitizeInput($formData['email']);
        $phone = $this->sanitizeInput($formData['phone']);
        $adress = $this->sanitizeInput($formData['adress']);
        $commentary = $this->sanitizeInput($formData['commentaire']);

        // Prepare and execute the insertion query for the customer
        $insertClientQuery = "INSERT INTO customers (`firstname`, `lastname`, `telephone`, `mail`, `postal_adress`, `commentary`) VALUES ('$name', '$prenom', '$phone', '$email', '$adress', '$commentary')";

        // Use the connection property of Connexion
        if ($this->connexion->conn->query($insertClientQuery) === TRUE) {
            // Retrieve the ID of the newly inserted customer
            return $this->connexion->conn->insert_id;
        } else {
            // Handle the error, log or throw an exception
            return false;
        }
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
