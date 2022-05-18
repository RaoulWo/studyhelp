<?php
session_start();

$errors = array(); 
$db = mysqli_connect('localhost', 'root', '', 'user');

// Die Eingabe vom Benutzer wird sicher (vor SQL Injection Attacks) als Variable gespeichert, wenn sich ein Nutzer registriert oder 
//seine Profildaten ändern möchte
if (isset($_POST['reg_user']) || isset($_POST['moduser'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
}


if (isset($_POST['reg_user'])) {
  // Erst wird geschaut ob die Form richtig ausgefüllt wurde
  // Mit array_push werden potentielle Fehlermeldungen im error array gespeichert
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  if (empty($username)) { array_push($errors, "Bitte geben Sie Ihren Username an!"); }
  if (empty($email)) { array_push($errors, "Bitte geben Sie Ihre E-Mail Adresse an!"); }
  if (empty($password_1)) { array_push($errors, "Bitte wählen Sie ein gültiges Passwort aus!"); }
  if ($password_1 != $password_2) {
  array_push($errors, "Die Passwörter stimmen nicht überein!");
  }

  // Datenbank wird nach dem selben Benutzernamen/email durchsucht
  $user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // Falls dieser Benutzer schon existiert wird ein Fehler ausgegeben
    if ($user['username'] === $username) {
      array_push($errors, "Benutzername ist schon vergeben, bitte wählen Sie einen anderen Benutzernamen!");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Es existiert bereits ein Benutzeraccount mit dieser Email-Adresse");
    }
  }

  // Falls es keine Fehler in der Registrierung gibt wird der Account erstellt
  if (count($errors) == 0) {
    $_SESSION['mail'] = $email;
    $password = md5($password_1);
    //Passwort wird vor der Anlegung in Datenbank verschlüsselt
    //Wenn der User von einem Admin erstellt wird und usertyp ausgewählt wurde wird der Benutzer mit diesem Typen erstellt
    if (isset($_POST['usertype'])){
      $benutzertyp = mysqli_real_escape_string($db, $_POST['usertype']);
      $query = "INSERT INTO user (username, email, password, benutzer_typ) 
            VALUES('$username', '$email', '$password', '$benutzertyp')";
      mysqli_query($db, $query);

      $_SESSION['sucess'] = "Neuer Benutzer wurde angelegt";
    }
    //Wenn der usertyp nicht extra angebeben wird (normale registration) wird kein Benutzertyp gespeichert.
    //Benutzertyp NULL = Gast
    else{
      $query = "INSERT INTO user (username, email, password) 
      VALUES('$username', '$email', '$password')";
      mysqli_query($db, $query);
      
      $user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
      $result = mysqli_query($db, $user_check_query);
      $benutzer = mysqli_fetch_assoc($result);
      $_SESSION['benutzer'] = $benutzer;
      $_SESSION['success'] = "Sie sind jetzt eingelogged!";
    }
  }
}

// LOGIN
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Bitte geben Sie Ihren Benutzernamen ein!");
    }
    if (empty($password)) {
        array_push($errors, "Bitte geben Sie Ihr Passwort ein!");
    }

    //Wenn nach dem Benutzernamencheck 0 Fehler aufgetaucht sind wird noch überprüft ob die Benutzer/Passwort Kombination stimmt und
    //ob der Benutzer noch einen aktiven Account hat
    if (count($errors) == 0) {
      $password = md5($password);
      $query = "SELECT * FROM user WHERE username='$username' AND password='$password' LIMIT 1";
      $results = mysqli_query($db, $query);

      if (mysqli_num_rows($results) == 1) {
        $benutzer = mysqli_fetch_assoc($results);
        $_SESSION['benutzer'] = $benutzer;
        $_SESSION['success'] = "Sie sind jetzt eingelogged!";
        $query2 = "SELECT email FROM user WHERE username='$username'";
        $umail = mysqli_fetch_assoc(mysqli_query($db, $query2));
        $_SESSION['mail'] = $umail['email'];
      }
      else {
          array_push($errors, "Falscher Username oder falsches Passwort oder Account deaktiviert. Bitte versuchen Sie es erneut!");
      }
    }
  }

//Benutzerdaten ändern
if (isset($_POST['moduser'])) {

      //Benutzerdaten die für normale Benutzer veränderbar sind
      $profil_aendern = "UPDATE user SET username = '$username', email = '$email'
      WHERE id =" .  $_SESSION['ID'];
      mysqli_query($db, $profil_aendern);

      //Passwort änderung
      if (isset($_POST['password'])){
        $passwort = md5(mysqli_real_escape_string($db, $_POST['passwort']));
        $passwort_aendern = "UPDATE user SET password = '$password' WHERE id=" . $_SESSION['ID'];
        mysqli_query($db,$passwort_aendern);
      }
      //Benutzertyp änderung
      if (isset($_POST['usertype'])){
        $benutzertyp = mysqli_real_escape_string($db, $_POST['usertype']);
        $chusertype = "UPDATE user SET password = '$password', benutzer_typ = '$benutzertyp' WHERE id=" . $_SESSION['ID'];
        mysqli_query($db, $chusertype);
      }

      $_SESSION['success'] = "Profildaten wurden erfolgreich geändert";
      if ($_SESSION['benutzer']['benutzer_typ'] == 'Admin'){
        header('location: userverwaltung.php');
      }
      else {
        header('location: index.php');
      }

}
  ?>