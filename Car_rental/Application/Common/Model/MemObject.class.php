<?php
namespace Common\Model;
use Common\Common\Object;
class MemObject extends Object {
    /*这边取表中的数据注意要用小写*/
    public function  checkpsw($key){

        return $key == $this->data['password'];
    }
    public  function  getAge(){
    return date('Y')- date("Y",strtotime($this->data['mem_birthday']));
}
}