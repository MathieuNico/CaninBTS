<?php
session_start();
require_once 'dist/php/verification.php';
require_once 'dist/php/customerclass.php';
require_once 'dist/php/animalsclass.php';

$CalRate = new Customer();
$CalRateanimals = new Animal();

$revenue = $CalRate->calculateRevenue();
$customerscount = $CalRate->countTotalCustomers();
$countrdvfuture = $CalRate->countFutureAppointments();
$countAnimals = $CalRateanimals->countTotalAnimal();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CANIN BTS | Tableau de bord</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- Tableau -->
  <link rel="stylesheet" href="dist/css/tableauphp.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Bonjour  <?php echo $nomUtilisateur; ?></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="logout.php" class="nav-link">Se déconnecter</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      

      <!-- Messages Dropdown Menu -->
      
      </li>
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
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">CANINBTS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
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
                <a href="./index.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tableau de bord</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="pages/charts/chartjs.php" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Graphique
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/forms/inscription.php" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Inscription
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/forms/modification.php" class="nav-link">
              <i class="nav-icon fas fa-solid fa-pen"></i>
              <p>
                Modification
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/tables/listing.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>Listing</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/calendar.html" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Calendrier
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Gallery
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/examples/projects.html" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Admin</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/documentation.html" class="nav-link">
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tableau de bord</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tableau de Bord</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $customerscount; ?></h3>

                <p>Nombre de clients</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $countAnimals; ?></h3>

                <p>Nombre d'animaux</p>
              </div>
              <div class="icon">
                <i class="ion "></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $revenue; ?><sup style="font-size: 20px">€</sup></h3>

                <p>Chiffre d'affaire réalisé</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $countrdvfuture ;?></h3>

                <p>Nombre de RDV à venir</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-sharp"></i>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row-inscription">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h2 class="card-title">Rechercher par client</h2>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" class="customer-form">
                <div class="card-body">
                  <div class="form-group">
                    <input type="texte" class="form-control" name="search" id="name" placeholder="Entrez votre recherche">
                  </div>
                    <div style="display: flex; gap: 300px;">
                      <button id="blockBtn3" style="display: block" class="btn btn-primary">Rechercher</button>
                      <a href="pages/forms/inscription.php" style="display: block" class="btn btn-success">Rajouter un nouveau client</a>
                      <a href="pages/calendar.php" style="display: block" class="btn btn-warning">Accéder au Calendrier des R.D.V</a>
                    </div>
              </form>


              <?php
              // Créer une instance de la classe Customer
              $customerInstance = new Customer();
              //Vérifier si le formulaire a été soumis
              if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              // Récupérer les données du formulaire
              $searchData = array('search' => $_POST['search']);

              // Appeler la fonction de recherche
                $results = $customerInstance->searchCustomer($searchData);

              // Afficher les résultats sous forme de tableau HTML
              if (!empty($results)) {
              echo '<table border="1">
              <tr>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Mail</th>
                  <th>Nom Animal</th>
                  <th>Race</th>
                  <th>Action</th>
              </tr>';

              foreach ($results as $result) {
                echo '<tr>
                    <td class="editable" id="lastname_' . $result['customer']['id'] . '">' . $result['customer']['lastname'] . '</td>
                    <td class="editable" id="firstname_' . $result['customer']['id'] . '">' . $result['customer']['firstname'] . '</td>
                    <td class="editable" id="mail_' . $result['customer']['id'] . '">' . $result['customer']['mail'] . '</td>
                    <td class="editable" id="name_' . $result['customer']['id'] . '">' . $result['animal']['name'] . '</td>
                    <td class="editable" id="breed_' . $result['customer']['id'] . '">' . $result['animal']['breed'] . '</td>
                    <td><i class="fas fa-edit" onclick="editRecord(event, ' . $result['customer']['id'] . ')" style="cursor: pointer;"></i>
                    <a href="detailclient.php"><i class="fas fa-eye" style="cursor: pointer; margin-left: 10px;"></i></a>
                    <a href="detailrdv.php"><i class="far fa-calendar-alt" style="cursor: pointer; margin-left: 10px;"></i></a></td>
                </tr>';
            }

              echo '</table>';
              } else {
              echo 'Aucun résultat trouvé.';
              }
              }
              ?>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row-inscription">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Rechercher par animal</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" class="customer-form">
                <div class="card-body">
                  <div class="form-group">
                    <input type="texte" class="form-control" name="search" id="name" placeholder="Entrez votre recherche">
                  </div>
                  <button id="blockBtn3" style="display: block" class="btn btn-primary">Rechercher</button>
              </form>


              <?php
              // Créer une instance de la classe Animal
              $animalInstance = new Animal();
              //Vérifier si le formulaire a été soumis
              if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              // Récupérer les données du formulaire
              $searchData = array('search' => $_POST['search']);

              // Appeler la fonction de recherche
                $results = $animalInstance->searchAnimal($searchData);

              // Afficher les résultats sous forme de tableau HTML
              if (!empty($results)) {
              echo '<table border="1">
              <tr>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Mail</th>
                  <th>Nom Animal</th>
                  <th>Race</th>
                  <th>Action</th>
              </tr>';

              foreach ($results as $result) {
                echo '<tr>
                    <td class="editable" id="lastname_' . $result['customer']['id'] . '">' . $result['customer']['lastname'] . '</td>
                    <td class="editable" id="firstname_' . $result['customer']['id'] . '">' . $result['customer']['firstname'] . '</td>
                    <td class="editable" id="mail_' . $result['customer']['id'] . '">' . $result['customer']['mail'] . '</td>
                    <td class="editable" id="name_' . $result['customer']['id'] . '">' . $result['customer']['name'] . '</td>
                    <td class="editable" id="breed_' . $result['customer']['id'] . '">' . $result['customer']['breed'] . '</td>
                    <td><i class="fas fa-edit" onclick="editRecord(event, ' . $result['customer']['id'] . ')" style="cursor: pointer;"></i>
                    <a href="detailclient.php"><i class="fas fa-eye" style="cursor: pointer; margin-left: 10px;"></i></a>
                    <a href="detailrdv.php"><i class="far fa-calendar-alt" style="cursor: pointer; margin-left: 10px;"></i></a></td>
                </tr>';
              }

              echo '</table>';
              } else {
              echo 'Aucun résultat trouvé.';
              }
              }
              ?>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row-inscription">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Liste des R.D.V à venir</h3>
              </div>
              <!-- /.card-header -->

              <?php
              // Créer une instance de la classe Customer
              $CustomerListInstance = new Customer();

              // Appeler la fonction de recherche
              try {
              $resultsListInstance = $CustomerListInstance->getAppointments();
              } catch (PDOException $e) {
              echo "Erreur lors de l'appel à la base de données : " . $e->getMessage();
              // Ajoutez un return; ici si vous voulez arrêter l'exécution du script en cas d'erreur.
              }

              // Afficher les résultats sous forme de tableau HTML
              if (!empty($resultsListInstance)) {
              echo '<table border="1">
              <tr>
             <th>Dte/Hre début</th>
             <th>Dte/Hre fin</th>
             <th>Payé</th>
             <th>Nom Animal</th>
             <th>Employé</th>
             <th>Prestation</th>
             <th>Détail</th>
             </tr>';

              foreach ($resultsListInstance as $result) {
               echo '<tr>
                <td>' . date('Y-m-d H:i:s', strtotime($result['date_start'])) . '</td>
                <td>' . date('Y-m-d H:i:s', strtotime($result['date_end'])) . '</td>
                <td>' . ($result['is_paid'] ? 'Oui' : 'Non') . '</td>
                <td>' . $result['animal_name'] . '</td>
                <td>' . $result['user_firstname'] . '</td>
                <td>' . $result['service_name'] . '</td>
                <td>
                    <a href="detailrdv.php?id=' . $result['id'] . '">
                        <i class="fas fa-eye" style="cursor: pointer; margin-left: 10px;"></i>
                    </a>
                </td>
              </tr>';
              }

              echo '</table>';
              } else {
              echo 'Aucun rendez-vous trouvé.';
                }
               ?>

            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- BoutonModifier -->
<script src="dist/js/editform.js"></script>
</body>
</html>
