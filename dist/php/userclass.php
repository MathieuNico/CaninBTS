<?php
session_start();
require_once 'connectionclass.php';
 
class User {
 
    public $id;
    public $idisadmin;
    public $firstname;
    public $lastname;
    public $age;
    public $password;
    public $email;
    public $address;
    public $zip;
    public $connexion;
 
    function __construct($user_bdd = NULL) {
        $this->connexion = new Connexion();
        if($user_bdd !== NULL) {
            $this->id = $user_bdd["id"];
            $this->idisadmin = $user_bdd["is_admin"];
            $this->firstname = $user_bdd["firstname"];
            $this->lastname = $user_bdd["lastname"];
            $this->age = $user_bdd["age"];
            $this->password = $user_bdd["password"];
            $this->email = $user_bdd["email"];
            $this->address = $user_bdd["address"];
            $this->zip = $user_bdd["zip"];
 
        }
    }
 
    public function authenticateUser($username, $password) {
        $serveur = "localhost";
        $dbname = "toilettage";
        $user = "root";
        $pass = "root";
 
        try {
            $connexion = new PDO("mysql:host=$serveur;dbname=$dbname", $user, $pass);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
            $requete = $connexion->prepare("SELECT * FROM users WHERE firstname = :firstname AND mdp = :mdp");
            $requete->bindParam(':firstname', $username);
            $requete->bindParam(':mdp', $password);
            $requete->execute();
 
            if ($requete->rowCount() == 1) {
                $_SESSION["isLoggedIn"] = true;
                $_SESSION["username"] = $username;
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }
 
 
    public function getAll() {
        $users_result = $this->connexion->conn->query("SELECT * FROM users;"); // résultat de la requête qui contient tous les users
        $users = [];
        while($user_bdd = mysqli_fetch_assoc($users_result)) {
            $users[] = new User($user_bdd);
        }
        return $users;
    }
 
    public function getByID($id) {
        $user_bdd = $this->connexion->conn->query("SELECT firstname FROM users WHERE id = $id ;"); // résultat de la requête qui contient tous les users
        return new User($user_bdd);
    }
}
   
?>