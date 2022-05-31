<?php

class FriendRequest {
  public $senderId;
  public $receiverId;
  public $sender;
  public $timestamp;

  
  function __construct($senderId, $receiverId, $sender, $timestamp) {
    $this->senderId = $senderId;
    $this->receiverId = $receiverId;
    $this->sender = $sender;
    $this->timestamp = $timestamp;
  }
}

?>