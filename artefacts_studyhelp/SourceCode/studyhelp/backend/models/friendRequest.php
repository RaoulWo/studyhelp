<?php

class FriendRequest {
  public $senderId;
  public $receiverId;
  public $sender;
  public $timestamp;
  public $level;
  public $highscore;

  
  function __construct($senderId, $receiverId, $sender, $timestamp, $level, $highscore) {
    $this->senderId = $senderId;
    $this->receiverId = $receiverId;
    $this->sender = $sender;
    $this->timestamp = $timestamp;
    $this->level = $level;
    $this->highscore = $highscore;
  }
}

?>