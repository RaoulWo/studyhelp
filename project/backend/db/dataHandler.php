<?php
// Include Models
include("./models/spanish.php");

// Definition of DataHandler-Class
class DataHandler
{
    // #### Public Methods ####
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

    // DemoData
    private static function getDemoData() {
        $demodata = [
            [new Spanish(1, "Hola mundo!", "Hallo Welt!")],
        ];
        return $demodata;
    }
}

?>