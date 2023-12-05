<?php

// Récupère les données de la table 'animals'
require_once '../../dist/php/animalsclass.php';

// Créer une instance de la classe animals
   $animalInstance = new Animal();

// Récupérer tous les clients
   $animals = $animalInstance->getAll();


// Inclure la classe Customer
require_once '../../dist/php/customerclass.php';

// ... (autres inclusions et code) ...

// Créer une instance de la classe Customer
$customerInstance = new Customer();

// Récupérer tous les clients
$customers = $customerInstance->getAll();



// Récupère les données de la table 'services'
require_once '../../dist/php/servicesclass.php';

// Créer une instance de la classe Services
$servicesInstance = new Services();

// Récupérer tous les services
$services = $servicesInstance->getAll();

// Afficher les services permet de voir les données transmise
//foreach ($services as $service) {
//    echo "ID : " . $service->id . "<br>";
//    echo "Nom : " . $service->name . "<br>";
//    echo "Prix : " . $service->price . "<br>";
//    echo "-----------------------<br>";
//}

// Vérifier si la classe a été incluse
//if (class_exists('Services')) {
//  echo "La classe Services a été incluse avec succès.";
//} else {
//  echo "Erreur lors de l'inclusion de la classe Services.";
//}

// Récupère les données de la table 'user'
require_once '../../dist/php/usersclass.php';

// Créer une instance de la classe Services
$userInstance = new User();

// Récupérer tous les services
$users = $userInstance->getAll();

// Récupère les données de la table 'user'
require_once '../../dist/php/appointementsclass.php';

// Créer une instance de la classe Services
$appointementInstance = new Appointment();

// Récupérer tous les services
$appointements = $appointementInstance->getAll();

// Afficher les services permet de voir les données transmise
foreach ($appointements as $appointement) {
    echo "numeros rdv : " . $appointement->id . "<br>";
    echo "debut : " . $appointement->date_start . "<br>";
    echo "fin : " . $appointement->date_end . "<br>";
    echo "payée : " . $appointement->is_paid . "<br>";
    echo "employer : " . $appointement->user_id . "<br>";
    echo "animal : " . $appointement->animal_id . "<br>";
    echo "Service : " . $appointement->service_id . "<br>";
    
}
// Vérifier si la classe a été incluse
if (class_exists('Services')) {
  echo "La classe Services a été incluse avec succès.";
} else {
  echo "Erreur lors de l'inclusion de la classe Services.";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CANIN BTS | DataTables</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
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
      
      <!-- Messages Dropdown Menu -->
      
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
            <a href="../forms/inscription.php" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Inscription
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../forms/modification.php" class="nav-link">
              <i class="nav-icon fas fa-solid fa-pen"></i>
              <p>
                Modification
              </p>
            </a>
          </li>
          </li>
          <li class="nav-item">
            <a href="../tables/data.html" class="nav-link active">
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
            <h1>Listing</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Listing</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Tableau pour la table 'animals' -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Liste des Animaux</h3>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Race</th>
                                        <th>Âge</th>
                                        <th>Poids</th>
                                        <th>Hauteur</th>
                                        <th>Commentaire</th>
                                        <th>ID du Client</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if (!empty($animals)) {
                                        foreach ($animals as $animal) {
                                            echo "<tr>";
                                            echo "<td>" . $animal->id . "</td>";
                                            echo "<td>" . $animal->name . "</td>";
                                            echo "<td>" . $animal->breed . "</td>";
                                            echo "<td>" . $animal->age . "</td>";
                                            echo "<td>" . $animal->weight . "</td>";
                                            echo "<td>" . $animal->height . "</td>";
                                            echo "<td>" . $animal->comment. "</td>";
                                            echo "<td>" . $animal->customer_id. "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>Aucun animal trouvé</td></tr>";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Race</th>
                                        <th>Âge</th>
                                        <th>Poids</th>
                                        <th>Hauteur</th>
                                        <th>Commentaire</th>
                                        <th>ID du Client</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tableau pour la table 'customers' -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Liste des Clients</h3>
                        </div>
                        <div class="card-body">
                            <table id="example2_customers" class="table table-bordered table-hover">
                            <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Prénom</th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Adresse</th>
                                        <th>Commentaire</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($customers)) {
                                        foreach ($customers as $customer) {
                                            echo "<tr>";
                                            echo "<td>" . $customer->id . "</td>";
                                            echo "<td>" . $customer->firstname . "</td>";
                                            echo "<td>" . $customer->lastname . "</td>";
                                            echo "<td>" . $customer->mail . "</td>";
                                            echo "<td>" . $customer->telephone . "</td>";
                                            echo "<td>" . $customer->postal_adress . "</td>";
                                            echo "<td>" . $customer->commentary . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>Aucun client trouvé</td></tr>";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Prénom</th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Adresse</th>
                                        <th>Commentaire</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tableau pour la table 'services' -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Liste des Services</h3>
                        </div>
                        <div class="card-body">
                            <table id="example2_services" class="table table-bordered table-hover">
                            <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom du Service</th>
                                        <th>Prix</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                // Vérifier si des services sont disponibles
                                if (!empty($services)) {
                                    foreach ($services as $service) {
                                        echo "<tr>";
                                        echo "<td>" . $service->id . "</td>";
                                        echo "<td>" . $service->name . "</td>";
                                        echo "<td>" . $service->price . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='3'>Aucun service trouvé</td></tr>";
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom du Service</th>
                                        <th>Prix</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tableau pour la table 'users' -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Liste des Utilisateurs</h3>
                        </div>
                        <div class="card-body">
                            <table id="example2_users" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Admin</th>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th>Mot de passe</th>  
                              </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($users)) {
                                        foreach ($users as $user) {
                                          echo "<tr>";
                                          echo "<td>" . $user->id . "</td>";
                                          echo "<td>" . $user->idisadmin . "</td>";
                                          echo "<td>" . $user->firstname . "</td>";
                                          echo "<td>" . $user->lastname . "</td>";
                                          echo "<td>" . $user->telephone . "</td>";
                                          echo "<td>" . $user->email . "</td>";
                                          echo "<td>" . $user->address . "</td>";
                                          echo "<td>" . $user->password . "</td>";
                                          echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>Aucun utilisateur trouvé</td></tr>";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                  <tr>
                                      <th>ID</th>
                                      <th>Admin</th>
                                      <th>Prénom</th>
                                      <th>Nom</th>
                                      <th>Téléphone</th>
                                      <th>Email</th>
                                      <th>Adresse</th>
                                      <th>Mot de passe</th>
                                  </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
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
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
</body>
</html>
