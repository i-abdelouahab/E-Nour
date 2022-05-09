<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bilan du client</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="client-dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">E-Nour</a>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <ul class="navbar-nav px-3">
          <li class="nav-item text-nowrap">
            <a class="nav-link" href="Admin.php">Se déconnecter</a>
          </li>
        </ul>
      </nav>
  
      <div class="container-fluid">
        <div class="row">
          <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link" href="dashboard.php">
                    <span data-feather="home"></span>
                    Dashboard
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="genererFacture.php">
                    <span data-feather="file"></span>
                    Générer les factures
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="bilan.php">
                    <span data-feather="shopping-cart"></span>
                    Bilan du client <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span data-feather="layers"></span>
                    Consommation annuelle
                  </a>
                </li>
              </ul>
  
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Gestion des clients</span>
                <a class="d-flex align-items-center text-muted" href="#">
                  <span data-feather="plus-circle"></span>
                </a>
              </h6>
              <ul class="nav flex-column mb-2">
                <li class="nav-item">
                  <a class="nav-link" href="afficherClient.php">
                    <span data-feather="file-text"></span>
                    Afficher un client
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="modifierClient.php">
                    <span data-feather="file-text"></span>
                    Modifier un client
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="ajouterClient.php">
                    <span data-feather="file-text"></span>
                    Ajouter un client
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="reclamations.php">
                    <span data-feather="file-text"></span>
                    Réclamations
                  </a>
                </li>
              </ul>
            </div>
          </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">L'ensemble des factures</h1>
          </div>
			<form action="bilan.php" method="POST">
			  <div class="form-row">
				<div class="col-md-4 mb-3">
				  <label for="validationDefault01">Identifiant du client</label>
				  <input type="text" name="id" class="form-control" id="validationDefault01" placeholder="id_client" required>
				</div>
			  </div>
			  <div class="form-row">
			  </div>
			  <button class="btn btn-primary" name="envoyer" type="submit">Rechercher</button>
			</form>
          <canvas class="my-4" id="myChart" width="900" height="50"></canvas>

          <h3>Les factures du client</h3>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Id-Facture</th>
                  <th>Date facture</th>
				  <th>Consommation Kwh</th>
				  <th>Total TTC</th>
                  <th>Etat</th>
                </tr>
              </thead>
              <tbody>
              <?php
              include 'db_connect.php';
              error_reporting(0);

              $id = $_POST['id'];
              if(isset($_POST['envoyer'])){
                  if(!empty($id)){
                    $sql = "SELECT * FROM facture WHERE Id_Client = '$id' ";
                    $resultat = $conn->query($sql);
                  }
              }

            while($tab = mysqli_fetch_array($resultat)) { 
              ?>
                <tr>
                  <td><?php echo $tab['id_Facture'] ?></td>
                  <td><?php echo $tab['date_facture'] ?></td>
                  <td><?php echo $tab['consommation'] ?></td>
                  <td><?php echo $tab['montant_ttc'] ?></td>
				  <td><?php echo $tab['etat'] ?></td>
              </tr>
              <?php 
             } mysqli_free_result($resultat);
            ?>
              </tbody>
            </table>
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