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


    <form method="post" id="addFriend" name="addFriend" action="../backend/friendhandler.php">
        <div class="p-4">
            <div class="container">
                <h1 class="mb-3">Freunde hinzufügen</h1>
                <input type="text" class="form-control" id="friend" placeholder="Username hier eingeben" name="friend">
                <button type="submit" class="btn btn-outline-success mt-2" name="addFriend">Freundschaftanfrage schicken</button>
            </div>
        </div>
    </form>
    <div class="p-4">
        <div class="container">
            <div id="userlistcontainer" class="text-sm-start text-center">
                <ul id="userlist" class="list-group">

                </ul>
            </div>
        </div>
    </div>


    <hr>

    <div class="p-4">
        <div class="container">
        <h1 class="text-sm-start text-center mb-3">Deine Freundschaftsanfragen</h1>
        <div class=" text-sm-start text-center">
        <div class="btn-group ms-sm-2 mt-sm-0 mt-2" role="group">
            <button id="datesDesc" type="button" class="btn btn-warning"><i class="fa-solid fa-arrow-down"></i> Datum</button>
            <button id="datesAsc" type="button" class="btn btn-warning"><i class="fa-solid fa-arrow-up"></i>  Datum</button>
        </div>
        </div>
        
        <div id="friendRequests" class="mt-4">
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