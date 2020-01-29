<?php
require_once  dirname(__DIR__ ). '/vendor/autoload.php';
use  SEKLock\LockController;
 
$lock = new LockController([
	     'ip' => '127.0.0.1'  ,
     'port' =>   90 ,
     'secretkey' => 111111  ,
	]);

$lock_name="aaaaa";
$wait_time=10000;


if($lock->getShareLock($lock_name,$wait_time)){

 echo "dsadsada";
}else{
	echo "cvvcvcvc";
}

sleep(3);

$lock->unlock($lock_name);
	echo "1111111111";