<?php
    include_once('inc/usersystem.php');
    include_once('inc/errors.php');
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['benutzer']);
        header("location: index.php");
    }
    
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

    <!--Startseitencontainer-->
    <section class="bg-dark text-light p-5 p-lg-0 pb-lg-4 text-center text-sm-start">
        <div class="container">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <h1>Startseite von <span class="text-warning">
                        Studyhelp

                    </span> </h1>

                    <p class="lead my-4">
                    Wilkommen zu Studyhelp, hier kannst du eine Sammlung von Spielen finden, die deine Sprachkenntnisse in Deutsch, Englisch, Spanisch und Russisch vertiefen können.
                    </p>

                </div>
                <img class="img-fluid w-50 d-none d-sm-block" src="res/img/scrum.svg" alt="">
            </div>
        </div>
    </section>

    <!--Anmeldung-->
    <?php if ((!isset($_SESSION["benutzer"]))) : ?>
    <section class="bg-primary text-light p-5">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center">
                <h3 class="mb-3 mb-md-0">Hier kann man sich einloggen oder sich einen Account erstellen</h3>
                
                <div class="input-group news-input">
                <button type="button" class="btn btn-dark btn-lg" data-bs-toggle="modal" data-bs-target="#loginModal">
                Login
              </button>
                  </div>
            </div>
        </div>
    </section>
    <?php endif ?>
    
   
    <!--Section-->
    <section id="learn" class="p-5">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md">
                    <img src="res/img/gaming.svg" class="img-fluid" alt="">
                </div>
                <div class="col-md p-5">
                    <h2>Vokabelspiel</h2>
                    <p class="lead">
                      Teste deine Vokabelkentnisse in einem Spiel, wo du Vokabeln von verschiedenen Sprachen vereinigen sollst!
                    </p>
                   
                    <a href="game.php" class="btn btn-dark">Zum Spiel!</a>
                </div>

            </div>
        </div>

    </section>

    <section id="learn" class="p-5 bg-dark text-light">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                
                <div class="col-md p-5">
                    <h2>Resultate</h2>
                    <p class="lead">
                        Willst du wissen wie viel Fortschritt du bei Studyhelp gemacht hast?
                    </p>
                    <p>
                       Hier kannst du dein Level, deine Erfolge und dein Spielverlauf sehen.
                    </p>
                    <a href="account.php" class="btn btn-light mt-3">
                        <i class="bi bi-chevron-right">Hier Klicken</i>
                    </a>
                </div>
                <div class="col-md">
                    <img src="res/img/result.svg" class="img-fluid" alt="">
                </div>

            </div>
        </div>
    </section>

    <!-- Include loginModal -->
    <?php include_once("inc/loginModal.php"); ?>

    <!-- JavaScript for LoginModal -->
    <script src="scripts/loginModal.js"></script>

    <!-- JavaScript for Bootstrap5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html> 