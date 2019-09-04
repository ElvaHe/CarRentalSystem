<?php
namespace Home\Controller;
use Common\Model\AgeModel;
use Common\Model\CalculateDays;
use Common\Model\CalculatedDays;
use Think\Controller;
class IfoPageController extends Controller {
    public  function  IfoPage(){
      $OrderFactory = M('Order');
      /*判断session里面Mem是否为空，绝对要不要返回登录界面*/
     //  if(empty($_SESSION)){$this->error("您还未登录,为您转到登录界面","/Login/Login");}
      /*计算各订单状态的订单数量*/
      $count =null;
      $count[0] = $OrderFactory->query("select count(*) from table_order where Order_Status='0'");
      $count[1] = $OrderFactory->query("select count(*) from table_order where Order_Status='1'");
      $count[2] = $OrderFactory->query("select count(*) from table_order where Order_Status='2'");
      $count[3] = $OrderFactory->query("select count(*) from table_order where Order_Status='3'");
      $count[4] = $OrderFactory->query("select count(*) from table_order ");
      $temp = 0;
      foreach ($count as $val1)
          foreach ($val1 as $val2)
              foreach ($val2 as $key){
                  $ordercount[$temp]=$key;
                  $temp++;
              };
      $this->assign('ordercount',$ordercount);
      /*获取各状态订单数量结束*/
      /*Order工厂实例化and显示全部订单的方法*/
           /*在显示全部订单下进行的分页功能*/
      $count_pageAll = ceil($ordercount[4]/2);/*计算总页数*/
      $pageAll = isset($_GET['pageAll'])?$_GET['pageAll']:1;/*判断$_GET['page']是否存在，如果存在复制给$page，不存在将1赋值给它，并再次赋值给$page*/
      $startAll = 2*((int)$pageAll-1);/*通过页数计算出要从第几个数据开始读取*/
      $Orderall = null;
      $OrderAll = $OrderFactory->table('table_order  as  a')->join('table_car  as  b  on  b.Car_id = a.Car_Id')->limit($startAll,2)->select();
      $PageAll['page']= $pageAll;
      $PageAll['count_page'] = $count_pageAll;
      $this->assign('PageAll',$PageAll);
      $this->assign('OrderAll',$OrderAll);
       /*显示预定成功订单*/
                   /*在显示全部订单下进行的分页功能*/
      $count_pageSuc = ceil($ordercount[1]/2);/*计算总页数*/
      $pageSuc = isset($_GET['pageSuc'])?$_GET['pageSuc']:1;/*判断$_GET['page']是否存在，如果存在复制给$page，不存在将1赋值给它，并再次赋值给$page*/
      $startSuc = 2*((int)$pageSuc-1);/*通过页数计算出要从第几个数据开始读取*/
      $OrderSuccess = null;
      $OrderSuccess = $OrderFactory->table('table_order  as  a')->join('table_car  as  b  on  b.Car_id = a.Car_Id')->where(' a.Order_Status=1')->limit($startSuc,2)->select();
      $PageSuc['page']= $pageSuc;
      $PageSuc['count_page'] = $count_pageSuc;
      $this->assign('PageSuc',$PageSuc);
      $this->assign('OrderSuccess',$OrderSuccess);
      /*显示租赁中订单*/
                    /*在显示全部订单下进行的分页功能*/
      $OrderRun = null;
      $count_pageRun = ceil($ordercount[2]/2);/*计算总页数*/
      $pageRun = isset($_GET['pageRun'])?$_GET['pageRun']:1;/*判断$_GET['page']是否存在，如果存在复制给$page，不存在将1赋值给它，并再次赋值给$page*/
      $startRun = 2*((int)$pageRun-1);/*通过页数计算出要从第几个数据开始读取*/
      $OrderRun = $OrderFactory->table('table_order  as  a')->join('table_car  as  b  on  b.Car_id = a.Car_Id')->where(' a.Order_Status=2')->limit($startRun,2)->select();
      $PageRun['page']= $pageRun;
      $PageRun['count_page'] = $count_pageRun;
      $this->assign('PageRun',$PageRun);
      $this->assign('OrderRun',$OrderRun);
      /*显示已完成订单*/
      $OrderAlr = null;
      $count_pageAlr = ceil($ordercount[3]/2);/*计算总页数*/
      $pageAlr = isset($_GET['pageRun'])?$_GET['pageRun']:1;/*判断$_GET['page']是否存在，如果存在复制给$page，不存在将1赋值给它，并再次赋值给$page*/
      $startAlr = 2*((int)$pageRun-1);/*通过页数计算出要从第几个数据开始读取*/
      $OrderAlr = $OrderFactory->table('table_order  as  a')->join('table_car  as  b  on  b.Car_id = a.Car_Id')->where(' a.Order_Status=3')->limit($startAlr,2)->select();
      $PageAlr['page']= $pageAlr;
      $PageAlr['count_page'] = $count_pageAlr;
      $this->assign('PageAlr',$PageAlr);
      $this->assign('OrderAlr',$OrderAlr);
      /*显示已取消订单*/
      $OrderCan = null;
      $count_pageCan = ceil($ordercount[0]/2);/*计算总页数*/
      $pageCan = isset($_GET['pageCan'])?$_GET['pageCan']:1;/*判断$_GET['page']是否存在，如果存在复制给$page，不存在将1赋值给它，并再次赋值给$page*/
      $startCan = 2*((int)$pageCan-1);/*通过页数计算出要从第几个数据开始读取*/
      $OrderCan = $OrderFactory->table('table_order  as  a')->join('table_car  as  b  on  b.Car_id = a.Car_Id')->where(' a.Order_Status=0')->limit($startCan,2)->select();
      $PageCan['page']= $pageCan;
      $PageCan['count_page'] = $count_pageCan;
      $this->assign('PageCan',$PageCan);
      $this->assign('OrderCan',$OrderCan);

      /*获取用户的信息*/
        $MemFactory =M('Mem');
      $Mem = $MemFactory->where('Mem_ID='.$_SESSION['Mem'])->find();
      $this->assign('Mem',$Mem);
      $this->display('IfoPage');
  }

    /*我的信息修改完之后的处理页面*/
    public function  IfoChaMes_action(){
        $MemFactory =M('Mem');
        $data = [];
        $data = $_POST;
        $MemFactory->where('Mem_Id='.$_POST['Mem_Id'])->save($data);
        $this->success('已成功保存您的个人信息','/IfoPage/IfoPage#IfoChaMes'.'&&'.time());
    }
}