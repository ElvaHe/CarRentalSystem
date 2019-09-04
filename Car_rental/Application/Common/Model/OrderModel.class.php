<?php
namespace Common\Model;
use Common\Common\Model;
class OrderModel extends Model {
    protected  $tablePrimary = 'Order_Num';
    protected  $objectClass = 'Common\Model\OrderObject';
    /*
     * @param int $
     * */
    public function RunningOrder($Mem_ID,$Order_Status){
        $data = $this->where('Order_Status=1 AND Mem_ID="1"')->select();
        return $data;
    }
    public function quarterPrice($Year,$quarter){
        $count =0;
        $data =[];
        $Order = $this->where('Order_Status=3')->select();
        foreach ($Order as $value) {
            $data[$count]['Year']  =  substr($value['order_cretime'], 0, 4);
            $data[$count]['Month'] =  substr($value['order_cretime'], 5, 2);
            $data[$count]['Order_Num'] = $value['order_num'];
            $count++;
        }
//  

        $price['One'] = 0;
        $price['Two'] = 0;
        $price['Three'] = 0;
        $price['All'] = 0;
        /*判断第四季度开始*/
        if($quarter == '第四季度') {
            foreach ($data as $key) {
                if ($key['Year'] == $Year) {
                    if ($key['Month'] == 10) {
                        $price['One'] = $price['One'] + $this->where('Order_Num='.$key['Order_Num'])->select()[0]['order_total'];
                        $price['All'] = $price['All'] + $this->where('Order_Num='.$key['Order_Num'])->select()[0]['order_total'];
                    }
                    if ($key['Month'] == 11) {
                          $price['Two'] = $price['Two'] +  $this->where('Order_Num='.$key['Order_Num'])->select()[0]['order_total'];
                        $price['All'] = $price['All'] + $this->where('Order_Num='.$key['Order_Num'])->select()[0]['order_total'];
                    }
                    if ($key['Month'] == 12) {
                          $price['Three'] = $price['Three'] + $this->where('Order_Num='.$key['Order_Num'])->select()[0]['order_total'];
                         $price['All'] = $price['All'] +  $this->where('Order_Num='.$key['Order_Num'])->select()[0]['order_total'];
                    }
                }
           }
                 return $price;
        }
        /*判断第四季度结束*/
        if($quarter == '第一季度') {
            foreach ($data as $key) {
                if ($key['Year'] == $Year) {
                    if ($key['Month'] == 1) {
                        $price['One'] = $price['One'] + $this->where('Order_Num='.$key['Order_Num'])->select()[0]['order_total'];
                        $price['All'] = $price['All'] + $this->where('Order_Num='.$key['Order_Num'])->select()[0]['order_total'];
                    }
                    if ($key['Month'] == 2) {
                        $price['Two'] = $price['Two'] +  $this->where('Order_Num='.$key['Order_Num'])->select()[0]['order_total'];
                        $price['All'] = $price['All'] + $this->where('Order_Num='.$key['Order_Num'])->select()[0]['order_total'];
                    }
                    if ($key['Month'] == 3) {
                        $price['Three'] = $price['Three'] + $this->where('Order_Num='.$key['Order_Num'])->select()[0]['order_total'];
                        $price['All'] = $price['All'] +  $this->where('Order_Num='.$key['Order_Num'])->select()[0]['order_total'];
                    }
                }
            }
            return $price;
        }
        /*判断第一季度结束*/
        /*判断第二季度开始*/
        if($quarter == '第二季度') {
            foreach ($data as $key) {
                if ($key['Year'] == $Year) {
                    if ($key['Month'] ==4) {
                        $price['One'] = $price['One'] + $this->where('Order_Num='.$key['Order_Num'])->select()[0]['order_total'];
                        $price['All'] = $price['All'] + $this->where('Order_Num='.$key['Order_Num'])->select()[0]['order_total'];
                    }
                    if ($key['Month'] ==5) {
                        $price['Two'] = $price['Two'] +  $this->where('Order_Num='.$key['Order_Num'])->select()[0]['order_total'];
                        $price['All'] = $price['All'] + $this->where('Order_Num='.$key['Order_Num'])->select()[0]['order_total'];
                    }
                    if ($key['Month'] ==6) {
                        $price['Three'] = $price['Three'] + $this->where('Order_Num='.$key['Order_Num'])->select()[0]['order_total'];
                        $price['All'] = $price['All'] +  $this->where('Order_Num='.$key['Order_Num'])->select()[0]['order_total'];
                    }
                }
            }
            return $price;
        }
        /*判断第二季度结束*/
        /*判断第三季度开始*/
        if($quarter == '第三季度') {
            foreach ($data as $key) {
                if ($key['Year'] == $Year) {
                    if ($key['Month'] ==7) {
                        $price['One'] = $price['One'] + $this->where('Order_Num='+$key['Order_Num']+'')->select()[0]['order_total'];
                        $price['All'] = $price['All'] + $this->where('Order_Num='+$key['Order_Num']+'')->select()[0]['order_total'];
                    }
                    if ($key['Month'] ==8) {
                        $price['Two'] = $price['Two'] +  $this->where('Order_Num='+$key['Order_Num']+'')->select()[0]['order_total'];
                        $price['All'] = $price['All'] + $this->where('Order_Num='+$key['Order_Num']+'')->select()[0]['order_total'];
                    }
                    if ($key['Month'] == 9) {
                        $price['Three'] = $price['Three'] + $this->where('Order_Num='+$key['Order_Num']+'')->select()[0]['order_total'];
                        $price['All'] = $price['All'] +  $this->where('Order_Num='+$key['Order_Num']+'')->select()[0]['order_total'];
                    }
                }
            }
            return $price;
        }
        /*判断第三季度结束*/


    }


    public function  insertData($data){
        $this->data($data)->add();
    }
}