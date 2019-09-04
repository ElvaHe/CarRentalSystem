<?php
namespace Home\Controller;
use Common\Model\AgeModel;
use Common\Model\CalculateDays;
use Common\Model\CalculatedDays;
use Common\Model\Utls;
use Think\Controller;
class CarlistController extends Controller{
     /*车列表显示界面，并充当着HomePage的Action界面*/
    public  function  carlist(){
        if(empty($_SESSION)){$this->error("您还未登录,为您转到登录界面","/Login/Login");}
        /*创建会员用户的工厂*/
        $Mem = null;
        $MemFactory = D('Mem');
        $Mem = $MemFactory->fetch($_SESSION['Mem']);
        $this->assign("Mem",$Mem);
        /*创建车的工厂*/
        $Car = null;
        $CarFactory = D('Car');
        $Car = $CarFactory->select();
        $this->assign("Car",$Car);
        $data =[];
        $this->assign('data',$_SESSION);
        $this->display('carlist');

    }
    /*从homepage传来的信息的处理*/
    public function  carlist_action(){
    /*从HomePage传过来的数据*/
    $data = null;
    if($_POST['fetchTime']==null||$_POST['fetchHour']==null||
        $_POST['backTime']==null||$_POST['backHour']==null||
        $_POST['fetchPlace']==null||$_POST['backPlace']==null)
        $this->error('所填信息不能为空，请重新选择');
    else{
        $CalculatedDays = new CalculatedDays();
        $orderDays = $CalculatedDays->orderDays($_POST);
        $_SESSION['fetchTime'] = $_POST['fetchTime'];
        $_SESSION['fetchHour'] = $_POST['fetchHour'];
        $_SESSION['backTime'] = $_POST['backTime'];
        $_SESSION['backHour'] = $_POST['backHour'];
        $_SESSION['fetchPlace'] = $_POST['fetchPlace'];
        $_SESSION['backPlace'] = $_POST['backPlace'];
        $_SESSION['orderDays'] = $orderDays;
        $this->success('信息填写正确','Carlist/carlist');
      }
    }
    /*显示车辆详细页面*/
    public function  CarPage(){
        $Car_Id = $_GET['Car_Id'];
        $CarFactory = D('Car');
        $Car = $CarFactory->fetch($Car_Id);
        $this->assign('Car',$Car);
        $this->display('CarPage');
    }

    public function  demo(){
        $CarFactory = M('Car');
        $price='800-1000';
        $brand='法拉利';
        $type='豪华型';
        /*下面是分割价格*/
        $arr = explode("-",$price);
        $priceStrat = $arr[0];
        $priceEnd   = $arr[1];
        /*下面是拼接传来的变量*/
        $NewName =new Utls();
        $brandNew =  $NewName->sort_pinjie($brand);
        $typeNew  =  $NewName->sort_pinjie($type);

        /*下面是判断属于哪一种*/
        if($price=='free-price'&&$brand=='free-brand'&&type=='free-type'){
//            $Car = $CarFactory->select();
//            print_r($Car);
        }
        if($price=='free-price'&&$brand=='free-brand'){
//             $Car = $CarFactory->where('Car_Type='.$typeNew)->select();
//             print_r($Car);
        }
        if($price=='free-price'&&type=='free-type'){
//             $Car = $CarFactory->where('Car_Brand='.$brandNew)->select();
//             print_r($Car);
        }
        if($brand=='free-brand'&&type=='free-type'){
//             $Car = $CarFactory->where('Car_Price between '.$priceStrat.' AND '.$priceEnd)->select();
//             print_r($Car);
        }
        if($brand=='free-brand'){
//            $Car = $CarFactory->where('Car_Price between '.$priceStrat.' AND '.$priceEnd.' AND Car_Type='.$typeNew)->select();
//            print_r($Car);
        }
        if(type=='free-type'){
//            $Car = $CarFactory->where('Car_Price between '.$priceStrat.' AND '.$priceEnd.' AND Car_Brand='.$brandNew)->select();
//            print_r($Car);
        }
        if($price=='free-price'){
//            $Car = $CarFactory->where('Car_Brand='.$brandNew.' AND Car_Type='.$typeNew)->select();
//            print_r($Car);
        }
        if($price!='free-price'&&$brand!='free-brand'&&type!='free-type'){
//            $Car = $CarFactory->where('Car_Price between '.$priceStrat.' AND '.$priceEnd.' AND Car_Brand='.$brandNew.' AND Car_Type='.$typeNew)->select();
//            print_r($Car);
        }


    }
    public function  sort_action(){
        $CarFactory = M('Car');
        $price=$_POST['price'];
        $brand=$_POST['brand'];
        $type=$_POST['type'];
        /*下面是分割价格*/
        $arr = explode("-",$price);
        $priceStrat = $arr[0];
        $priceEnd   = $arr[1];
        /*下面是拼接传来的变量*/
        $NewName =new Utls();
        $brandNew =  $NewName->sort_pinjie($brand);
        $typeNew  =  $NewName->sort_pinjie($type);
        $data['price'] =$price;
        $data['brand'] =$brand;
        $data['type'] = $type;
//        echo json_encode($data);
        /*下面是判断属于哪一种*/
        if($price=='free-price'&&$brand=='free-brand'&&$type=='free-type'){
            $Car = $CarFactory->select();
            echo json_encode($Car);
        }
        if($price=='free-price'&&$brand=='free-brand'&&$type!='free-type'){
             $Car = $CarFactory->where('Car_Type='.$typeNew)->select();
             echo json_encode($Car);
        }
        if($price=='free-price'&&$type=='free-type'&&$brand!='free-brand'){
             $Car = $CarFactory->where('Car_Brand='.$brandNew)->select();
             echo json_encode($Car);
        }
        if($brand=='free-brand'&&$type=='free-type'&&$price!='free-price'){
             $Car = $CarFactory->where('Car_Price between '.$priceStrat.' AND '.$priceEnd)->select();
             echo json_encode($Car);
        }
        if($brand=='free-brand'&&$type!='free-type'&&$price!='free-price'){
            $Car = $CarFactory->where('Car_Price between '.$priceStrat.' AND '.$priceEnd.' AND Car_Type='.$typeNew)->select();
            echo json_encode($Car);
        }
        if($type=='free-type'&&$brand!='free-brand'&&$price!='free-price'){
            $Car = $CarFactory->where('Car_Price between '.$priceStrat.' AND '.$priceEnd.' AND Car_Brand='.$brandNew)->select();
            echo json_encode($Car);
        }
        if($price=='free-price'&&$brand!='free-brand'&&$type!='free-type'){
            $Car = $CarFactory->where('Car_Brand='.$brandNew.' AND Car_Type='.$typeNew)->select();
            echo json_encode($Car);
        }
        if($price!='free-price'&&$brand!='free-brand'&&type!='free-type'){
            $Car = $CarFactory->where('Car_Price between '.$priceStrat.' AND '.$priceEnd.' AND Car_Brand='.$brandNew.' AND Car_Type='.$typeNew)->select();
            echo json_encode($Car);
        }

    }
}