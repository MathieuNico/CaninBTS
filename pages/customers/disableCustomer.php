<?php
require_once '../../dist/php/connectionclass.php';
$connexion = new Connexion();
// Assurez-vous que l'utilisateur est authentifié ou a les autorisations nécessaires ici

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $customerId = $_POST["customer_id"];

    // Mettez à jour le champ is_actif dans la base de données pour désactiver l'utilisateur
    $query = "UPDATE customers SET is_actif = 0 WHERE id = $customerId";
    $result = mysqli_query($connexion->conn, $query);

    if ($result) {
        echo "success"; // Renvoyer une réponse réussie à la requête AJAX
    } else {
        echo "error"; // Renvoyer une réponse d'erreur à la requête AJAX en cas d'échec
    }
}
?>