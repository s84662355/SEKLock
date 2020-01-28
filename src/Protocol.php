<?php

namespace SEKLock;

class Protocol{


	public static function encode($data)
	{
      foreach ($data as $key => &$value) {
           $value = "{$key}:$value";
      }

      return implode('|', $data);
	}

 
    public static function  decode ($response)
    {
         $response = explode('|', $response);
         foreach ($response as $key => $value) {
              $value = explode(':', $value);
              $response[$value[0]] = $value[1];
              unset($response[$key]);
         }
         return $response;
    }
    
     
     
}