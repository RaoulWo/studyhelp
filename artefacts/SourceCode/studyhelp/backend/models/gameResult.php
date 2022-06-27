<?php

class GameResult {
  public $username;
  public $points;
  public $level;
  
  function __construct($user, $pts, $lvl) {
    $this->username = $user;
    $this->points = $pts;
    $this->level = $lvl;
  }
}

?>