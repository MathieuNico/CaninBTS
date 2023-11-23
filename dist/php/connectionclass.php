<?php
$serveur = "localhost"; // Remplacez localhost par l'adresse de votre serveur
$user = "root"; // Remplacez par votre nom d'utilisateur
$pass = "root"; // Remplacez par votre mot de passe
$dbname = "toilettage"; // Remplacez par le nom de votre base de données

// Connexion à la base de données
$connexion = new mysqli($serveur, $user, $pass, $dbname);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

session_start();
if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== true) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: login.php");
    exit;
}
// Le nom d'utilisateur est stocké dans $_SESSION["username"]
$nomUtilisateur = $_SESSION["username"];
?>