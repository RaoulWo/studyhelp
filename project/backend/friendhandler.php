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
    echo $user2_id_query;
    mysqli_fetch_assoc($user2_id);
}

?>
