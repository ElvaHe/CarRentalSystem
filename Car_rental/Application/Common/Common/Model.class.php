<?php
namespace Common\Common;
abstract class Model extends \Think\Model{
    protected $objectClass;
   
    public function  fetch($key){
        $data = $this->where([$this->tablePrimary => $key])->find();
        $className = $this->objectClass;
        return new $className($data);
}
}