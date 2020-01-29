<?php
namespace SEKLock;
use Exception;
class LockController{

    private $tcp_client;
    private $config;
    private $lock_arr = [];
    

    public function __construct($config)
    { 
       $this->tcp_client = new  SocketClient($config['ip'], $config['port'], SOL_TCP,3);
       $this->config = $config;
       $this->tcp_client->connect() ;

       if(!$this->tcp_client->receiveMessage()){
                $this->tcp_client->close();
                throw new Exception("连接过多", 1);
       }
       
    }

    public function lock($lock_name,$type,$wait_time)
    {
        if(empty($this->lock_arr[$lock_name])){
            $this->lock_arr[$lock_name] = new Lock($this->tcp_client,$lock_name,empty($this->config['secretkey']) ? '' :  $this->config['secretkey'] );
        }

        switch ($type) {
            case 1:
                return $this->lock_arr[$lock_name]->getUpdateLock($wait_time);
                break;
            case 2:
                return $this->lock_arr[$lock_name]-> getShareLock($wait_time);
                break;      
         
        }
    }

    public function getUpdateLock($lock_name,$wait_time)
    {
       return  $this-> lock($lock_name,Lock::UPDATE,$wait_time);
    }

    public function getShareLock($lock_name,$wait_time)
    {
        return $this-> lock($lock_name,Lock::SHARE,$wait_time);
    }

    public function unlock($lock_name)
    {
         return  $this->lock_arr[$lock_name] ->  unlock();
    }

    public function __destruct() 
    {
       $this->tcp_client->close();
    }
     
}