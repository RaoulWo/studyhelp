<?php
// Include DataHandler-Class
include("db/dataHandler.php");

// Definition of Logic-Class
class Logic 
{
    // #### Private Attributes ####
    private $dh;
    // #### Constructor ####
    function __construct() {
        $this->dh = new DataHandler();
    }
    // #### Public Methods ####
    function handleRequest($method, $param) {
        switch ($method) {
            // **** Insert RequestMethods here ****
            case "queryRandomVocabByLanguage":
                $res = $this->dh->queryRandomVocabByLanguage($param);
                break;
            case "insertGameResultsIntoDatabase":
                $res = $this->dh->insertGameResultsIntoDatabase($param);
                break;
            case "queryGameStatisticsByUser":
                $res = $this->dh->queryGameStatisticsByUser();
                break;
            case "queryFriendRequests":
                $res = $this->dh->queryFriendRequests($param);
                break;
            case "queryUsersByUsername":
                $res = $this->dh->queryUsersByUsername($param);
                break;
            case "updateFriendStatus":
                $res = $this->dh->updateFriendStatus($param);
                break;
            case "deleteFriendEntries":
                $res = $this->dh->deleteFriendEntries($param);
                break;
            default:
                $res = null;
                break;
        }
        return $res;
    }
}

?>