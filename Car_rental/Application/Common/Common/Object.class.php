<?php
namespace Common\Common;
 abstract class Object{
     
     protected $data = [];

     public function  __construct(array $data){
         $this->data = $data;
     }
     public function __get($name){
//            $method = '__get'.name;
//            if(method_exits($this,$method))
//                return call_user_func([$this,$method]);
//            $name = strtolower($name);
//            if(isset($this->data))
         return $this->data[$name];
//            die('属性不存在，程序错误');
     }

     public function  __set($name, $value){
         $name = strtolower($name);
         return $this->data[$name] = $value;
     }



 }