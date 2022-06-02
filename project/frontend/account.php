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
<body class="bg">
    <!-- Include Navbar -->
    <?php include_once("inc/navbar.php"); ?>    

    <?php include_once("inc/profile.php"); ?>


    <?php
        $db1 = mysqli_connect('localhost', 'root', '', 'user');
        $username = $_SESSION['benutzer']['username'];
        $pts1 = "SELECT punkte FROM user WHERE username='$username'";
        $points1 = mysqli_fetch_assoc(mysqli_query($db1, $pts1));
        $lvl1 = "SELECT level FROM user WHERE username='$username'";
        $lvls1 = mysqli_fetch_assoc(mysqli_query($db1, $lvl));
    ?>
    

    
    <section class="p-5">
        <div class="container">
            <div class="row text-center">
                <H1>Account Daten:</H1>
                <div class="row col-12 h4 border border-3 border-secondary rounded  mt-5">
                    <div class="col-lg">
                        <span>Username:<br><br>
                        Email:<br><br>
                        Level:<br><br>
                        Punkte:<br><br>
                        <a href="profil_aendern.php?user=<?php echo $_SESSION['benutzer']['id']; ?>">Profil bearbeiten</a>
                        </span>
                    </div>
                    <div class="col-lg">
                        <?php echo $_SESSION['benutzer']['username'];?><br><br>
                        <?php echo $_SESSION['mail'];?><br><br>
                        <?php echo $lvls['level'];?> <br><br>
                        <?php echo $points1['punkte'];?><br><br>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                        Open Profile
                        </button>
                    </div>
                    <div class="container">
                        <div id="content">  
                            <form action="profilepic.php" method="post" enctype="multipart/form-data">
                                <br><br>
                                Profilbild hochladen:
                                <input type="file" name="file">
                                <input type="submit" name="submit" value="Upload">
                            </form>
                        </div>

                    </div>
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
   