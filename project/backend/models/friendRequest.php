<?php

class FriendRequest {
  public $sender;
  public $timestamp;

  
  function __construct($sender, $timestamp) {
    $this->sender = $sender;
    $this->timestamp = $timestamp;
  }
}

?>