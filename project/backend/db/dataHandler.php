<?php
session_start();


// Include Models
include("./models/gameResult.php");
include("./models/vocabPair.php");
include("./models/spanish.php");

// Definition of DataHandler-Class
class DataHandler
{
    // #### Public Methods ####
    public function queryRandomVocabByLanguage($language) {
        $dbConnection = $this->openVocabConnection();
        if(!$dbConnection) { // if connection failed return null
            return null;
        }
        // Switch-Case in order to determine table depending on language parameter
        $table = "";
        switch($language) {
            case "english":
                $table = "deutsch_englisch";
                break;
            case "spanish":
                $table = "deutsch_spanisch";
                break;
            case "french":
                $table = "deutsch_französisch";
                break;
            case "russian":
                $table = "deutsch_russisch";
                break;
            default:
                break;
        }

        // Performing SqlQuery and converting result into Array of VocabPair-objects
        $sqlStatement = "SELECT * FROM $table;";
        $sqlQuery = $dbConnection->query($sqlStatement);

        $vocabList = array();
        while ($row = $sqlQuery->fetch_assoc()) {
            array_push($vocabList, $this->convertToVocabPairObject($row, $language));
        }

        // Randomize the Array and then return 4 entries
        shuffle($vocabList);
        $result = array();
        for ($i = 0; $i < 4; $i++) {
            array_push($result, array_pop($vocabList));
        }
        return $result;
    }

    public function queryVocabList() {
        $res =  $this->getDemoData();
        return $res;
    }

    public function queryVocabById($id) {
        $result = array();
        foreach ($this->queryVocabList() as $val) { //Looping through every single entry in the DB until
            if ($val[0]->id == $id) {             // Word with the right id is found and pushed into array
                array_push($result, $val);
            }
        }
        return $result;
    }

    public function queryVocabByWord($word) {
        $result = array();
        foreach ($this->queryVocabList() as $val) { 
            if ($val[0]->spanish == $word || $val[0]->german == $word) {       
                array_push($result, $val);
            }
        }
        return $result;
    }

    public function insertGameResultsIntoDatabase($points) {
        $dbConnection = $this->openUserConnection();
        if(!$dbConnection) { // if connection failed return null

            return "ERROR NO DB CONNECTION";
        }

        if (!isset($_SESSION["benutzer"])) {
            return "NO USER LOGGED IN";
        }
        
        $id = $_SESSION["benutzer"]["id"];
        $pts = $points;
        $username = $_SESSION["benutzer"]["username"];

        $insertResultsStatement = "INSERT INTO gameresults (fk_user_id, punkte) VALUES ($id, $pts)";
        $sqlQuery = $dbConnection->query($insertResultsStatement);

        
        //$getLevelAndPoints = "SELECT level"



        return new GameResult($username, $pts);
    }


    // #### Private Methods ####
    private function openVocabConnection() { // returns false if connection failed, else returns mysqli-object
        require_once("db/config/dbaccess.php");
        $dbConnection = new mysqli($host, $user, $password, $database);
        if($dbConnection->connect_error) {
            return false;
        }
        return $dbConnection;
    }

    private function openUserConnection() { // returns false if connection failed, else returns mysqli-object
        require_once("db/config/dbaccess2.php");
        $dbConnection = new mysqli($host2, $user2, $password2, $database2);
        if($dbConnection->connect_error) {
            return false;
        }
        return $dbConnection;
    }

    private function convertToVocabPairObject($assoc, $language) {
        $id = $assoc["id"];
        $german = $assoc["Deutsch"];
        $other = "";
        switch($language) {
            case "english":
                $other = $assoc["Englisch"];
                break;
            case "spanish":
                $other = $assoc["Spanisch"];
                break;
            case "french":
                $other = $assoc["Französisch"];
                break;
            case "russian":
                $other = $assoc["Russisch"];
                break;
            default:
                break;
        }
        return new VocabPair($id, $german, $other);
    }

    private static function getDemoData() {
        $demodata = [
            [new Spanish(1, "Hola mundo!", "Hallo Welt!")],
        ];
        return $demodata;
    }
}

?>