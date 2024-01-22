<?php
session_start();
require_once '../dist/php/verification.php';
require_once '../dist/php/customerclass.php';
// Remplacez les valeurs suivantes par les informations de votre base de données
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "root";
$baseDeDonnees = "toilettage";

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion : " . $connexion->connect_error);
}

// Requête SQL avec alias pour éviter les conflits de noms de colonnes
$sql = "SELECT 
    appointments.id, 
    appointments.date_start as start, 
    appointments.date_end as end, 
    animals.name as animal_name, 
    services.name as service_name, 
    users.firstname 
FROM appointments
INNER JOIN animals ON appointments.animal_id = animals.id
INNER JOIN services ON appointments.service_id = services.id
INNER JOIN users ON appointments.user_id = users.id";

$resultat = $connexion->query($sql);

// Vérifier si la requête a réussi
if ($resultat) {
    // Initialiser un tableau pour stocker les données
    $datas = array();

    // Parcourir les résultats de la requête
    while ($row = $resultat->fetch_assoc()) {
        // Formater les dates en utilisant strtotime
        $row['start'] = date('Y-m-d H:i:s', strtotime($row['start']));
        $row['end'] = date('Y-m-d H:i:s', strtotime($row['end']));

        // Utiliser les clés correctes pour les informations supplémentaires
        $row['animal_name'] = $row['animal_name'];
        $row['service_name'] = $row['service_name'];
        $row['user_name'] = $row['firstname'];

        // Ajouter la ligne au tableau de données
        $datas[] = $row;
    }

    // Fermer la connexion à la base de données
    $connexion->close();

    // Convertir le tableau en format JSON
    $final_array = json_encode($datas);

//     // Afficher le résultat
//     echo("<pre>");
//     echo("<code>");
//     echo $final_array;
//     echo("</code>");
//     echo("</pre>");
// } else {
//     echo "Erreur de requête : " . $connexion->error;
}
?>
<?php
// Inclure le fichier des indicateurs
    include '../dist/php/menuheader.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Calendar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Calendrier</li>
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
            <div class="sticky-top mb-3">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Prendre un RDV</h4>
                </div>
                <div class="card-body">
                  <!-- the events -->
                  <div id="external-events">
                    <div class="external-event bg-success">Lunch</div>
                    <div class="external-event bg-warning">Go home</div>
                    <div class="external-event bg-info">Do homework</div>
                    <div class="external-event bg-primary">Work on UI design</div>
                    <div class="external-event bg-danger">Sleep tight</div>
                    <div class="checkbox">
                      <label for="drop-remove">
                        <input type="checkbox" id="drop-remove">
                        remove after drop
                      </label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Create Event</h3>
                </div>
                <div class="card-body">
                  <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                    <ul class="fc-color-picker" id="color-chooser">
                      <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                    </ul>
                  </div>
                  <!-- /btn-group -->
                  <div class="input-group">
                    <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                    <div class="input-group-append">
                      <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                    </div>
                    <!-- /btn-group -->
                  </div>
                  <!-- /input-group -->
                </div>
              </div>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <input id="event-datas" type="hidden" value='<?php echo $final_array; ?>'>
                <div id="calendar" style="max-width:100%;"></div>
                <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
                <!-- <div id="calendar"></div> -->
              </div>
              <!-- /.card-body -->
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
  <!-- /.content-wrapper -->

<script>
    let test = document.querySelector("#event-datas").value;
    let events = JSON.parse(test);

    console.log(events);

    console.log(JSON.stringify(events));

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: { center: 'dayGridMonth,timeGridWeek' },
            initialView: 'dayGridMonth',
            events: events.map(function (event) {
                return {
                    title: event.animal_name || event.service_name || event.user_name,
                    start: event.start,
                    end: event.end,
                    id : event.id,
                    url: '../pages/forms/detailrdv.php?id=' + event.id // Ajoutez le lien que vous souhaitez ici
                };
            }),
            locale: 'fr',
            // slotDuration: '02:00',
            eventClick: function (info) {
                if (info.event.url) {
                    window.location = info.event.url;
                }
            }
        });
        calendar.render();
    });
</script>

<?php
// Inclure le fichier des indicateurs
    include '../dist/php/menufooter.php';
?>
