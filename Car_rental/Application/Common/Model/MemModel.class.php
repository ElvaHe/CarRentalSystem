<?php
namespace Common\Model;
use Common\Common\Model;
class MemModel extends Model {
    protected  $tablePrimary = 'Mem_Id';
    protected  $UserName = 'UserName';
    protected  $objectClass = 'Common\Model\MemObject';
    public function fetchByUsername($key){
        $result = $this->where([$this->UserName=> $key])->find();
        if($result == null) return null;
        else return new MemObject($result);
    }
    
}