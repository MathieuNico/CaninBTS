<?php
session_start(); // Démarrez la session au début de votre script

// Vérifiez si l'utilisateur a soumis le formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $serveur = "localhost";
    $dbname = "toilettage";
    $user = "root";
    $pass = "root";

    // Le formulaire a été soumis
<<<<<<< HEAD
    $firstname = $_POST["firstname"];
=======
<<<<<<< HEAD
    $nom = $_POST["firstname"];
=======
    $nom = $_POST["nom"];
>>>>>>> 231708a779bd93a58607c1264ea2f6c8f4df9ee9
>>>>>>> 72384c87c8359702bd7b5de78fee9602673bb106
    $mdp = $_POST["mdp"];

    try {
        // Connexion à la base de données
        $connexion = new PDO("mysql:host=$serveur;dbname=$dbname", $user, $pass);

        // Définir le mode d'erreur PDO à exception
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL pour vérifier les informations de connexion
<<<<<<< HEAD
        $requete = $connexion->prepare("SELECT * FROM users WHERE firstname = :firstname AND mdp = :mdp");
        $requete->bindParam(':firstname', $firstname);
=======
<<<<<<< HEAD
        $requete = $connexion->prepare("SELECT * FROM users WHERE firstname = :firstname AND mdp = :mdp");
        $requete->bindParam(':firstname', $nom);
=======
        $requete = $connexion->prepare("SELECT * FROM toilettage WHERE nom = :nom AND mdp = :mdp");
        $requete->bindParam(':nom', $nom);
>>>>>>> 231708a779bd93a58607c1264ea2f6c8f4df9ee9
>>>>>>> 72384c87c8359702bd7b5de78fee9602673bb106
        $requete->bindParam(':mdp', $mdp);
        $requete->execute();

        // Vérifiez si des données correspondantes existent dans la base de données
        if ($requete->rowCount() == 1) {
            $_SESSION["isLoggedIn"] = true;
            $_SESSION["username"] = $firstname; // Vous pouvez stocker des informations sur l'utilisateur dans la session
            header("Location:index.php"); // Redirigez l'utilisateur vers la page protégée
            exit();
        } else {
            header("Location: login.php?error=1");
            exit();
        }
    } catch (PDOException $e) {
        // En cas d'erreur de connexion à la base de données, affichez un message d'erreur
        echo "Erreur : " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <head>
        <title>Login form</title>
        <link rel="stylesheet" type="text/css" href="docs/assets/css/stylelogin.css">
        <body>
            <div class="loginbox">
            <img src="docs\assets\img\doglogo.png">
                <h1>Se connecter</h1>
                <form action="login.php" method="post">
                <p>Nom</p>
<<<<<<< HEAD
                    <input type="text" name="firstname" id="firstname" placeholder="Tapez votre nom" required>
=======
<<<<<<< HEAD
                    <input type="text" name="firstname" id="firstname" placeholder="Tapez votre nom" required>
=======
                    <input type="text" name="nom" id="nom" placeholder="Tapez votre nom" required>
>>>>>>> 231708a779bd93a58607c1264ea2f6c8f4df9ee9
>>>>>>> 72384c87c8359702bd7b5de78fee9602673bb106
                <p>Mot de passe</p>
                    <input type="password" name="mdp" id="mdp" placeholder="Tapez votre mot de passe" required>
                    <input type="submit" name="" value="Connexion"> </br>
            <?php
            // Afficher le message d'erreur s'il est défini
            if (isset($_GET['error']) && $_GET['error'] == '1') {
                echo '<p class="error-message">Nom d\'utilisateur ou mot de passe incorrect.</p>';
            }
            ?>
                <div class="mdpforget">
                    <a href="#">Mot de passe oublié ?</a><br>
                    <a href="#">Pas de compte ?</a><br>
                </div>
                </form>
            </div>
        </body>
    </head>
    
</body>
</html>