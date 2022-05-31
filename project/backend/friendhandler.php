<?php 
session_start();
$db = mysqli_connect('localhost', 'access2', 'itp', 'user');

if(isset($_POST["friend"])){
    addFriend($db);
}
else{
    echo "fail!";
}

function addFriend($db){
    $user2_name = mysqli_real_escape_string($db, $_POST['friend']);
    $user1_id = $_SESSION['benutzer']['id'];
    $user2_id_query = "SELECT id FROM user WHERE username='" . $user2_name . "'";
    $user2_id = mysqli_query($db, $user2_id_query);
    $user2_id = mysqli_fetch_assoc($user2_id)['id'];
    $sendrequest_query = "INSERT INTO freunde (user_id_1, user_id_2) VALUES ($user1_id, $user2_id)";
    $result = mysqli_query($db, $sendrequest_query);
    echo "<script>alert(test);</script>";
    header("location: ../frontend/freunde.php");
}

?>
