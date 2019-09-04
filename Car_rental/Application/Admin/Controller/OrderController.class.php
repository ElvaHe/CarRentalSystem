<?php
namespace Admin\Controller;
use Think\Controller;
class OrderController extends Controller {

   /*g可以显示所有订单信息的页面*/
    public function OrderPage(){
        $OrderFactory = M('Order');
        /*计算各订单状态的订单数量*/
        if($_GET['Sort']==null) {
            $count = null;
            $count[0] = $OrderFactory->query("select count(*) from table_order where Order_Status='0'");
            $count[1] = $OrderFactory->query("select count(*) from table_order where Order_Status='1'");
            $count[2] = $OrderFactory->query("select count(*) from table_order where Order_Status='2'");
            $count[3] = $OrderFactory->query("select count(*) from table_order where Order_Status='3'");
            $count[4] = $OrderFactory->query("select count(*) from table_order ");
            $temp = 0;
            foreach ($count as $val1)
                foreach ($val1 as $val2)
                    foreach ($val2 as $key) {
                        $ordercount[$temp] = $key;
                        $temp++;
                    };
            $count_pageAll = ceil($ordercount[4] / 7);/*计算总页数*/
            $pageAll = isset($_GET['pageAll']) ? $_GET['pageAll'] : 1;/*判断$_GET['page']是否存在，如果存在复制给$page，不存在将1赋值给它，并再次赋值给$page*/
            $startAll = 7 * ((int)$pageAll - 1);/*通过页数计算出要从第几个数据开始读取*/
            $Order = $OrderFactory->table('table_order  as  a')->join('table_mem  as  b  on  b.Mem_Id = a.Mem_Id')->limit($startAll, 7)->select();
            $PageAll['page'] = $pageAll;
            $PageAll['count_page'] = $count_pageAll;

        }
        if($_GET['Sort']=='会员用户名'){

            $Mem_Name =$_GET['Mem_Name'];
            $_GET['Mem_Name']=$Mem_Name;
            $temp = $OrderFactory->table('table_order  as  a')->join('table_mem  as  b  on  b.Mem_Id = a.Mem_Id')->where("Mem_Name='$Mem_Name'")->select();
            $count = 0;
            foreach ($temp as $value)
                $count++;
            $count_pageAll = ceil($count/7);/*计算总页数*/
            $pageAll = isset($_GET['pageAll'])?$_GET['pageAll']:1;/*判断$_GET['page']是否存在，如果存在复制给$page，不存在将1赋值给它，并再次赋值给$page*/
            $startAll = 7*((int)$pageAll-1);/*通过页数计算出要从第几个数据开始读取*/
            $Order =$OrderFactory->table('table_order  as  a')->join('table_mem  as  b  on  b.Mem_Id = a.Mem_Id')->where("Mem_Name='$Mem_Name'")->limit($startAll,7)->select();
            $PageAll['page']= $pageAll;
            $PageAll['count_page'] = $count_pageAll;
        }
        /*分页结束*/
        $this->assign('PageAll', $PageAll);
        $this->assign('Order',$Order);
        $this->display('orderPage');
    }


    /*查看订单的处理页面，通过传订单ID来判断*/
    public function OrderPage_action(){
        $OrderFactory = M('Order');
        $order_num = $_POST['order_num'];
        $Order = $OrderFactory->table('table_order  as  a')->join('table_car  as  b  on  b.Car_Id = a.Car_Id')->
                  where("Order_Num='$order_num'")->find();
        echo json_encode($Order);
    }

    /*订单界面查询事件的处理页面（查询订单用户AJAX过来查询且返回的界面）*/
    public function  OrderSearch_action(){
        $OrderFactory = M('Order');
        /*通过订单编号的查询*/
        if($_POST['reg']=='订单编号'){
            $Order_Num = $_POST['searchCon'];
            $Order = $OrderFactory->table('table_order  as  a')->join('table_mem  as  b  on  b.Mem_Id = a.Mem_Id')->where("Order_Num='$Order_Num'")->find();
            if($Order == null)
                $Order['success'] = 0;
            else {
                $Order['success'] = 1;
                echo json_encode($Order);
            }
        }

    }

       /*查询会员用户的时候跳转的页面*/
    public function Mem_search(){
         $OrderFactory = M('Order');
         $Mem_Name =$_GET['Mem_Name'];
         $temp = $OrderFactory->table('table_order  as  a')->join('table_mem  as  b  on  b.Mem_Id = a.Mem_Id')->where("Mem_Name='$Mem_Name'")->select();
         $count = 0;
        foreach ($temp as $value)
            $count++;
        /*分页*/
        $count_pageAll = ceil($count/7);/*计算总页数*/
        $pageAll = isset($_GET['pageAll'])?$_GET['pageAll']:1;/*判断$_GET['page']是否存在，如果存在复制给$page，不存在将1赋值给它，并再次赋值给$page*/
        $startAll = 7*((int)$pageAll-1);/*通过页数计算出要从第几个数据开始读取*/
        $Order =$OrderFactory->table('table_order  as  a')->join('table_mem  as  b  on  b.Mem_Id = a.Mem_Id')->where("Mem_Name='$Mem_Name'")->limit($startAll,7)->select();
        $PageAll['page']= $pageAll;
        $PageAll['count_page'] = $count_pageAll;
        $this->assign('PageAll',$PageAll);
        $this->assign('Order',$Order);
        $this->display('orderPage');
    }

    /*订单操作的页面*/
    public function OrderManage(){

        if($_GET['Order_Num']==null)
            $this->error("请先获取您要操作的订单","/Order/OrderPage");
        else{
        $OrderFactory = M('Order');
        $Order_Num =$_GET['Order_Num'] ;
        $Mem =$OrderFactory->table('table_order  as  a')->join('table_mem  as  b  on  b.Mem_Id = a.Mem_Id')->where("Order_Num='$Order_Num'")->find();
        $Car =$OrderFactory->table('table_order  as  a')->join('table_car  as  b  on  b.Car_Id = a.Car_Id')->where("Order_Num='$Order_Num'")->find();
        $this->assign('Mem',$Mem);
        $this->assign("Car",$Car);
        $this->display('orderManage');
        }
    }

    /*修改订单信息的主页面*/
    public function orderModify(){
        if($_GET['Order_Num']==null)
            $this->error("请先获取您要修改的订单","/Order/OrderPage");
        else {
            $OrderFactory = M('Order');
            $Order_Num = $_GET['Order_Num'];
            $Car = $OrderFactory->table('table_order  as  a')->join('table_car  as  b  on  b.Car_Id = a.Car_Id')->where("Order_Num='$Order_Num'")->find();
            $this->assign("Car", $Car);
            $this->display('orderModify');
        }
    }
    /*确认修改的action处理页面*/
    public function orderModify_action(){
         $OrderFactory = M("Order");
         $data =[];
         $data =$_POST;
         $Order_Num = $_POST['Order_Num'];
         $OrderFactory->where("Order_Num=$Order_Num")->save($data);
//            $Mem =$OrderFactory->table('table_order  as  a')->join('table_mem  as  b  on  b.Mem_Id = a.Mem_Id')->where("Order_Num='$Order_Num'")->find();
//            $Car =$OrderFactory->table('table_order  as  a')->join('table_car  as  b  on  b.Car_Id = a.Car_Id')->where("Order_Num='$Order_Num'")->find();
//            $this->assign('Mem',$Mem);
//            $this->assign("Car",$Car);
//            $this->redirect('/OrderManage', $arr['Order_Num'] = $Order_Num,5, '页面跳转中...');
//            $this->success("订单修改成功，返回操作界面",U('/OrderManage',array('Order_Num'=>$Order_Num)));
        $this->success("订单修改成功，返回操作界面",'/Order/OrderManage?Order_Num='.$Order_Num.'&'.time());
    }
    /*将取消的订单恢复的处理界面*/
    public function orderrecovery_action(){
        $OrderFactory = M("Order");
        $Order_Num =$_GET['Order_Num'];
        $data['Order_Status'] =1;
        $OrderFactory->where("Order_Num=$Order_Num")->save($data);
        $this->success("订单已恢复，将返回操作界面",U('/OrderManage',array('Order_Num'=>$Order_Num)));
    }
    /*将预定成功的订单取消*/
    public function  orderCancel_action(){
        $OrderFactory = M("Order");
        $Order_Num =$_GET['Order_Num'];
        $data['Order_Status'] =0;
        $OrderFactory->where("Order_Num=$Order_Num")->save($data);
        $this->success("订单已取消，将返回操作界面",U('/OrderManage',array('Order_Num'=>$Order_Num)));
    }
    /*支付订单的action处理界面*/
    public function  orderPay_action(){
        $OrderFactory = M("Order");
        $Order_Status = $_GET['order_status'];
        $Order_Num =$_GET['Order_Num'];
        $data['Order_Status'] =2;
        $OrderFactory->where("Order_Num=$Order_Num")->save($data);
        $this->success("已支付成功，将返回操作界面",U('/OrderManage',array('Order_Num'=>$Order_Num)));
    }
}