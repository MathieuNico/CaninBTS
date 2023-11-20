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
$serveur = "localhost";
$user = "root";
$pass = "root";
$dbname = "toilettage";

$connexion = new mysqli($serveur, $user, $pass, $dbname);

if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $searchQuery = "SELECT * FROM customers WHERE mail LIKE '%$searchTerm%' OR lastname LIKE '%$searchTerm'";
    $result = $connexion->query($searchQuery);

    if ($result->num_rows > 0) {
        $clientData = $result->fetch_assoc();
        $customerId = $clientData['id'];
        $animalsQuery = "SELECT * FROM animals WHERE customer_id = $customerId";
        $animalsResult = $connexion->query($animalsQuery);

        if ($animalsResult->num_rows > 0) {
            $animalsData = $animalsResult->fetch_assoc();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $customerIdPost = $_POST["customer_id"];
    $name = $_POST["name"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $adress = $_POST["adress"];
    $commentary = $_POST["commentary"];
    //... (autres champs à mettre à jour pour le client)

    // Requête pour mettre à jour les informations du client
    $updateClientQuery = "UPDATE customers SET `name` = '$name', `prenom` = '$prenom', `email` = '$email', `phone` = '$phone', `adress` = '$adress', `commentary` = '$commentary' WHERE id = $customerIdPost";

    if ($connexion->query($updateClientQuery) === TRUE) {
        echo "Mise à jour des informations du client effectuée avec succès.";
    } else {
        echo "Erreur lors de la mise à jour des informations du client : " . $connexion->error;
    }

    $namedog = $_POST["nameDog"];
    $race = $_POST["race"];
    $age = $_POST["age"];
    $poids = $_POST["poids"];
    $taille = $_POST["taille"];
    $commentairedog = $_POST["commentairedog"];
    //... (autres champs à mettre à jour pour l'animal)

    // Requête pour mettre à jour les informations de l'animal
    $updateAnimalQuery = "UPDATE animals SET `name` = '$namedog', `breed` = '$race', `age` = '$age', `weight` = '$poids', `height` = '$taille', `comment` = '$commentairedog' WHERE customer_id = $customerIdPost";

    if ($connexion->query($updateAnimalQuery) === TRUE) {
        echo "Mise à jour des informations des animaux effectuée avec succès.";
    } else {
        echo "Erreur lors de la mise à jour des informations des animaux : " . $connexion->error;
    }

    // $connexion->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CANIN BTS | General Form Elements</title>

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
            <a href="../charts/chartjs.php" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Graphique
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../forms/inscription.php" class="nav-link ">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Inscription
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../forms/modification.php" class="nav-link active">
              <i class="nav-icon fas fa-solid fa-pen"></i>
              <p>
                Modification
              </p>
            </a>
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
                <h3 class="card-title">Modification des informations client</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="get" class="customer-form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Rechercher un client</label>
                    <input type="texte" class="form-control" name="search" id="name" placeholder="Entrez votre recherche">
                  </div>
                  <button id="blockBtn3" style="display: block" class="btn btn-primary">Rechercher</button>
              <form>
              <form method="post" class="customer-form">
                  <div class="form-group">
                   <input type="hidden" name="customer_id" value="<?php echo $clientData['id']; ?>">
                    <label for="prenom">Prénom</label>
                    <input type="prenom" class="form-control" name="prenom" id="prenom" value="<?php echo $clientData['firstname']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $clientData['mail']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="phone">Téléphone</label>
                    <input type="phone" class="form-control" name="phone" id="phone" value="<?php echo $clientData['telephone']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="adress">Adresse</label>
                    <input type="adress" class="form-control" name="adress" id="adress" value="<?php echo $clientData['postal_adress']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="commentaire">Commentaire</label>
                    <input type="commentaire" class="form-control" name="commentaire" id="commentaire" value="<?php echo $clientData['commentary']; ?>">
                  </div>
                <div id="d1" style="display: block" >
                  <div class="form-group">
                    <label for="nameDog">Nom</label>
                    <input type="nameDog" class="form-control" name="nameDog" id="nameDog" value="<?php echo $animalsData['name']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="race">Race</label>
                    <input type="race" class="form-control" name="race" id="race" value="<?php echo $animalsData['breed']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="age">Age</label>
                    <input type="age" class="form-control" name="age" id="age" value="<?php echo $animalsData['age']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="poids">Poids</label>
                    <input type="poids" class="form-control" name="poids" id="poids" value="<?php echo $animalsData['weight']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="taille">Taille</label>
                    <input type="taille" class="form-control" name="taille" id="taille" value="<?php echo $animalsData['height']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="commentairedog">Commentaires</label>
                    <input type="commentairedog" class="form-control" name="commentairedog" id="commentairedog" value="<?php echo $animalsData['comment']; ?>">
                  </div>
                </div>
                  <div class="card-footer">
                    <button type="submit" name="update" style="display: block" class="btn btn-success">Valider les modifications</button>
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
