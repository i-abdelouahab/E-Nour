    <?php 
    include 'db_connect.php';
    //variable session
    session_start(); 
    $id=$_SESSION['id'];
    $id_facture = $_SESSION['id_Facture'];
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="client-dashboard.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="clientBoard.php">Retour</a>
  <input class="form-control form-control-dark text-dark w-100 font-fam" type="text" value="Espace de payement : <?php echo $_SESSION['nom'].' '; echo $_SESSION['prenom']; ?>" disabled>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="Index.php">Se déconnecter</a>
    </li>
  </ul>
</nav>

<!-- formulaire de la facture -->
<br><br><br><br>
<center><form action="clientBoard.php" method="POST" class="form-control col-md-6 mb-5">
  <fieldset disabled><legend>E-Nour</legend><br>
    <table>
        <tbody>
          <?php 

          $sql = "SELECT * FROM facture WHERE Id_Client='$id' AND id_Facture='$id_facture'";
            $resultat = $conn->query($sql);
            while($tab = mysqli_fetch_array($resultat)) { ?>
            <tr>
                <td>Intitulé : <?php echo $id; ?></td>
                </tr>
                <tr>
                <td>MR : <?php echo $tab['nom_client'].' '.$tab['prenom_client']; ?></td>
                </tr>
                <tr>
                <td>Adresse : <?php echo $tab['adresse_client']; ?></td>
            </tr>
            <tr>
                <td>Facture n° : <?php echo $id_facture; ?></td>
                <td>de la période : <?php echo $tab['date_facture']; ?></td>
            </tr>
            <tr>
                <td>Consommation en Kwh : <?php echo $tab['consommation']; ?></td>
            </tr>
            <tr>
                <td>Montant hors taxes : <?php echo $tab['montant_ht'].' '; ?>MAD</td>
            </tr>
            <tr>
                <td>Total TTC :<?php echo $tab['montant_ttc'].' '; ?> MAD</td>
            </tr>
            <tr>
                <td>Statut de la facture :<?php echo $tab['etat'].' '; ?></td>
            </tr>
            </tr> <?php } ?>
        </tbody>
    </table>
  </fieldset>
  <br>
  <center><button class="btn btn-primary btn-adding-client" type="submit" name="payer">Payer</button></center>
  <br>
</form></center>
</body>
</html>