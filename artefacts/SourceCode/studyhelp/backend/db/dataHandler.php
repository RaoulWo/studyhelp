<?php
session_start();


// Include Models
include("./models/friendRequest.php");
include ("./models/gameStatistics.php");
include("./models/gameResult.php");
include("./models/vocabPair.php");
include("./models/user.php");

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

    public function insertGameResultsIntoDatabase($points) {
        $dbConnection = $this->openUserConnection();
        if(!$dbConnection) { // if connection failed return null
            return "ERROR NO DB CONNECTION";
        }

        if (!isset($_SESSION["benutzer"])) {
            return "NO USER LOGGED IN";
        }
        
        $id = $_SESSION["benutzer"]["id"];
        $username = $_SESSION["benutzer"]["username"];

        $insertResultsStatement = "INSERT INTO gameresults (fk_user_id, punkte) VALUES ($id, $points)";
        $sqlQuery = $dbConnection->query($insertResultsStatement);
        
        $getLevelAndPoints = "SELECT level, punkte FROM user WHERE id = $id";
        $sqlQuery = $dbConnection->query($getLevelAndPoints);
        $result = $sqlQuery->fetch_assoc();

        $oldLvl = $result["level"];
        $oldPoints = $result["punkte"];


        $newPoints = $oldPoints + $points;
        $pointsRemaining = $newPoints % 1000;
        $levelsGained = intdiv($newPoints, 1000);
        $newLvl = $oldLvl + $levelsGained;

        $updateLevels = "UPDATE user SET level = $newLvl WHERE id = $id";
        $sqlQuery = $dbConnection->query($updateLevels);

        $updatePoints = "UPDATE user SET punkte = $pointsRemaining WHERE id = $id";
        $sqlQuery = $dbConnection->query($updatePoints);

        return new GameResult($username, $pointsRemaining, $newLvl);
    }

    public function queryGameStatisticsByUser() {
        // $result0 = array();
        // array_push($result0, new GameStatistics("A", "A", "A", "A", "A"));
        // return $result0;

        $dbConnection = $this->openUserConnection();

        if(!$dbConnection) { // if connection failed return null
            return null;
        }

        if (!isset($_SESSION["benutzer"])) {
            return null;
        }

        $id = $_SESSION["benutzer"]["id"];

        $result = array();

        $sqlStatement = "SELECT punkte, timestamp FROM gameresults WHERE fk_user_id = $id";
        $sqlQuery = $dbConnection->query($sqlStatement);
        while ($row = $sqlQuery->fetch_assoc()) {
            array_push($result, $this->convertToGameStatisticsObject($row));
        }

        return $result;
    }

    public function queryFriendRequests($status) {
        $dbConnection = $this->openUserConnection();
        if(!$dbConnection) { // if connection failed return null
            return "ERROR NO DB CONNECTION";
        }

        if (!isset($_SESSION["benutzer"])) {
            return "NO USER LOGGED IN";
        }
        
        $receiverId = $_SESSION["benutzer"]["id"];

        $result = array();

        $sqlStatement = "SELECT user_id_1, user_id_2, username, friends_since, user.level, MAX(gameresults.punkte) AS punkte
        FROM user 
        INNER JOIN freunde ON id = user_id_1 
        LEFT OUTER JOIN gameresults ON user_id_1 = fk_user_id WHERE
        user_id_2 = $receiverId AND freunde.status ='" .  $status . "' GROUP BY user_id_1";
        $sqlQuery = $dbConnection->query($sqlStatement);
        while ($row = $sqlQuery->fetch_assoc()) {
            array_push($result, $this->convertToFriendRequestObject($row));
        }
        return $result;
    }

    public function queryUsersByUsername($input) {
        $dbConnection = $this->openUserConnection();
        if(!$dbConnection) { // if connection failed return null
            return "ERROR NO DB CONNECTION";
        }

        if (!isset($_SESSION["benutzer"])) {
            return "NO USER LOGGED IN";
        }

        $userId = $_SESSION["benutzer"]["id"];
        $username = $_SESSION["benutzer"]["username"];

        $result = array();

        if ($input == "")
        {
            return;
        }

        $str = $input . "%";

        $sqlStatement = "SELECT DISTINCT id, username FROM user WHERE id != '" . $userId . "' AND username LIKE '" . $str . "'";
        $sqlQuery = $dbConnection->query($sqlStatement);
        while ($row = $sqlQuery->fetch_assoc()) {
            array_push($result, $this->convertToUserObject($row));
        }
        return $result;
    }
  
    public function updateFriendStatus($senderId) {
        $dbConnection = $this->openUserConnection();
        if(!$dbConnection) { // if connection failed return null
            return "ERROR NO DB CONNECTION";
        }

        if (!isset($_SESSION["benutzer"])) {
            return "NO USER LOGGED IN";
        }

        $receiverId = $_SESSION["benutzer"]["id"];

        $sqlStatement = "UPDATE freunde SET status = 'freunde' WHERE user_id_1 = $senderId AND user_id_2 = $receiverId OR
            user_id_1 = $receiverId AND user_id_2 = $senderId";
        $sqlQuery = $dbConnection->query($sqlStatement);
    }

    public function deleteFriendEntries($senderId) {
        $dbConnection = $this->openUserConnection();
        if(!$dbConnection) { // if connection failed return null
            return "ERROR NO DB CONNECTION";
        }

        if (!isset($_SESSION["benutzer"])) {
            return "NO USER LOGGED IN";
        }

        $receiverId = $_SESSION["benutzer"]["id"];

        $sqlStatement = "DELETE FROM freunde WHERE user_id_1 = $senderId AND user_id_2 = $receiverId OR
            user_id_1 = $receiverId AND user_id_2 = $senderId";
        $sqlQuery = $dbConnection->query($sqlStatement);
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

    private function convertToGameStatisticsObject($assoc) {
        $pointsGained = $assoc["punkte"];
        $timestamp = $assoc["timestamp"];

        return new GameStatistics($pointsGained, $timestamp);
    }

    private function convertToFriendRequestObject($assoc) {
        $senderId = $assoc["user_id_1"];
        $receiverId = $assoc["user_id_2"];
        $sender = $assoc["username"];
        $timestamp = $assoc["friends_since"];
        $level = $assoc["level"];
        $highscore = $assoc["punkte"];

        return new FriendRequest($senderId, $receiverId, $sender, $timestamp, $level, $highscore);
    }


    private function convertToUserObject($assoc)
    {
        $id = $assoc["id"];
        $username = $assoc["username"];

        return new User($id, $username);
    }
}

?>