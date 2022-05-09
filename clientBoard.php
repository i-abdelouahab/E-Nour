    <?php 
    error_reporting(0);
    include 'db_connect.php';
    //variable session
    session_start(); 
    $id=$_SESSION['id'];
    $idFac = $_SESSION['id_Facture'];

    if(isset($_POST['payer'])){
      $sql = "UPDATE facture SET etat='Payée' WHERE id_Facture='$idFac'";
      $req = $conn->query($sql);
    }

    ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Client</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="client-dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">E-Nour</a>
      <input class="form-control form-control-dark text-dark w-100 font-fam" type="text" value="Espace de factures : <?php echo $_SESSION['nom'].' '; echo $_SESSION['prenom']; ?>" disabled>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="Index.php">Se déconnecter</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <span data-feather="home"></span>
                  Factures <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consommation.php">
                  <span data-feather="file"></span>
                  Nouvelle consommation
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="reclamation.php">
                  <span data-feather="shopping-cart"></span>
                  Réclamation
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h3">Consulter et payer vos factures facilement </h1>
            <div class="btn-toolbar mb-2 mb-md-0">
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Id-Facture</th>
                  <th>Date-Facture</th>
                  <th>Montant TTC</th>
                  <th>Statut</th>
				          <th>Consulter</th>
                </tr>
              </thead>
              <tbody>
              <?php
            $sql = "SELECT * FROM facture, consommation WHERE consommation.id_Consommation = facture.id_Consommation AND consommation.statut='Validée' AND facture.etat='Non payée' AND consommation.Id_Client='$id' GROUP BY id_Facture ";
            $resultat = $conn->query($sql);
            while($tab = mysqli_fetch_array($resultat)) { 
              ?>
                <tr>
                  <td><?php echo $tab['id_Facture'] ?></td>
                  <td><?php echo $tab['date_facture'] ?></td>
                  <td><?php echo $tab['montant_ttc'] ?></td>
                  <td><?php echo $tab['etat'] ?></td>
				          <td><form action="facture.php" method="POST">
                    <?php 
                    $_SESSION['id_Facture'] = $tab['id_Facture'];
                    ?>
                     <button type="submit" name="afficher" class="btn btn-primary">Afficher</button>
                  </form></td>
              </tr>
              <?php 
             } mysqli_free_result($resultat);
            ?>
              </tbody>
            </table>
            <canvas class="my-4" id="myChart" width="900" height="100"></canvas>
          </div>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="./vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="./vendor/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          datasets: [{
            data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    </script>
  </body>
</html>
