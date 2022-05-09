<?php
error_reporting(0); 
session_start();  
include 'db_connect.php';
//variables
$mois = $_POST['mois'];
$quantite = $_POST['quantite'];
$etat='';
$id=$_SESSION['id'];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Consommation Client</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="client-dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">E-Nour</a>
      <input class="form-control form-control-dark text-dark w-100 font-fam" type="text" value="Consommation mensuelle : <?php echo $_SESSION['nom'].' '; echo $_SESSION['prenom']; ?>" disabled>
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
                  <span data-feather="home"></span>
                  Factures
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="consommation.php">
                  <span data-feather="file"></span>
                  Nouvelle consommation <span class="sr-only">(current)</span>
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
            <h1 class="h3">Saisir une nouvelle consommation</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
            </div>
          </div>

				<form class="needs-validation form-control" action="consommation.php" method="POST" novalidate>
         <div class="form-row">
        <div class="col-md-4 mb-3">
        <label for="validationDefault01">Date de la facture</label>
        <input type="month" name="mois" class="form-control" id="validationDefault01" placeholder="Date" required>
                <div class="invalid-feedback">
                  Veuillez choisir la période !
                </div>
         </div>
        <div class="col-md-4 mb-3">
        <label for="validationDefault02">Votre consommation en KW/h</label>
        <input type="number" name="quantite" class="form-control" id="validationDefault02" placeholder="Consommation" required>
        <div class="invalid-feedback">
                  Entrer votre consommation !
                </div>
          </div>
        </div>
        <div class="form-row">
        </div>
        <div class="form-group">
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
        <label class="form-check-label" for="invalidCheck">
                  Etes-vous sûr de la consommation que vous avez saisi ?
                </label>
                <div class="invalid-feedback">
                  Confirmer avant d'enregistrer.
                </div>
            </div>
         </div>
        <button class="btn btn-primary btn-adding-client" name="envoyer" type="submit">Enregistrer</button>
       <script>
          // Example starter JavaScript for disabling form submissions if there are invalid fields
          (function() {
            'use strict';
            window.addEventListener('load', function() {
              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              var forms = document.getElementsByClassName('needs-validation');
              // Loop over them and prevent submission
              var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                  if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                  }
                  form.classList.add('was-validated');
                }, false);
              });
            }, false);
          })();
          </script>
      </form>
      <?php 
      if(isset($_POST['envoyer'])){
        if(!empty($mois && !empty($quantite))){
          if($quantite>=50 && $quantite<=400){
            $etat='Validée';
          }else{
            $etat='En attente';
          }
          $sql = "INSERT INTO consommation(`mois_consommation`, `quantite`, `statut`, `Id_Client`) VALUES ('$mois','$quantite','$etat','$id')";
          $result = $conn->query($sql);
          //message de succès
          if($result){
            if($quantite>=50 && $quantite<=400){
            echo '<div class="alert alert-success alert-link">
              Votre consommation est valide, votre facture sera bientôt générée ...
            </div>';
          }else{
            echo '<div class="alert alert-warning alert-link">
              Votre consommation dépasse les normes usuelles, veuillez attendre notre intervention pour vérifier la facture !
            </div>';
          }
          
        }

        
        }

      }      
      ?>
          <canvas class="my-4" id="myChart" width="900" height="100"></canvas>
          <h2>Ma consommation :</h2>
          <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
             <tr>
               <th>Id-Consommation</th>
               <th>Mois</th>
               <th>Consommation Kwh</th>
               <th>Etat</th>
             </tr>
           </thead>
            <tbody>
              <?php
            $request = "SELECT * FROM consommation WHERE Id_Client='$id'";
            $resultat = $conn->query($request);
            while($tab = mysqli_fetch_array($resultat)) { ?>
                   <tr>
                    <td><?php echo $tab['id_Consommation'] ?></td>
                    <td><?php echo $tab['mois_consommation'] ?></td>
                    <td><?php echo $tab['quantite'] ?></td>
                    <td><?php echo $tab['statut'] ?></td>
                   </tr>
                   <?php } ?>
                  </tbody>
            </table>
            <?php
            $sql = "SELECT * FROM consommation, client WHERE consommation.Id_Client = client.Id_Client AND consommation.quantite='$quantite' GROUP BY consommation.id_Consommation";
            $res = $conn->query($sql);
  
           while($tab = mysqli_fetch_array($res)) {
            $consum=$tab['quantite'];
  
      //Règle de calcul du montant hors tva selon la tranche de consommation
      if ($consum<=100) {
          $prix_ht = $consum * 0.91 ;
      }
      elseif ($consum >= 101 && $consum <= 200) {
          $prix_ht = $consum * 1.01 ;
      }
      elseif ($consum >= 201) {
          $prix_ht = $consum * 1.12 ;
      }
      
      $tva = $prix_ht * 0.14 ;
  
      // Montant TTC
      $prix_ttc = $prix_ht + $tva ;
  
      //Generer la facture
      $mois = $tab['mois_consommation'];
      $consommation = $tab['quantite'];
      $nom_client = $tab['nom'];
      $prenom_client = $tab['prenom'];
      $adresse_client = $tab['adresse'];
      $id_consom = $tab['id_Consommation'];
      $fournisseur = 'E-Nour';
      $stat = 'Non payée';
      $request = "INSERT INTO facture(`date_facture`, `consommation`, `montant_ht`, `montant_ttc`, `nom_client`, `prenom_client`, `adresse_client`,`id_Consommation`,`nom_fournisseur`,`Id_Client`,`etat`) VALUES('$mois','$consommation','$prix_ht','$prix_ttc','$nom_client','$prenom_client','$adresse_client','$id_consom','$fournisseur','$id','$stat')";
      $query =$conn->query($request);
      mysqli_free_result($query);
  /*
       echo $tab['Id_Client'].' ';
       echo $tab['mois_consommation'].' ';
       echo $tab['quantite'].' ';
       echo $tab['etat'].' ';
       echo $tab['nom'].' ';
       echo $tab['prenom'].' ';
       echo $tab['adresse'].' ';
       echo $tva.' ';
       echo $prix_ht.' ';
       echo $prix_ttc.'<br>';
  */
  }
            ?>
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
