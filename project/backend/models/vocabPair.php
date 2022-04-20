<?php

// Definition of VocabPair-class
class VocabPair {
  // #### Public Attributes ####
  public $id;
  public $german;
  public $other;

  // #### Constructor ####
  function __construct($id, $german, $other) {
    $this->id = $id;
    $this->german = $german;
    $this->other = $other;
  }
}

?>