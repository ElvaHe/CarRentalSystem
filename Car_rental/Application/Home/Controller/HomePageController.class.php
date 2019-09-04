<?php
namespace Home\Controller;
use Common\Model\AgeModel;
use Common\Model\CalculateDays;
use Common\Model\CalculatedDays;
use Common\Model\MemObject;
use Think\Controller;
class HomePageController extends Controller {
    /*HomePage显示页面*/
    public  function  HomePage(){
        if(empty($_SESSION)){$this->error("您还未登录,为您转到登录界面","/Login/Login");}
        $Mem = null;
        $MemFactory = D('Mem');
        $Mem = $MemFactory->fetch($_SESSION['Mem']);
        $this->assign("Mem",$Mem);
        $this->display('HomePage');
    }
}