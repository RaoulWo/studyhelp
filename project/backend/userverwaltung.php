<?php 
    session_start();

    $_SESSION['success'] = "";

    //Überprüfung ob der Nutzer Berechtigung hat auf dieser Seite zu sein
    if (!(isset($_SESSION['benutzer']['benutzer_typ'])) || $_SESSION['benutzer']['benutzer_typ'] != 'admin') {
        $_SESSION['Fehler'] = 'Sie haben hier nichts verloren!';
        header("location: ../frontend/Fehler.php");
      }

    //Verbindung zur Datenbank wird aufgebaut und benutzerdaten gesammelt
    $db = mysqli_connect('localhost', 'root', '', 'user');
    $query = "SELECT * FROM user";
    $result = mysqli_query($db, $query);

    //Wenn Admin auf Benutzer löschen drückt wird die ID des gelöschten Users mittels GET Variable erfasst und aus der Datenbank gelöscht
    if(isset($_GET['deluser'])){
        $deluser = $_GET['deluser'];
        $delquery = "DELETE FROM user WHERE id=" . $deluser;
        $delete = mysqli_query($db, $delquery);
        header('location: userverwaltung.php');
    }

    if (isset($_GET['chstatus']) && isset($_GET['user'])){
        $chstatus = "UPDATE user SET status =" . $_GET['chstatus'] . " WHERE id =" . $_GET['user'];
        mysqli_query($db, $chstatus);
        header('location: userverwaltung.php');
    }
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("../frontend/inc/metaData.php"); ?>
    <link rel="stylesheet" type="text/css" href="../frontend/res/css/userverwaltung.css">
    <title>Userverwaltung</title>
</head>

<body>
    <?php include '../frontend/inc/Navbar.php'; ?>
    <h1><b>Userverwaltung</b></h1>
    <!-- Wenn Nutzer oder Status geändert wird, wird Erfolgsmeldung ausgegeben -->
    <?php if (isset($_SESSION['success'])): ?>
    <p class="erfolg"><?php echo $_SESSION['success']; ?></p>
    <?php endif ?>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                <th scope="col">user-id</th>
                <th scope="col">Benutzername</th>
                <th scope="col">E-Mail</th>
                <th scope="col">Benutzertyp</th>
                <th scope="col">Ändern</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    while($benutzer = mysqli_fetch_assoc($result)){ 
                        echo "<tr><th>" . $benutzer['id'] . "</th>
                        <td>" . $benutzer['username'] . "</td>
                        <td>" . $benutzer['email'] . "</td>
                        <td>" . $benutzer['benutzer_typ'] . "</td>
                        <td><a href='userverwaltung.php?deluser=" . $benutzer['id'] . "' title='User löschen'>
                        <svg xmlns='http://www.w3.org/2000/svg# width='16' height='16' fill='currentColor' class='bi bi-trash-fill test' viewBox='0 0 16 16'>
                        <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                        </svg></a> 

                        <a href='../frontend/profil_aendern.php?user=" . $benutzer['id'] . "' title='Benutzer bearbeiten'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='black' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                        </svg></a>";

                        if ($benutzer['status'] == 1){
                            echo "<a href='userverwaltung.php?chstatus=0&user=" . $benutzer['id'] . "' title='Deaktivieren'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='red' class='bi bi-x-circle' viewBox='0 0 16 16'>
                            <path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z'/>
                            <path d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z'/>
                            </svg>
                            </a>";
                            
                        }

                        else {
                            echo " <a href='userverwaltung.php?chstatus=1&user=" . $benutzer['id'] . "' title='Aktivieren'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='green' class='bi bi-check-circle' viewBox='0 0 16 16'>
                            <path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z'/>
                            <path d='M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z'/></svg>
                            </a>";
                        }
                        
                        
                        echo "</td>
                        </tr>";
                    }
                ?>
                    
                    
            </tbody>
        </table>
    </div>
</body>
</html>