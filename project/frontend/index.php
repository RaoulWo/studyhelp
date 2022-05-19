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

    <!--Boxen-->
    <section class="p-5">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md">
                    <div class="card bg-dark text-light">
                     <div class="card-body text-center">
                        <div class="h1 mb-3">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <h3 class="card-title mb-3">
                            Laptop
                        </h3>
                        <p class="card-text">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aut eaque distinctio rem reprehenderit, accusamus et?
                        </p>
                        <a href="#" class="btn btn-primary">Hier Klicken!</a>
                     </div>   
                        

                    </div>
                </div>
                <div class="col-md">
                    <div class="card bg-secondary text-light">
                        <div class="card-body text-center">
                           <div class="h1 mb-3">
                               <i class="bi bi-controller"></i>
                           </div>
                           <h3 class="card-title mb-3">
                               Vokabelspiel
                           </h3>
                           <p class="card-text">
                           Teste deine Vokabelkentnisse in einem Spiel, wo du Vokabeln von verschiedenen Sprachen vereinigen sollst!
                           </p>
                           <a href="game.php" class="btn btn-dark">Zum Spiel!</a>
                        </div>   
                           
   
                       </div>
                </div>
                <div class="col-md">
                    <div class="card bg-dark text-light">
                        <div class="card-body text-center">
                           <div class="h1 mb-3">
                               <i class="bi bi-joystick"></i>
                           </div>
                           <h3 class="card-title mb-3">
                               Joystick
                           </h3>
                           <p class="card-text">
                           Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aut eaque distinctio rem reprehenderit, accusamus et?
                           </p>
                           <a href="#" class="btn btn-primary">Hier Klicken!</a>
                        </div>   
                           
   
                       </div>
                </div>
            </div>
        </div>
    </section>

    <!--Section-->
    <section id="learn" class="p-5">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md">
                    <img src="res/img/gaming.svg" class="img-fluid" alt="">
                </div>
                <div class="col-md p-5">
                    <h2>Gamingbereich/Content</h2>
                    <p class="lead">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Incidunt eum unde commodi molestias. Aliquam, necessitatibus!
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam repellendus, numquam ad nesciunt delectus dolor atque, reprehenderit iusto sint et minus ratione molestiae fugit voluptate ipsam, culpa veritatis adipisci sed?
                    </p>
                    <a href="#" class="btn btn-light mt-3">
                        <i class="bi bi-chevron-right">Hier Klicken</i>
                    </a>
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
                    <a href="#" class="btn btn-light mt-3">
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