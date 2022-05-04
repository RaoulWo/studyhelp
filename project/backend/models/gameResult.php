<?php

class GameResult {
  public $username;
  public $points;

  function __construct($user, $pts) {
    $this->username = $user;
    $this->points = $pts;
  }
}

?>