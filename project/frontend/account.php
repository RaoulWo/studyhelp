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
                        <?php echo $_SESSION['mail'];?>
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
   