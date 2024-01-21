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

// Requête pour Diagramme Race
$req = mysqli_query($connexion,"SELECT COUNT(*) as count FROM animals WHERE breed IN ('Golden Retriever', 'Labrador Retriever','Bulldog','German Shepherd') GROUP BY breed;");
// Requêtre pour Diagramme Service
$req2 = mysqli_query($connexion,"SELECT service_id, COUNT(user_id) AS nombredemploye FROM capabilities GROUP BY service_id;");
$reqserv = mysqli_query($connexion,"SELECT name, id FROM services;");
// Requête pour Diagramme Poids
$reqcategory = mysqli_query($connexion,"SELECT CASE WHEN weight > 30 AND weight < 50 THEN 'Poids normal' WHEN weight >= 50 THEN 'Poids élevé' WHEN weight <= 30 THEN 'Poids léger' END AS category_weight, COUNT(*) AS number_animal FROM animals GROUP BY category_weight;");
// Requête pour Diagramme Age
$reqage = mysqli_query($connexion,"SELECT CASE WHEN age > 10 THEN 'Chien agé' WHEN age >= 5 AND age <= 10 THEN 'Entre 5 et 10 ans' WHEN age < 5 THEN '< 5 ans' END AS category_age, COUNT(*) AS number_animal_age FROM animals GROUP BY category_age;");

// Affecte Donnée de la requête pour Diagramme Race à la variable $donne
foreach($req as $data){
  $donne[]= $data['count'];
}
// Affecte Donnée de la requête pour Diagramme Service à la variable $linedonne et $service
foreach($req2 as $data){
  $linedonne[]= $data['nombredemploye'];
}
foreach($reqserv as $data){
  $service[] = $data['name'];
}
// affecte Donnée de la requête pour Diagramme Poids à la variable $category et $poid
foreach($reqcategory as $data){
  $category[] = $data['category_weight'];
  $poid[] = $data['number_animal'];
}
// Affecte Donnée de la requête pour Diagramme Age à la variable $categoage et $age
foreach($reqage as $data){
  $categoage[] = $data['category_age'];
  $age[] = $data['number_animal_age'];

}

// Fermer la connexion
$connexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CANIN BTS | Statistic</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
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
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Bonjour  <?php echo $nomUtilisateur; ?></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="logout.php" class="nav-link">Se déconnecter</a>
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
    <a href="../../index.html" class="brand-link">
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
          <a href="#" class="d-block"><?php echo $nomUtilisateur; ?></a>
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
            <a href="../charts/chartjs.php" class="nav-link active">
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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Statistic</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Graphique</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">  
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Diagramme D'age</h3>
                <div class="card-tools">
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>  
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Diagramme Race</h3>
                <div class="card-tools">
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>
      
            <!-- /.card -->
          </div>
          <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Diagramme Service</h3>
                <div class="card-tools">
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Diagramme Poids</h3>
                <div class="card-tools">
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- STACKED BAR CHART -->
            
            <!-- /.card succeess -->
          </div>
          <!-- Col-md6 -->
        </div>
        <!-- row -->
      </div>
      <!-- container -->
    </section>
  </div>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2023.2024 <a href="../../index.php">CANINBTS</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Add Content Here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- SCRIPT DIAGRAMME RACE -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const data = {
      labels: ['Golden Retriever','Labrador Retriever','Bulldog','German Shepperd'],
      datasets: [{
        label:'Quantité',
        data: <?php echo json_encode($donne)?>,
        backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)', 'rgb(255, 40, 200'],
        hoverOffset: 4
      }
      ]

    };

    const config = {
      type: 'doughnut',
      data:data,
    };

    const myChart = new Chart(
      document.getElementById('donutChart'),
      config
    );

  
  </script>
      
  
<!-- SCRIPT DIAGRAMME SERVICE -->  

  <script>
    const ctx = document.getElementById('lineChart');

    new Chart(ctx, {
      type: 'line',
      data: {
        labels: <?php echo json_encode($service)?>,
        datasets: [{
          label: 'Nombre de Rendez vous actuel',
          data: <?php echo json_encode($linedonne)?>,
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          } 
        }
      }
    });
  </script>
<!-- SCRIPT DIAGRAMME POIDS -->
  <script>
    const barchat = document.getElementById('barChart');

    new Chart(barchat, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($category)?>,
        datasets: [{
          label: ['Résumé Poids'],
          data: <?php echo json_encode($poid)?>,
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(153, 102, 255, 0.2)'
          ],
          borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(153, 102, 255)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          } 
        }
      }
    });
  </script>

<!-- SCRIPT DIAGRAMME AGE -->
  <script>
    const barage = document.getElementById('areaChart');

    new Chart(barage, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($categoage)?>,
        datasets: [{
          label: ['Résumé Age'],
          data: <?php echo json_encode($age)?>,
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(153, 102, 255, 0.2)'
          ],
          borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(153, 102, 255)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        indexAxis: 'y',
        scales: {
          x: {
            beginAtZero: true
          } 
        }
      }
    });
  </script>

    

  <script src="../../plugins/jquery/jquery.min.js"></script>
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../plugins/chart.js/Chart.min.js"></script>
  <script src="../../dist/js/adminlte.min.js"></script>
  <script src="../../dist/js/demo.js"></script>



  


</body>
</html>
