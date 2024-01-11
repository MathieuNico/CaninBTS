<?php
require_once('../../dist/php/connectionclass.php');
require_once('../../dist/php/userclass.php');

$user_instance = new User();
$user = $user_instance->getAll();


if (isset($_POST["Delete"])) {
  $user_instance->deleteUser($_POST["user_id"]);
  header("Location: projects.php");
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
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../index.php" class="nav-link">Home</a>
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
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Employés</h3>
          <a class="btn btn-warning btn-sm float-right" href="insertuser.php">Ajouter un salarié</a>

          <div class="card-tools">
            
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          id
                      </th>
                      <th style="width: 20%">
                          Name
                      </th>
                      <th style="width: 30%">
                          Firstname
                      </th>
                      <th style="width: 30%">
                          Team Members
                      </th>
                      <th style="width: 8%" class="text-center">
                          Profil
                      </th>
                      <th style="width: 8%" class="text-center">
                          Modification
                      </th>
                      <th style="width: 8%" class="text-center" data-toggle="modal" data-target="#confirmationModal" data-item-id=<?= $user->id ?>>
                          Supprimer
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                
                <?php $images = [
                    "../../dist/img/avatar2.png",
                    "../../dist/img/avatar.png",
                    "../../dist/img/avatar3.png",
                ]; ?>
                <?php if(!empty($user)) : ?>
                  <?php foreach ($user as $user) : ?>
                    <?php 
                    $randomIndex = array_rand($images);
                    // Le chemin de l'image correspondant à l'indice choisi
                    $randomImage = $images[$randomIndex]; ?>
                    <tr>
                    <td> <?= $user->id ?></td>
                    <td> <?= $user->lastname ?></td>
                    <td> <?= $user->firstname ?></td>
                    <td><img alt='Avatar' class='table-avatar' src= '<?= $randomImage ?>'></td>
                    <form method='post' action='view.php'>
                      <input type='hidden' name='user_id' value='<?= $user->id ?>'>
                      <td class='project-actions text-right'>
                        <button type='submit' class='btn btn-primary btn-sm'>
                            <i class='fas fa-folder'></i> View
                        </button>
                      </td>
                    </form>
                    <form method='post' action='edit.php'>
                      <input type='hidden' name='user_id' value='<?= $user->id ?>'>
                      <td class='project-actions text-right'>
                        <button type='submit' class='btn btn-info btn-sm'>
                          <i class='fas fa-pencil-alt'></i> Edit
                        </button>
                      </td>
                    </form>
                    <td class='project-actions text-right'>
                    <button name="Delete" class="btn btn-danger btn-sm delete-btn" data-toggle="modal" data-id=<?= (int)$user->id ?> data-target="#modal-default">
                      <i class="fas fa-trash"></i> 
                      Delete
                    </button>
                    </td>
                <?php endforeach ; ?>
                <?php endif ; ?>
                <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Suppression d'un utilisateur</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form method="post" action="<?= $_SERVER['PHP_SELF']?>">
                    <div class="modal-body">
                      <p>Etes-vous sûr de vouloir supprimer l'utilisateur ?</p>
                      <input type="hidden" name="user_id" value="" id="userToDelete">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="Delete" class="btn btn-danger">Supprimer</button>
                    </div>
                  </form>
              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
                  
                  
              </tbody>
            </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

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
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script>
    $(document).ready(function(){
        $('.delete-btn').on('click', function() {
            var userId = $(this).data('id');
            console.log(userId);
            let inputhidden = $('#userToDelete');
            console.log(inputhidden);
            inputhidden.val(userId);
            console.log(inputhidden);
        });
    });
</script>

</body>
</html>
