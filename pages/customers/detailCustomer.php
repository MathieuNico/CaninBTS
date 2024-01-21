<?php

require_once '../../dist/php/customerclass.php';
$customerInstance = new Customer();

// Récupère l'ID du client de l'URL
$customerId = isset($_GET['id']) ? $_GET['id'] : null;

// Récupérer les informations du client spécifique
$customer = null;
if ($customerId) {
    $customer = $customerInstance->getCustomerById($customerId); // Utiliser la méthode existante
}

require_once '../../dist/php/animalsclass.php';
$animalInstance = new Animal();

// Récupère l'ID du client de l'URL
$customerId = isset($_GET['id']) ? $_GET['id'] : null;

// récupere les information des l'animaeaux en fonction de l'id du client
$animals = null;
if ($customerId) {
    $animals = $animalInstance->getAnimalByCustomerId($customerId); // Utiliser la méthode existante
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
            <h1>Détail</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">détail</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Informations du Client</h3>
                    </div>
                    <div class="card-body">
                        <table id="example2_users" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th>Adresse</th>
                                    <th>Commentaire</th>
                                    <th>Actif</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($customer): ?>
                                    <tr>
                                        <td><?php echo $customer->id; ?></td>
                                        <td><?php echo $customer->firstname; ?></td>
                                        <td><?php echo $customer->lastname; ?></td>
                                        <td><?php echo $customer->telephone; ?></td>
                                        <td><?php echo $customer->mail; ?></td>
                                        <td><?php echo $customer->postal_adress; ?></td>
                                        <td><?php echo $customer->commentary; ?></td>
                                        <td><?php echo $customer->is_actif ? 'Oui' : 'Non'; ?></td>
                                        <td><a href="editCustomer.php?id=<?php echo $customer->id; ?>" class="btn btn-primary">Modifier</a></td>
                                        <td><button class="btn btn-danger btn-disable-customer" data-id="<?php echo $customer->id; ?>">Désactiver</button></td>

                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="10">Client non trouvé.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">liste des animeaux du client</h3>
                    </div>
                    <div class="card-body">
                        <table id="example2_users" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>nom</th>
                                    <th>race</th>
                                    <th>age</th>
                                    <th>poids</th>
                                    <th>taille</th>
                                    <th>commentaire</th>
                                    <th>actif</th>
                                    <th>voir</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($animals) && is_array($animals)): ?>
                              <?php foreach ($animals as $animal): ?>
                                <tr>
                                  <td><?php echo $animal->id; ?></td>
                                  <td><?php echo $animal->name; ?></td>
                                  <td><?php echo $animal->breed; ?></td>
                                  <td><?php echo $animal->age; ?></td>
                                  <td><?php echo $animal->weight; ?></td>
                                  <td><?php echo $animal->height; ?></td>
                                  <td><?php echo $animal->comment; ?></td>
                                  <td><?php echo $animal->is_actif ? 'Oui' : 'Non'; ?></td>
                                  <td><a href="detailAnimal.php?id=<?php echo $animal->id; ?>" class="btn btn-primary">voir</a></td>
                                  <td><a href="editAnimal.php?id=<?php echo $animal->id; ?>" class="btn btn-primary">Modifier</a></td>
                                  <td><button class="btn btn-danger btn-disable-animal" data-id="<?php echo $animal->id; ?>">Désactiver</button></td>
                                </tr>
                              <?php endforeach; ?>
                              <?php else: ?>
                                <tr>
                                  <td colspan="11">Aucun animal trouvé pour ce client.</td>
                                </tr>
                              <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>nom</th>
                                    <th>race</th>
                                    <th>age</th>
                                    <th>poids</th>
                                    <th>taille</th>
                                    <th>commentaire</th>
                                    <th>actif</th>
                                    <th>voir</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
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


<script>
$(document).ready(function() {
    // Gérer le clic sur le bouton "Désactiver" pour un client
    $(".btn-disable-animal").click(function() {
        var animalId = $(this).data("id");
        console.log("animal ID à désactiver : " + animalId); // Vérifiez si l'ID est correct

        // Envoyer une requête AJAX au serveur pour désactiver le client
        $.ajax({
            url: "disableAnimal.php", // Le script PHP qui gère la désactivation du client
            method: "POST",
            data: { animal_id: animalId },
            success: function(response) {
                console.log("Réponse du serveur : " + response); // Vérifiez la réponse du serveur
                // Mettre à jour l'interface utilisateur en conséquence
                if (response === "success") {
                    alert("animal désactivé avec succès.");
                    location.reload(); // Rechargez la page pour mettre à jour la liste des clients
                } else {
                    alert("Erreur lors de la désactivation de l'animal.");
                }
            }
        });
    });
});
</script>

<script>
$(document).ready(function() {
    // Gérer le clic sur le bouton "Désactiver" pour un client
    $(".btn-disable-customer").click(function() {
        var customerId = $(this).data("id");
        console.log("Customer ID à désactiver : " + customerId); // Vérifiez si l'ID est correct

        // Envoyer une requête AJAX au serveur pour désactiver le client
        $.ajax({
            url: "disableCustomer.php", // Le script PHP qui gère la désactivation du client
            method: "POST",
            data: { customer_id: customerId },
            success: function(response) {
                console.log("Réponse du serveur : " + response); // Vérifiez la réponse du serveur
                // Mettre à jour l'interface utilisateur en conséquence
                if (response === "success") {
                    alert("Client désactivé avec succès.");
                    location.reload(); // Rechargez la page pour mettre à jour la liste des clients
                } else {
                    alert("Erreur lors de la désactivation du client.");
                }
            }
        });
    });
});
</script>

</body>
</html>
