<?php
    include_once('inc/dbacess.php');
    include_once('inc/errors.php');
    print_r($_SESSION);
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['benutzer']);
    }
    if (!isset($_SESSION['benutzer'])){
        header('location: index.php');
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
                <H1 class="text-danger">Account Daten:</H1>
                <div class="row col-12 h4 border border-3 border-secondary rounded bg-secondary mt-5 text-info">
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
<<<<<<< Updated upstream
                        <?php echo $_SESSION['mail'];?>
=======
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
>>>>>>> Stashed changes
                    </div>
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
   