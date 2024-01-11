  <?php
  require_once('../../dist/php/connectionclass.php');
  require_once('../../dist/php/userclass.php');
  require_once('../../dist/php/servicesclass.php');

  $user_instance = new User();
  $user = $user_instance->getAll();
  $service = new Services();
  $service_profile = $service->getAll();
  $service_names = $user_instance->getAllServices();

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["user_id"])) {
    $userId = $_POST["user_id"];

    // Utilisez l'ID pour récupérer les informations de l'utilisateur (supposez que vous ayez une fonction pour cela)
    $user_config = $user_instance->getByID($userId);
  }



  // Vérifier la connexion
  if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
  }

  if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== true) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: login.php");
    exit;
  }
  // Le nom d'utilisateur est stocké dans $_SESSION["username"]
  $nomUtilisateur = $_SESSION["username"];

  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Projects</title>

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
      <a href="../index.php" class="brand-link">
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
                  <a href="../index.php" class="nav-link">
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
              <a href="../examples/projects.html" class="nav-link active">
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
              <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">User Profile</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                        src="../../dist/img/user4-128x128.jpg"
                        alt="User profile picture">
                  </div>

                  <h3 class="profile-username text-center"><?= $user_config->firstname . " "  .$user_config->lastname?></h3>

                  <p class="text-muted text-center">Service associé</p>

                  <ul class="list-group list-group-unbordered mb-3">
                    <?php
                    $canDoService = $user_config->CanDoCapabilities($user_config->id);
                    foreach ($service_names as $service_name) : ?>
                    <li class="list-group-item">
                      <b><?= $service_name ?></b>
                      <?php if ($canDoService[$service_name]) : ?>
                        <input type='checkbox' name='<?= $service_name?>'class="float-right" checked>
                      <?php else : ?>
                        <input type='checkbox' name='<?= $service_name?>'class="float-right">
                      <?php endif ; ?>
                    </li>
                    <?php endforeach ; ?>
                  </ul>
                  <form method='post' action='edit.php'>
                    <input type='hidden' name='user_id' value='<?= $user->id ?>'>
                    <button class="btn btn-primary btn-block">Modifier</button>
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              <!-- About Me Box -->
              <div class="card card-primary">
                
                
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Informations</a></li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal">
                        <div class="form-group row">
                          <b class="col-sm-2 col-form-label">Nom</b>
                          <div class="col-sm-10">
                            <div class="border p-2">
                              <b><?= $user_config->lastname ?></b>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <b class="col-sm-2 col-form-label">Prénom</b>
                          <div class="col-sm-10">
                            <div class="border p-2">
                              <b><?= $user_config->firstname ?></b>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <b class="col-sm-2 col-form-label">Email</b>
                          <div class="col-sm-10">
                            <div class="border p-2">
                              <b><?= $user_config->email ?></b>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputExperience" class="col-sm-2 col-form-label">Téléphone</label>
                          <div class="col-sm-10">
                            <div class="border p-2">
                              <b><?= $user_config->telephone ?></b>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputSkills" class="col-sm-2 col-form-label">Adresse</label>
                          <div class="col-sm-10">
                            <div class="border p-2">
                              <b><?= $user_config->address ?></b>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputSkills" class="col-sm-2 col-form-label">Est Admin</label>
                          <div class="col-sm-10">
                            <div class="border p-2">
                              <?php if ($user_config->idisadmin == 1): ?>
                                <b>Oui</b>
                              <?php else : ?>
                                <b>Non</b>
                              <?php endif ; ?>
                            </div>
                          </div>
                        </div>
                        
                      </form>
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
  <!-- ./wrapper -->
  </div>
  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  </body>
  </html>
