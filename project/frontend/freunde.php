<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include MetaData, Bootstrap and jQuery -->
    <?php include_once("inc/metaData.php"); ?>
    <title>Studyhelp</title>
</head>
<body>
    <!-- Include Navbar -->
    <?php include_once("inc/navbar.php"); ?>    

    <div class="p-4">
        <div class="container">
            <h1>Freunde hinzufügen</h1>
            label
            <button class="btn btn-outline-success mt-2">Freunde suchen</button>
        </div>
    </div>
    




    <!-- Include loginModal -->
    <?php include_once("inc/loginModal.php"); ?>

    <!-- JavaScript for LoginModal -->
    <script src="scripts/loginModal.js"></script>

    <!-- Include freunde.js file -->
    <script src="scripts/freunde.js"></script>

    <!-- JavaScript for Bootstrap5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html> 