<?php
include("db/dataHandler.php");

class SimpleLogic
{
    private $dh;
    function __construct()
    {
        $this->dh = new DataHandler();
    }

    function handleRequest($method, $param)
    {
        switch ($method) {
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
