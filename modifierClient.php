<?php 
// Pour masquer tous les erreurs et les exceptions
error_reporting(0);
include 'db_connect.php';

  // Déclaration des variables
$idSearch = $_POST['idSearch'];
  if(isset($_POST['chercher'])){
    if(!empty($idSearch)){
      $sql = "SELECT * FROM client WHERE Id_Client='$idSearch'";
      $result = $conn->query($sql);
      $data = mysqli_fetch_array($result);
      $id = $data['Id_Client'];
      $cin = $data['cin'];
      $nom = $data['nom'];
      $prenom = $data['prenom'];
      $email = $data['email'];
      $tel = $data['telephone'];
      $adresse = $data['adresse'];
      $ville = $data['ville'];
      $fournisseur= $data['fournisseur'];
    }
  }
  
  
     /* Notification de succès
     $id_client = "SELECT Id_Client FROM client WHERE cin='$cin'";
     $res = $conn->query($id_client);
     if($res->num_rows > 0){
       $data = mysqli_fetch_array($res);
       $id = $data['Id_Client'];
     echo '<div class="alert alert-success">
     Vous avez ajouté le client '.$nom.' '.$prenom.' avec succès.<br>
     Identifiant du client : '.$id.'<br>
     Carte d\'identité : '.$cin.'</div>';
     mysqli_free_result($res);
     */
            ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modifier un client</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
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
                  <a class="nav-link" href="bilan.php">
                    <span data-feather="shopping-cart"></span>
                    Bilan du client
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
                  <a class="nav-link active" href="modifierClient.php">
                    <span data-feather="file-text"></span>
                    Modifier un client <span class="sr-only">(current)</span>
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
            <h1 class="h2">Mettre à jour les informations d'un client</h1>
          </div>
          <form action="modifierClient.php" method="POST">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <table><tr><td><input type="text" name="idSearch" class="form-control" id="validationDefault01" placeholder="Entrer un identifiant" required></td><td><button class="btn btn-primary btn-adding-client" type="submit" name="chercher">Rechercher</button></td></tr></table>
    </div>
  </div>
</form>
          <form class="needs-validation form-control" action="modifierClient.php" method="POST" novalidate>
            <br>
            <div class="form-row">
              <div class="col-md-4 mb-3">
                <label for="validationCustom01">CIN:</label>
                <input type="text" name="cin" class="form-control" value="<?php echo $cin; ?>" id="validationCustom01" placeholder="Carte d'identité" required>
                <div class="valid-feedback">
                  Ça a l'air bon !
                </div>
                <div class="invalid-feedback">
                  Entrer le numéro d'identité du client !
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationCustom02">Nom</label>
                <input type="text" name="nom" value="<?php echo $nom; ?>" class="form-control" id="validationCustom02" placeholder="Nom du client" required >
                <div class="valid-feedback">
                  Ça a l'air bon !
                </div>
                <div class="invalid-feedback">
                  Entrer le nom du client !
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationCustomUsername">Prénom</label>
                  <input type="text" name="prenom" value="<?php echo $prenom; ?>" class="form-control" id="validationCustomUsername" placeholder="Prénom du client" required>
                  <div class="valid-feedback">
                    Ça a l'air bon !
                  </div>
                  <div class="invalid-feedback">
                    Entrer le prénom du client !
                  </div>
                </div>
                </div>
                <div class="form-row">
              <div class="col-md-4 mb-3">
                <label for="validationCustom03">Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" id="validationCustom03" placeholder="Email du client" required>
                <div class="valid-feedback">
                  Ça a l'air bon !
                </div>
                <div class="invalid-feedback">
                  Forme de l'email non reconnue !
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationCustomUsername">Téléphone</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">(+212)</span>
                  </div>
                  <input type="tel" name="tel" value="<?php echo $tel; ?>" class="form-control" id="validationCustomUsername" placeholder="-- -- -- -- -- "  required>
                  <div class="valid-feedback">
                    Ça a l'air bon !
                  </div>
                  <div class="invalid-feedback">
                    Forme du numéro de téléphone non reconnue !
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationCustom05">Adresse</label>
                <input type="text" name="adresse" value="<?php echo $adresse; ?>" class="form-control" id="validationCustom05" placeholder="Adresse du client" required>
                <div class="valid-feedback">
                  Ça a l'air bon !
                </div>
                <div class="invalid-feedback">
                  Veuillez saisir l'adresse du client !
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4 mb-3">
                <label for="validationCustom05">Zone géographique</label>
                <select class="custom-select"  name="ville" id="validationCustom06" required>
                  <option value="<?php echo $ville; ?>"><?php echo $ville; ?></option>
                  <option value="Martil">Martil</option>
                  <option value="Tetouan">Tetouan</option>
                  <option value="M\'diq">M'diq</option>
                  <option value="Fnideq">Fnideq</option>
                </select>
                <div class="valid-feedback">
                  Choix effectué !
                </div>
                <div class="invalid-feedback">
                  Veuillez sélectionner le lieu de résidence du client !
                </div>
            </div>
            </div>
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                <label class="form-check-label" for="invalidCheck">
                  Etes-vous sûr de vouloir modifier ces information ?
                </label>
                <div class="invalid-feedback">
                  Confirmer avant d'envoyer.
                </div>
              </div>
            </div>
            <button class="btn btn-primary btn-adding-client" type="submit" name="modifier">Modifier</button>
            <br><br>
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
          // Pour masquer tous les erreurs et les exceptions
          //error_reporting(0);
          include 'db_connect.php';

          $newcin = $_POST['cin'];
          $newnom = $_POST['nom'];
          $newprenom = $_POST['prenom'];
          $newemail = $_POST['email'];
          $newtel = $_POST['tel'];
          $newadresse = $_POST['adresse'];
          $newville = $_POST['ville'];
          $newfournisseur="E-Nour";

          if(isset($_POST['modifier'])){
            if(!empty($newcin) && !empty($newnom) && !empty($newprenom) && !empty($newemail) && !empty($newtel) && !empty($newadresse) && !empty($newville)){
              $sql = "UPDATE client
                    SET cin='$newcin', nom='$newnom', prenom='$newprenom', email='$newemail',telephone='$newtel', adresse='$newadresse', ville='$newville' WHERE cin = '$newcin'";
              $result=$conn->query($sql);
            }
          }
          // Notification de succès
            $id_client = "SELECT Id_Client FROM client WHERE cin='$newcin'";
            $res = $conn->query($id_client);
            if($res->num_rows > 0){
                $dataset = mysqli_fetch_array($res);
                echo '<div class="alert alert-success">
                Vous avez modifié le client '.$newnom.' '.$newprenom.' avec succès.<br>
                Identifiant du client : '.$id.'<br>
                Carte d\'identité : '.$newcin.'</div>';
                mysqli_free_result($res);
            }
           ?>

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
