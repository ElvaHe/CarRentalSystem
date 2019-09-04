<?php
namespace Common\Model;
use Common\Common\Model;
class CardModel extends Model {
    protected  $tablePrimary = 'Card_Coding';
    protected  $objectClass = 'Common\Model\CardObject';
}