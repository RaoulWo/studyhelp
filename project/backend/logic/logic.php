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
            case "queryVocabList":
                $res = $this->dh->queryVocabList();
                break;
            case "queryVocabById":
                $res = $this->dh->queryVocabById($param);
                break;
            case "queryVocabByWord":
                $res = $this->dh->queryVocabByWord($param);
            default:
                $res = null;
                break;
        }
        return $res;
    }
}

?>