<?php
namespace Admin\Controller;
use Think\Controller;
class CarController extends Controller {
    /*显示车辆查询的主页面*/
    public function CarPage(){
        $CarFactory =M('Car');
        $Car =  $CarFactory->select();
        $this->assign('Car',$Car);
       $this->display('CarPage');
    }

    /*查询车的处理页面*/
    public function CarSearch_action(){
        $CarFactory = M('Car');
        /*通过车辆编号的查询*/
        if($_POST['reg']=='车辆编号'){
            $Car_Id = $_POST['searchCon'];
            $Car = $CarFactory->where("Car_Id=".$Car_Id)->find();
            if($Car == null)
                $Car['success'] = 0;
            else {
                $Car['success'] = 1;
                echo json_encode($Car);
            }
        }
    }


    /*通过品牌查询车辆信息*/
    public function brand_search(){
        $CarFactory =M('Car');
        $Car_Brand = $_GET['Car_Brand'];
        $Car =  $CarFactory->where("Car_Brand='$Car_Brand'")->select();
        $this->assign('Car',$Car);
        $this->display('CarPage');
    }


    /*通过类型Type查询车辆信息*/
    public function type_search(){
        $CarFactory =M('Car');
        $Car_Type = $_GET['Car_Type'];
        $Car =  $CarFactory->where("Car_Type='$Car_Type'")->select();
        $this->assign('Car',$Car);
        $this->display('CarPage');
    }

    /*显示车辆操作界面*/
    public function CarManage(){
        if($_GET['Car_Id']==null){
            $this->error('管理操作车辆界面失败，请先选择您要操作的车辆','/Car/CarPage');
        }
        else {
            $CarFactory = M('Car');
            $Car_Id = $_GET['Car_Id'];
            $Car = $CarFactory->where("Car_Id='$Car_Id'")->find();
            $this->assign('Car', $Car);
            $this->display('CarManage');
        }
    }

    /*上架操作控制*/
    public function CarUp(){
        $data = [];
        $CarFactory = M('Car');
        $Car_Id = $_GET['Car_Id'];
        $data['Car_Status']='上架中';
       $CarFactory->where("Car_Id='$Car_Id'")->save($data);
        //die(U('Car/CarManage',['Car_Id'=>$Car_Id]));
       $this->success("上架成功，将返回操作界面",'/Car/CarManage?Car_Id='.$Car_Id);
    }

    /*下架操作控制*/
    public function CarDown(){
        $data = [];
        $CarFactory = M('Car');
        $Car_Id = $_GET['Car_Id'];
        $data['Car_Status']='已下架';
        $CarFactory->where("Car_Id=$Car_Id")->save($data);
        //die(U('Car/CarManage',['Car_Id'=>$Car_Id]));
        $this->success("下架成功，将返回操作界面",'/Car/CarManage?Car_Id='.$Car_Id);
    }

     /*显示增加车辆的页面*/
    public function  CarAdd(){
        $this->display('CarAdd');
    }

    /*增加车辆的处理页面*/
    public  function  CarAdd_action(){
        /*上传图片用的TP框架的方法，这个方法适合3.2版本。3.1版本TP需要再改*/
        $upload = new \Think\Upload();// 实例化上传类
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      './Public/Admin/Upload/'; // 设置附件上传根目录
        $upload->savePath='./';
      //  $upload->autoSub =false;
        $upload->subName ="CarImg";
        $upload->saveName = '';
        $info   =   $upload->uploadOne($_FILES['img']);
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }
        /*上传图片代码结束*/
        $CarFactory = M('Car');
         $data = [];
         $data =$_POST;
         $Car_Id =$data["Car_id"];
        // 取得成功上传的文件信息
        // 保存当前数据对象
         $data['Car_Url'] = 'http://admin.car_rental.com/Upload/CarImg/'.$_FILES['img']['name'];
         $CarFactory->add($data);
         $this->success('添加车辆成功，将返回车辆管理界面',"/Car/CarManage?Car_Id=".$Car_Id.'&'.time());

    }


    /*修改车辆信息的界面*/
       public function CarModify(){
           if($_GET['Car_Id']==null){
               $this->error('查看修改车辆信息失败，请先选择您要查看修改的车辆','/Car/CarPage');
           }
           else {
               $CarFactory = M('Car');
               $Car_Id = $_GET['Car_Id'];
               $Car = $CarFactory->where("Car_Id='$Car_Id'")->find();
               $this->assign('Car', $Car);
               $this->display('CarModify');
           }
       }

    /*修改车辆信息的保存功能*/
      public function  CarModify_action(){
          $CarFactory = M('Car');
          $data = [];
          $data =$_POST;
          $Car_Id =$data["Car_Id"];
          $CarFactory->where("Car_Id=$Car_Id")->save($data);
          $this->success('保存成功，将返回查看界面，再次核对您更新的信心','/Car/CarModify?Car_Id='.$Car_Id.'&&'.time());
      }

    /*车辆租赁记录的主页面*/
    public function CarRental(){
        if($_GET['Car_Id']==null){
            $this->error('查看车辆租赁记录失败，请先选择您要查看修改的车辆','/Car/CarPage');
        }
        else {
            $CarFactory = M('Order');
            $Car_Id = $_GET['Car_Id'];
            $Car = $CarFactory->table('table_order  as  a')->join('table_car  as  b  on  b.Car_Id = a.Car_Id')
                ->join('table_mem as c on a.Mem_Id = c.Mem_Id')->where('a.Order_Status = 3 AND a.Car_Id ='.$Car_Id)->select();
            $this->assign('Car', $Car);
            $this->display('CarRental');
        }
    }
}