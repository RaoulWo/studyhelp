<?php 
session_start();
$db = mysqli_connect('localhost', 'access2', 'itp', 'user');

if(isset($_POST["friend"])){
    addFriend($db);
}
else{
    header("location: ../frontend/freunde.php");
}

function addFriend($db){
    $user2_name = mysqli_real_escape_string($db, $_POST['friend']);
    $user1_id = $_SESSION['benutzer']['id'];
    $user2_id_query = "SELECT id FROM user WHERE username='" . $user2_name . "'";
    if($db->query($user2_id_query) === false || !isset(mysqli_fetch_assoc($db->query($user2_id_query))['id'])){
        $_SESSION["fq_succ"] = "<script>alert('User wurde nicht gefunden!');</script>";
        header("location: ../frontend/freunde.php");
    }
    else{
        $user2_id = $db->query($user2_id_query);
    }
    $user2_id = mysqli_fetch_assoc($user2_id)['id'];
    $sendrequest_query = "INSERT INTO freunde (user_id_1, user_id_2) VALUES ($user1_id, $user2_id)";
    $result = $db->query($sendrequest_query);
    if ($result === false){
        $_SESSION["fq_succ"] = "<script>alert('Es ist ein Fehler bei Ihrer Freundschaftsanfrage aufgetreten!');</script>";
    }
    else{
        $_SESSION["fq_succ"] = "<script>alert('Freundschaftsanfrage wurde erfolgteich verschickt!');</script>";
    }
    header("location: ../frontend/freunde.php");
}

?>
