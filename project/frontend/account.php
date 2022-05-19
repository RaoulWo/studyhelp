<?php
    include_once('inc/usersystem.php');
    include_once('inc/errors.php');
    if (!(isset($_SESSION["benutzer"]))){
        $_SESSION["Fehler"] = "Sie müssen sich zuerst einloggen!";
        header("location: Fehler.php");
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include MetaData, Bootstrap and jQuery -->
    <?php include_once("inc/metaData.php"); ?>
    <title>Studyhelp</title>
</head>
<body class="bg-info">
    <!-- Include Navbar -->
    <?php include_once("inc/navbar.php"); ?>    

    
    

    
    <section class="p-5">
        <div class="container">
            <div class="row text-center">
                <H1 class="text-danger">Account Daten:</H1>
                <div class="row col-12 h4 border border-3 border-secondary rounded bg-secondary mt-5 text-info">
                    <div class="col-lg">
                        <span>Username:<br><br>
                        Email:<br><br>
                        Punkte:<br><br>
                        </span>
                    </div>
                    <div class="col-lg">
                        <?php echo $_SESSION['benutzer']['username'];?><br><br>
                        <?php echo $_SESSION['mail'];?><br><br>
                    </div>
                    <a href="profil_aendern.php?user=<?php echo $_SESSION['benutzer']['id']; ?>">Profil bearbeiten</a>
                </div>
            </div>
        </div>
    </section>










    <!-- Container for GameResults -->
    <section class="p-4 pt-5 bg-light">
        <div class="container">
            <div class="mb-4">
                <h1 class="text-sm-start text-center"><span class="badge bg-dark text-light"><i
                            class="fa-solid fa-list"></i></span> Spiel-Resultate</h1>
                <hr>
                <div class="p-2 text-sm-start text-center">
                <div class="btn-group" role="group">
                    <button id="pointsDesc" type="button" class="btn btn-primary"><i class="fa-solid fa-arrow-down"></i> Punkte</button>
                    <button id="pointsAsc" type="button" class="btn btn-primary"><i class="fa-solid fa-arrow-up"></i>  Punkte</button>
                </div>

                <div class="btn-group ms-sm-2 mt-sm-0 mt-2" role="group">
                    <button id="datesDesc" type="button" class="btn btn-warning"><i class="fa-solid fa-arrow-down"></i> Datum</button>
                    <button id="datesAsc" type="button" class="btn btn-warning"><i class="fa-solid fa-arrow-up"></i>  Datum</button>
                </div>
                </div>
                

            </div>
            <!-- Here the GameResults are created -->
            <div id="gamestats">

            </div>
        </div>
    </section>
   
    <!-- Include loginModal -->
    <?php include_once("inc/loginModal.php"); ?>

    <!-- JavaScript for LoginModal -->
    <script src="scripts/loginModal.js"></script>

    <!-- Include account.js file -->
    <script src="scripts/account.js"></script>

    <!-- JavaScript for Bootstrap5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html> 
   