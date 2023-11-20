<?php
// Vérifier la connexion
if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}
// Vérifiez si l'utilisateur est connecté en vérifiant la session
session_start();
if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== true) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: ../../login.php");
    exit;
}
// Le nom d'utilisateur est stocké dans $_SESSION["username"]
$nomUtilisateur = $_SESSION["username"];
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire pour le client
    $name = $_POST["name"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $adress = $_POST["adress"];
    $commentary = $_POST["commentaire"];

    // Connexion à la base de données en utilisant MySQLi
    $serveur = "localhost"; // Remplacez localhost par l'adresse de votre serveur
    $user = "root"; // Remplacez par votre nom d'utilisateur
    $pass = "root"; // Remplacez par votre mot de passe
    $dbname = "toilettage"; // Remplacez par le nom de votre base de données

    $connexion = new mysqli($serveur, $user, $pass, $dbname);

    // Vérifier la connexion
    if ($connexion->connect_error) {
        die("La connexion a échoué : " . $connexion->connect_error);
    }
    var_dump($_POST);

    // Préparez et exécutez la requête d'insertion pour le client
    $insertClientQuery = "INSERT INTO customers (firstname, lastname, telephone, mail, postal_adress, commentary) VALUES ('$name', '$prenom', '$phone', '$email', '$adress', '$commentary')";
    if ($connexion->query($insertClientQuery) === TRUE) {
        // Récupérer l'ID du client nouvellement inséré
        $clientId = $connexion->insert_id;

        // Vérifier si le formulaire pour les animaux est rempli
        if (!empty($_POST["nameDog"]) && !empty($_POST["race"])) {
            // Récupérer les données du formulaire pour l'animal
            $namedog = $_POST["nameDog"];
            $race = $_POST["race"];
            $age = $_POST["age"];
            $poids = $_POST["poids"];
            $taille = $_POST["taille"];
            $commentairedog = $_POST["commentairedog"];

            // Préparez et exécutez la requête d'insertion pour l'animal avec la clé étrangère
            $insertAnimalQuery = "INSERT INTO animals (`name`, `breed`, `age`, `weight`, `height`, `comment`, `customer_id`) VALUES ('$namedog', '$race', '$age', '$poids', '$taille', '$commentairedog', '$clientId')";
            if ($connexion->query($insertAnimalQuery) === TRUE) {
                echo "Données insérées dans la base de données avec succès.";
            } else {
                echo "Erreur lors de l'insertion des données de l'animal : " . $connexion->error;
            }
        } else {
            echo "Aucune information sur l'animal fournie. Seuls les détails du client ont été enregistrés.";
        }
    } else {
        echo "Erreur lors de l'insertion des données du client : " . $connexion->error;
    }

    // Fermez la connexion à la base de données
    $connexion->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | General Form Elements</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="../../dist/css/adminlte.min.css"> -->
  <link rel="stylesheet" href="../../dist/css/adminlte.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index.php" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">CANINBTS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../index.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tableau de bord</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="../charts/chartjs.html" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Graphique
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../forms/inscription.html" class="nav-link active">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Inscription
              </p>
            </a>
          </li>
          </li>
          <li class="nav-item">
            <a href="../tables/data.html" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>Listing</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../calendar.html" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Calendrier
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../gallery.html" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Gallery
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../examples/projects.html" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Admin</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../documentation.html" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Inscription</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Inscription</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row-inscription">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Nouveau Client</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" class="customer-form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="name" class="form-control" name="name" id="name" placeholder="Entrez votre nom">
                  </div>
                  <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="prenom" class="form-control" name="prenom" id="prenom" placeholder="Entrez votre Prénom">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Entrez votre email">
                  </div>
                  <div class="form-group">
                    <label for="phone">Téléphone</label>
                    <input type="phone" class="form-control" name="phone" id="phone" placeholder="Entrez votre Numéro de téléphone">
                  </div>
                  <div class="form-group">
                    <label for="adress">Adresse</label>
                    <input type="adress" class="form-control" name="adress" id="adress" placeholder="Entrez votre adresse">
                  </div>
                  <div class="form-group">
                    <label for="commentaire">Commentaire</label>
                    <input type="commentaire" class="form-control" name="commentaire" id="commentaire" placeholder="Commentaires">
                  </div>
                <div id="d1" style="display: none" >
                  <div class="form-group">
                    <label for="nameDog">Nom</label>
                    <input type="nameDog" class="form-control" name="nameDog" id="nameDog" placeholder="Entrez le nom du chien">
                  </div>
                  <div class="form-group">
                    <label for="race">Race</label>
                    <input type="race" class="form-control" name="race" id="race" placeholder="Entrez la race">
                  </div>
                  <div class="form-group">
                    <label for="age">Age</label>
                    <input type="age" class="form-control" name="age" id="age" placeholder="Entrez l'âge du chien">
                  </div>
                  <div class="form-group">
                    <label for="poids">Poids</label>
                    <input type="poids" class="form-control" name="poids" id="poids" placeholder="Entrez le poids">
                  </div>
                  <div class="form-group">
                    <label for="taille">Taille</label>
                    <input type="taille" class="form-control" name="taille" id="taille" placeholder="Entrez la taille">
                  </div>
                  <div class="form-group">
                    <label for="commentairedog">Commentaires</label>
                    <input type="commentairedog" class="form-control" name="commentairedog" id="commentairedog" placeholder="Entrez un commentaire">
                  </div>
                </div>
                  <div class="card-footer">
                    <button id="blockBtn" style="display: block" class="btn btn-primary">Rattacher un nouveau chien</button>
                  </div>
                  <div class="card-footer">
                    <button type="submit" id="blockBtn2" style="display: block" class="btn btn-success">Valider l'inscription</button>
                  </div>
                </div>
                <!-- /.card-body -->
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- Main content -->
    <section class="content">
      <!-- Div à cacher -->
      <div id="d1" style="display: none" >
      <div class="container-fluid">
        <div class="row-inscription">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Votre Chien</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" class="animal-form">
                <div class="card-body">
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" onclick="submitBothForms()" class="btn btn-secondary">Envoyer</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
        <!-- /.Div à cacher -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Bouton hide JS -->
<script src="../../dist/js/pages/bouton.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
