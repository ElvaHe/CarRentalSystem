<?php
namespace Home\Controller;
use Common\Model\AgeModel;
use Common\Model\CalculateDays;
use Common\Model\CalculatedDays;
use Think\Controller;
class LoginController extends Controller {
    /*d登录界面控制器*/
    public function login(){

        $this->display('login');
    }
    /*登录处理界面控制器*/
    public function  login_action(){
        $MemFactory = D('Mem');
        $Mem = $MemFactory->fetchByUsername($_POST['username']);
        if($Mem == null){ $this->error('用户名不存在');}
        if($Mem->checkpsw($_POST['psw']) == true){
            $_SESSION['Mem'] =$Mem->mem_id;
            $this->success('登录成功，为您跳转到首界面', 'http://www.car_rental.com/HomePage/HomePage');
        }
        else{
            $this->error('密码不正确');
        }
    }
   /*退出处理界面*/
    public  function exit_action(){
        session_destroy();
        $this->success("注销成功，将返回登录界面","/Login/Login");

   }
}