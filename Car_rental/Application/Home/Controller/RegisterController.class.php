<?php
namespace Home\Controller;
use Common\Model\AgeModel;
use Common\Model\CalculateDays;
use Common\Model\CalculatedDays;
use Think\Controller;
class RegisterController extends Controller {
 /*注册界面*/
    public function register(){
        $this->display(register);
    }
 /*注册处理界面*/
    public function register_action(){
        $MemFactory = D('Mem');
        $Mem = $MemFactory->fetchByUsername($_POST['username']);
        $regEmail ='/^\w+@\w+(\.[a-zA-Z]{2,3}){1,2}$/';
        $reguser = '/^[a-zA-Z][a-zA-Z0-9]{3,15}$/';
        $regPsw = '/^[a-zA-Z0-9]{6,18}$/';
        if(!$Mem == null){
            $this->error("用户名已经存在，请重新输入！");
        }
        if(!preg_match($reguser, $_POST['username'])){
            $this->error("用户名格式不正确，请重新输入！");
        }
        if(!preg_match($regEmail, $_POST['mem_email'])){
            $this->error("邮箱格式不正确，请重新输入");
        }
        if(!preg_match($regPsw, $_POST['password'])){
            $this->error("密码格式过于简单，请重新输入");
        }
        if( $_POST['password_again'] != $_POST['password']){
            $this->error("两次输入的密码不一致，请重新输入");
        }
        else{
            $data['UserName']=$_POST['username'];
            $data['PassWord']=$_POST['password'];
            $data['Mem_Email']=$_POST['mem_email'];
            $result = $MemFactory->data($data)->add();
            if($result){
                //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                $this->success('注册成功，为您跳转到登录界面', '/Login/login');
            } else {
                //错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('注册失败');
            }
        }
    }
}