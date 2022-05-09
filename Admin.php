<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
  </head>

  <body class="text-center">

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
      <header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand">E-Nour</h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link" href="Index.php">Client</a>
            <a class="nav-link active" href="#">Admin</a>
            <a class="nav-link" href="#">Contact</a>
          </nav>
        </div>
      </header>

      <main role="main" class="inner cover">
        <br><p class="lead">E-Nour vous souhaite le bienvenue. Cette pqge est dédiée seulement pour les agents de E-Nour, veuillez se connecter pour gérer votre zone géographique . . .</p>
      <form class="form-signin" action="Admin.php" method="POST">
        <h1 class="h3 mb-3 font-weight-normal">Identifiez vous, s'îl vous plaît !</h1><br>
        <input type="text" name="id" class="form-control" placeholder="Votre identifiant" required autofocus oninvalid="this.setCustomValidity('Veuillez entrer votre identifiant !')" oninput="this.setCustomValidity('')"><br>
        <input type="text" name="cin" class="form-control" placeholder="Votre carte d'identité" required oninvalid="this.setCustomValidity('Veuillez entrer votre CIN !')" oninput="this.setCustomValidity('')">
        <div class="checkbox mb-3">
          <label>
            <br><input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="envoyer">S'authentifier</button>
    </form>
	  </main>

    <?php 
    error_reporting(0);
    require_once 'db_connect.php';
    $id = $_POST["id"];
    $cin = $_POST["cin"];
    if(isset($_POST['envoyer'])){
      if(!empty($id) && !empty($cin)){
        $sql = "SELECT Id_Agent, cin FROM agent WHERE Id_Agent='$id' AND cin='$cin'";
        $result = $conn->query($sql);
        if(!$result->num_rows > 0){
          echo '<br><div class="alert alert-info alert-link"><p>Les informations sont incorrectes </p></div>';
        }else{
          header("location: dashboard.php");
        }

      }
    }
?>

      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p class="mt-5 mb-3 text-muted">&copy; 2021-2022</p>
        </div>
      </footer>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src=".js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="./vendor/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
  </body>
</html>
