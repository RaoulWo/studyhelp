<?php
  include_once('inc/usersystem.php');
  include_once('inc/errors.php');
  if (!(isset($_SESSION["benutzer"]))){
      $_SESSION["Fehler"] = "Sie müssen sich zuerst einloggen!";
      header("location: Fehler.php");
  }
    $statusMsg = '';

    // file upload path
    $targetDir = "inc/bilder/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    $db4 = mysqli_connect('localhost', 'root', '', 'user');
    $username = $_SESSION['benutzer']['username'];
    if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"]))
    {
    // allow certain file formats
    $allowTypes = array('JPG','PNG','JPEG','GIF','PDF','jpg', 'png', 'jpeg', 'gif', 'pdf');
    if(in_array($fileType, $allowTypes))
    {
    // upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath))
        {
    // insert image file name into database
            $insert = $db4->query("UPDATE user SET bild = '$fileName' WHERE username='$username'");
            if($insert)
            {
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }
            else
            {
                $statusMsg = "File upload failed, please try again.";
            } 
            }
            else
            {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
            }
            else
            {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
            }
            }
            else
            {
                $statusMsg = 'Please select a file to upload.';
            }
            header("location: account.php");

    // display status message
    //echo $statusMsg;

?>