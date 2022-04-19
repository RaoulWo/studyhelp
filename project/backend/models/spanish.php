<?php
class Spanish {
    public $id;
    public $spanish;
    public $german;

    function __construct($id, $spanish, $german) {
        $this->id = $id;
        $this->spanish = $spanish;
        $this->german = $german;
      }
}
