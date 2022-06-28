<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Ropa+Sans" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="res/css/Fehler.css">
</head>
<body>
<div class="error-main">
<h1>Ups!</h1>
<div class="error-heading">403</div>
<p>
     <?php
      if (isset($_SESSION['Fehler'])){
        echo $_SESSION['Fehler']; 
        unset($_SESSION['Fehler']);
      }
      else{
          echo 'FEHLER';
      }
      ?>
    <br>
    <a href="index.php">Zurück zur Startseite.</a>
</p>
</div>
</body>
</html>