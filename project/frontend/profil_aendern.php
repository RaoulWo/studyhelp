<?php
    //Überprüfung ob User ein Admin ist
    include_once("inc/dbacess.php");
    if (!(isset($_SESSION['benutzer']['benutzer_typ'])) && $_SESSION['benutzer']['benutzer_typ'] != 'Admin' && 
        $_SESSION['benutzer']['id'] != $_GET['user']){
            $_SESSION['Fehler'] = 'Sie können dieses Benutzerprofil nicht verändern!';
            header("location: Fehler.php");
        }
    //User Id wird aus der Datenbank gefetcht von dem User der mit Get Variable bestimmt wird wenn auf einen Link gedrückt wird
    $db = mysqli_connect('localhost', 'root', '', 'user');   
    $getUserID = "SELECT * FROM user WHERE id=" . $_GET['user'];
    $result = mysqli_query($db, $getUserID);
    $ID = mysqli_fetch_assoc($result);
    //User id wird in Session variable gespeichert um bei dbacces.php zu verwenden
    $_SESSION['ID'] = $ID['id'];
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/registrierungstyle.css">
    <title>Profil bearbeiten</title>
</head>
<body>
<body>
    <?php include('inc/navbar.php'); ?>
    <div class="container-fluid">
        <form method="POST" class="form-container loginform" id="chuser">
            <?php //include('inc/errors.php'); ?>
            <h1>Profil bearbeiten</h1>
            <br>
            <!-- Formen werden beim Verändern schon vorausgefüllt mit Daten den zu bearbeitenden Nutzer -->
                <div class="form-group col-md-12">
                    <label for="Vname" required>Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $ID['username'];?>" required>
                </div>
                <div class="form-group col-md-12">
                    <label for="email">E-Mail Adresse</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $ID['email'];?>" required>
                </div>
                <?php if($_SESSION['benutzer']['benutzer_typ'] == 'admin'): ?>
                    <div class="form-group col-md-12">
                        <label for="passwort">Passwort ändern</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Passwort" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="usertype">Benutzertyp</label>
                        <select id="usertype" name="usertyp" class="form-control">
                                <option selected>Gast </option>
                                <option>Admin </option>
                                <option>Servicetechniker</option>
                        </select>
                    </div>
                
                <?php endif?>    
            </div>
            <br>
            <button type="submit" name="moduser" class="btn btn-primary btn-block">Speichern</button>
        </form>
    </div>   
</body>
</html>