<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
    public function Homepage(){
            $MemFactory = D('Mem');
            $Mem = $MemFactory->select();
            $this->assign('Mem', $Mem);
            $this->display('homePage');


    }

    public  function Homepage_action(){
        $MemFactory = M('Mem');
        $Mem_Id = $_POST['mem_id'];
        $Mem = $MemFactory->where("Mem_Id='$Mem_Id'")->find();
        $Mem['success'] = 1;
        echo json_encode($Mem);

    }
    public function  Search_action(){
        $MemFactory = M('Mem');
        if($_POST['reg']=='MemberID'){
            $Mem_Id = $_POST['searchCon'];
            $Mem = $MemFactory->where("Mem_Id='$Mem_Id'")->find();
            if($Mem == null)
                $Mem['success'] = 0;
            else {
                $Mem['success'] = 1;
                echo json_encode($Mem);
            }
        }
        if($_POST['reg']=='MemberUserName'){
            $Mem_UserName = $_POST['searchCon'];
            $Mem = $MemFactory->where("UserName='$Mem_UserName'")->find();
            if($Mem == null)
                $Mem['success'] = 0;
            else {
                $Mem['success'] = 1;
                echo json_encode($Mem);
            }
        }
        if($_POST['reg']=='MemberNickName'){
            $Mem_NickName = $_POST['searchCon'];
            $Mem = $MemFactory->where("Mem_NickName='$Mem_NickName'")->find();
            if($Mem == null)
                $Mem['success'] = 0;
            else {
                $Mem['success'] = 1;
                echo json_encode($Mem);
            }
        }

    }
    /*邮件分发页面*/
    public  function  Emailsend(){
        $MemFactory = D('Mem');
        $Mem = $MemFactory->select();
        $Time['email-time'] =  date("Y-m-d H:i");
        $this->assign('Mem', $Mem);
        $this->assign('Time',$Time);
        $this->display('Emailsend');
    }
    public  function  Emailsend_action(){
        foreach ($_POST['checkbox'] as $value){
            sendMail($value,$_POST['email_title'],$_POST['email_content']);
        }
//        $this->success('邮件已经成功发送','/User/Homepage');
    }
}
