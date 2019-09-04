<?php
namespace Admin\Controller;
use Common\Model\Mail;
use Think\Controller;
class IndexController extends Controller {
    public function mail(){
        sendMail('1548175448@qq.com','错误提示','你输入的信息有错误，请重新输入');


    }
}