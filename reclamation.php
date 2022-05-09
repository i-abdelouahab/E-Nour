<?php
      session_start();
      error_reporting(0);
      include 'db_connect.php';
      $date_reclamation = date("Y-m-d H:i:s");
      $sub = $_POST['sujet'];
      $desc = $_POST['body'];
      $sujet = mysqli_real_escape_string($conn,$sub);
      $description = mysqli_real_escape_string($conn,$desc);
      $id_client = $_SESSION['id'];
      $reponse = "En attente";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Réclamation Client</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="client-dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">E-Nour</a>
      <input class="form-control form-control-dark text-dark w-100 font-fam" type="text" value="Espace de réclammations: <?php echo $_SESSION['nom'].' '; echo $_SESSION['prenom']; ?>" disabled>
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
                <a class="nav-link" href="clientBoard.php">
                  <span data-feather="file"></span>
                  Factures
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consommation.php">
                  <span data-feather="file"></span>
                  Nouvelle consommation <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="reclamation.php">
                  <span data-feather="shopping-cart"></span>
                  Réclamation <span class="sr-only">(current)</span>
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h3">Déposer votre réclamation</h1>
          </div>
				<form action="reclamation.php" method="POST">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Sujet</label>
      <input type="text" name="sujet" class="form-control" id="validationDefault01" placeholder="Sujet de la réclamation" required><br>
      <label for="validationDefault02">Ajouter une description</label>
      <textarea class="form-control" name="body" id="validationDefault02" placeholder="Décrire votre problème ...." required></textarea><br>
	<button class="btn btn-primary btn-adding-client" type="submit" name="envoyer">Envoyer</button>
    </div>
  </div>
</form>
          <canvas class="my-4" id="myChart" width="900" height="20"></canvas>
          <?php 
                if(isset($_POST['envoyer'])){
                  if(!empty($sujet) && !empty($description)){
                      $sql = "INSERT INTO réclamation(`date_reclamation`,`sujet`,`description`,`Id_Client`,`reponse`) VALUES('$date_reclamation','$sujet','$description','$id_client','$reponse')";
                      $resultat = $conn->query($sql);
                     }
                    }
                    $req = "SELECT * FROM réclamation WHERE sujet ='$sujet'";
                    $res = $conn->query($req);
                    if($res->num_rows > 0){
                      echo '<div class="alert alert-success alert-link">
                            Votre réclamation est enregistrée avec succès
                            </div>';
                      mysqli_free_result($res);
                    }  
              ?>
		 <h2>Vos réclamations</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Id-Réclamation</th>
                  <th>Sujet</th>
                  <th>Date de réclamation</th>
                  <th>Description</th>
				          <th>Réponse</th>
                </tr>
              </thead>
              <tbody>
              <?php
            $request = "SELECT * FROM réclamation WHERE Id_Client='$id_client'";
            $resultat = $conn->query($request);
            while($tab = mysqli_fetch_array($resultat)) { ?>
                   <tr>
                    <td><?php echo $tab['id_Reclamation'] ?></td>
                    <td><?php echo $tab['sujet'] ?></td>
                    <td><?php echo $tab['date_reclamation'] ?></td>
                    <td><?php echo $tab['description'] ?></td>
                    <td><?php echo "<font color='green'>".$tab['reponse']."</font>"; ?></td>
                   </tr>
                   <?php } ?>
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
