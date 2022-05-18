<?php

class GameResult {
  public $username;
  public $points;
  public $level;
  public $timestamp;

  function __construct($user, $pts, $lvl, $timestamp) {
    $this->username = $user;
    $this->points = $pts;
    $this->level = $lvl;
    $this->timestamp = $timestamp;
  }
}

?>