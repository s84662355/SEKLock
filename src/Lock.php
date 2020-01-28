<?php
 
namespace SEKLock;
use SEKLock\Protocol;

class Lock {

    private $tcp_client;
    private $lock_name;
    private $lock_type=0;
    private $secretkey;

    const UPDATE=1;
    const SHARE=2;


    public function __construct($tcp_client,$lock_name,$secretkey = '')
    {
        $this->tcp_client = $tcp_client;
        $this->lock_name = $lock_name;
        $this->secretkey = $secretkey;
        
    }

    public function lock($type,$wait_time)
    {
        $data = [
           'do' => 'Lock',
           'LockName' => $this->lock_name,
           'lock_type' => $type,
           'WaitTime' => $wait_time,
           'secretkey' => $this->secretkey
        ];

        return $this->send($data);
    }

    public function getUpdateLock($wait_time)
    {
        return $this->lock(static::UPDATE,$wait_time);
    }

    public function getShareLock($wait_time)
    {
        return $this->lock(static::SHARE,$wait_time);  
    }

    public function unlock()
    {
        $data = [
           'do' => 'UnLock',
           'LockName' => $this->lock_name,
           'secretkey' => $this->secretkey
        ];

        return $this->send($data);
    }

    private function response(string $response)
    {
       // var_dump($response);
        $response = Protocol::decode($response );
       // var_dump($response);
        switch ($response['status']) {
            case 0:
                return true;
            case 8:
                return false;
            case 9:
                return false;       
            default:
                throw new LockException($response['data'],$response['status']);
                break;
        }
    }

    private function send($data)
    {
        $this->tcp_client->sendMessage(Protocol::encode($data));

        return $this->response($this->tcp_client->receiveMessage()); 
    }

 
     
}