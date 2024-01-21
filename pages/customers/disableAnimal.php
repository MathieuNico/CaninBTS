<?php
require_once '../../dist/php/connectionclass.php';
$connexion = new Connexion();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["animal_id"])) {
    $animalId = $_POST["animal_id"];

    // Utiliser une requête préparée pour éviter les injections SQL
    $stmt = $connexion->conn->prepare("UPDATE animals SET is_actif = 0 WHERE id = ?");
    $stmt->bind_param("i", $animalId); // "i" indique que la variable est un entier

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
}
?>
