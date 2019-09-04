<?php
namespace Common\Model;
use Common\Common\Model;
class CarModel extends Model {
    protected  $tablePrimary = 'Car_Id';
    protected  $objectClass = 'Common\Model\CarObject';
}