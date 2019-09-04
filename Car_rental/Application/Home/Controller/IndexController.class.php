<?php
namespace Home\Controller;
use Common\Model\AgeModel;
use Common\Model\CalculateDays;
use Common\Model\CalculatedDays;
use Think\Controller;
class IndexController extends Controller {
    /*
     *到对象里面取数据，记得要用小写。
     * */
    public function index(){
        echo "normall";
    }

    /*
     * 订单界面
     * */
      public  function ording(){
          if(empty($_SESSION)){$this->error("您还未登录,为您转到登录界面","/Login/Login");}
       /*获取用户的工厂*/
          $Mem = null;
          $MemFactory = D('Mem');
          $Mem = $MemFactory->fetch($_SESSION['Mem']);
          $this->assign("Mem",$Mem);
          /*获取从carlist传过来ID从而获取车的工厂*/
          $Car = NULL;
          $CarPrice =[];
          $CarFactory = D('Car');
          $Car = $CarFactory->fetch($_GET['car_id']);
          $Car_priOne = $_SESSION['orderDays'] * $Car->car_price;
          $Car_Total = $Car_priOne + 40*$_SESSION['orderDays'] +35;
          $CarPrice['$Car_priOne'] = $Car_priOne;
          $CarPrice['$Car_Total'] = $Car_Total;
          $CarPrice['$Car_baoXian'] =  40*$_SESSION['orderDays'];
          $this->assign("Car",$Car);
          $this->assign("CarPrice",$CarPrice);
          $this->display('ording');
      }

    /*
     * 订单成功界面
     * */
     public function  ordersuccess(){

         if(empty($_SESSION)){$this->error("您还未登录,为您转到登录界面","/Login/Login");}
         $Mem = null;
         $MemFactory = D('Mem');
         $Mem = $MemFactory->fetch($_SESSION['Mem']);
         $this->assign("Mem",$Mem);

         /*获取从carlist传过来ID从而获取车的工厂*/

         $Car = NULL;
         $CarPrice =[];
         $CarFactory = D('Car');
         $Car = $CarFactory->fetch($_GET['car_id']);
         $Car_priOne = $_SESSION['orderDays'] * $Car->car_price;
         $Car_Total = $Car_priOne + 40*$_SESSION['orderDays'] +35;
         $CarPrice['$Car_priOne'] = $Car_priOne;
         $CarPrice['$Car_Total'] = $Car_Total;
         $CarPrice['$Car_baoXian'] =  40*$_SESSION['orderDays'];

         /*封装准备传入（订单详情）数据库的数据*/
         $data[] = null;
         $data['Order_Num'] = (int)microtime(true).$_SESSION["Mem"];
         $data['Order_CreTime'] =  date('Y-m-d H:00 ',time());
         $data['Order_FetchTime'] =  $_SESSION['fetchTime'];
         $data['Order_BackTime'] = $_SESSION['backTime'];
         $data['Order_FetchHour'] = $_SESSION['fetchHour'];
         $data['Order_BackHour'] = $_SESSION['backHour'];
         $data['Order_FetchPlace'] = $_SESSION['fetchPlace'];
         $data['Order_BackPlace'] = $_SESSION['backPlace'];
         $data['Order_Total'] = $Car_Total;
         $data['Car_Id'] = $_GET['car_id'];
         $data['Mem_Id'] = $_SESSION['Mem'];
         $data['Order_Status'] =1;
         $data['Order_Days'] = $_SESSION['orderDays'];
         $OrderFactor = D('Order');
         $Order = $OrderFactor->insertData($data);
         /*封装结束*/
         $this->assign("Car",$Car);
         $this->assign("data",$data);
         $this->display('ordersuccess');
     }
    /*
     * 订单详情界面
     * */
    public function  orderDetails(){

        if(empty($_SESSION)){$this->error("您还未登录,为您转到登录界面","/Login/Login");}
      /*会员用户工厂模式*/
        $Mem = null;
        $MemFactory = D('Mem');
        $Mem = $MemFactory->fetch($_SESSION['Mem']);
        $this->assign("Mem",$Mem);

     /*订单工厂模式*/

        $Order = null;
        $OrderFactory = D('Order');
        $Order = $OrderFactory->fetch($_GET['order_id']);
        $this->assign("Order",$Order);


     /*车工厂实例化*/
        $Car = NULL;
        $CarFactory = D('Car');
        $Car = $CarFactory->fetch($Order->car_id);
        $this->assign("Car",$Car);
                     /*计算价格*/
        $CarPrice= [];
        $CarPrice['Car_priOne'] = $Order->order_days * $Car->car_price;
        $CarPrice['Car_baoXian'] =  40*$Order->order_days;
        $this->assign("CarPrice",$CarPrice);

        $this->display('orderDetails');
    }
    public function  order_cancel(){
        $OrderFactory = M('Order');
        $Order_Num = $_GET['Order_Num'];
        $data['Order_Status'] = 0;
        $OrderFactory->where('Order_Num='.$Order_Num)->save($data);
        $this->success('该订单已取消，将为您跳转选车页面','/IfoPage/IfoPage#IfoOrdCan');

    }
}

