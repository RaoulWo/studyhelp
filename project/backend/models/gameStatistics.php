<?php

class GameStatistics {
  public $pointsGained;
  public $timestamp;

  function __construct($ptsGainedFromGame, $timestamp) {
    $this->pointsGained = $ptsGainedFromGame;
    $this->timestamp = $timestamp;
  }
}

?>