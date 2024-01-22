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

<?php
// Inclure le fichier des indicateurs
    include '../../dist/php/menuheader.php';
?>

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

    
<?php
// Inclure le fichier des indicateurs
    include '../../dist/php/menufooter.php';
?>
  <!-- <script src="../../plugins/jquery/jquery.min.js"></script>
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../plugins/chart.js/Chart.min.js"></script>
  <script src="../../dist/js/adminlte.min.js"></script>
  <script src="../../dist/js/demo.js"></script>



  


</body>
</html> -->