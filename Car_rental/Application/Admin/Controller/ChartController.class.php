<?php
namespace Admin\Controller;
use Think\Controller;
class ChartController extends Controller {
    public function ChartMoney(){
//        $OrderFactory = D('Order');
//        $price = $OrderFactory->quarterPrice(2016,"第二季度");
//        echo $price ['Two'];
//        $count = 1;
//        $data= [];
//        foreach ($price as $value){
//            $data[$count] =$value;
//            $count++;
//        }
//        print_r($data);
 //     print_r($data);
        $this->display('ChartMoney');
    }
    public function  ChartMoney_action(){
        $OrderFactory = D('Order');
        $data = [];
        $price= [];
        $data['chart_year'] = substr($_POST['chart_year'],0,4);
        $data['chart_quarter'] = $_POST['chart_quarter'];
        $price = $OrderFactory->quarterPrice($data['chart_year'],$data['chart_quarter']);
        $data['one'] = $price ['One'];
        $data['two'] = $price ['Two'];
        $data['three'] = $price ['Three'];
        $data['all'] = $price ['All'];
        $data['success'] = 1;

        echo json_encode($data);
    }
}