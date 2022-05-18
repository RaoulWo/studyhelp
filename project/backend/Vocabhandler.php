<?php

if (!(isset($_SESSION['benutzer']['benutzer_typ'])) || $_SESSION['benutzer']['benutzer_typ'] != 'Admin') {
    $_SESSION['Fehler'] = 'Sie haben hier nichts verloren!';
    header("location: Fehler.php");
  }


echo "<a href='Vocabhandler.html'>Return to Vocab Handler</a>  <br><br> <h1>Log: </h1>";

$table = "deutsch_" . $_POST['lang2'];       //Constructing name of the table to see which Database to insert into
$target_dir = "uploads/";  
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); //Path to file that is being uploaded
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (file_exists($target_file)) {
    echo "Sorry, there already exists a file with this name in the Database. Please rename your file or contact an Admin if you think this is an error<br>";
    $uploadOk = 0;
  }

if ($fileType != "csv") {
        echo "Sorry, only CSV files are allowed.<br>";
        $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.<br>";} 
else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {      
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has successfully been uploaded.<br><br>";
      openVocabList($target_file, $table);
    }
     else {
         echo "Sorry, there was an error uploading your file.<br>";
    }
}

function openVocabList($path, $table)
{
    try {
        $fileName = $path;

        if (!file_exists($fileName)) {
            throw new Exception('File not found.');            //Try to open file throw error if failed
        }

        $fp = fopen($fileName, "rb");
        if (!$fp) {
            throw new Exception('File open failed.');
        }

        database($fp, $table, "Deutsch", $_POST['lang2']);

        fclose($fp);
    } catch (Exception $e) {
        echo $e->getMessage();        //Print error
    }
}

function database($fp, $table, $lang1, $lang2)
{
    $db = new mysqli('localhost', 'root', '', 'vokabeln');  //Setting up DB Connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    echo "Connected successfully <br>";


    while (($row = fgetcsv($fp, 250, ",")) !== FALSE) {     //looping though every Voacbulary in the list
        $col1 = $db->real_escape_string($row[0]);                                    //lang1 Word
        $col2 = $db->real_escape_string($row[1]);                                  //lang2 Word
        if(isset($row[3])){
            echo "Error! There can only be 2 columns. Please contact an Admin if you don't know how to resolve this error!";
            return;
        }

        $check1 = "SELECT * FROM " . $table . " WHERE " . $lang1 . " = '$col1'";  //Checking in Database if the word already is in list in either language to avoid redundancies
        $result1 = mysqli_query($db, $check1);
        $check2 = "SELECT * FROM " . $table . " WHERE " . $lang1 . " = '$col2'";
        $result2 = mysqli_query($db, $check2);

        if (mysqli_num_rows($result1) === 0 && mysqli_num_rows($result2) === 0) {      //If the word is not in list, in neither language, it is being added to database
            $sql = "INSERT INTO " . $table . " (" . $lang1 . "," . $lang2 . ")
            VALUES ('$col1', '$col2')";

            if ($db->query($sql) === TRUE) {
                echo "New record created successfully <br>";
            } else {
                echo "Error: " . $sql . "<br>" . $db->error;
            }
        }

        else {
            echo "Entry is already already in Vocab List. Contact an Admin for more Information on this error!<br>";
        }
    }

    $db->close();
}

function findCell($row, $col, $fp)
{  //Use this function to find specific cell in Vocab List
    $row = 1;
    $mycsvfile = array(); //define the main array.
    while (($data = fgetcsv($fp, 250, ",")) !== FALSE) {   //if csv file was not written in excel, change seperator to ","
        $num = count($data);
        $row++;
        $mycsvfile[] = $data; //add the row to the main array.
    }
}