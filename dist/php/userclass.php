<?php
require_once 'connectionclass.php';

// PAS MERDE
class User {

    public $id;
    public $idisadmin
    public $firstname;
    public $lastname;
    public $age;
    public $password;
    public $email;
    public $address;
    public $zip;

    function __construct($user_bdd = NULL) {
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

    public function getAll() {
        $users_bdd = ["SELECT * FROM users;"]; // résultat de la requête qui contient tous les users
        $users = [];
        foreach($users_bdd as $user_bdd) {
            $users[] = new User($user_bdd);
        }
        return $users;
    }
}

?>