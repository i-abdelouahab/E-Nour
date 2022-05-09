<?php 
        $dbname = "facture_electricite";
        $username = "root";
        $password = "";
        $localhost = "localhost";

// Create connection
$conn = new mysqli($localhost, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
echo '<div class="alert alert-success">  DB DED </div>';
  die("Connection failed: " . $conn->connect_error);
}
?>