<?php
 

namespace SEKLock;
use Exception;

class LockException  extends Exception{

    private $msg ;
    private $status;

    public function __construct($msg , $status)
    {
        $this->msg = $msg;
        $this->status = $status;
    }

    public function errorMessage()
    {
      //error message
      $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
      .': <b>'.$this->getMessage().'</b> is not a valid E-Mail address';
      return $errorMsg;
    }
}