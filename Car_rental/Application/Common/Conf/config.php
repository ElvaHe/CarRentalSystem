<?php
return [
    'APP_SUB_DOMAIN_DEPLOY'   =>    1,//开启子域名或者IP配置
    'APP_SUB_DOMAIN_RULES'     =>   [
        'www.car_rental.com'  =>'Home',
        'admin.car_rental.com'  =>'Admin',
    ],
    //数据库配置信息
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => '127.0.0.1', // 服务器地址
    'DB_NAME'   => 'car_rental', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '123456', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'table_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增
    // 配置邮件发送服务器
//    'MAIL_HOST' =>'smtp.exmail.qq.com',//smtp服务器的名称
//    'MAIL_SMTPAUTH' =>TRUE, //启用smtp认证
//    'MAIL_USERNAME' =>'405420415@qq.com',//你的邮箱名
//    'MAIL_FROM' =>'405420415@qq.com',//发件人地址
//    'MAIL_FROMNAME'=>'405420415@qq.com',//发件人姓名
//    'MAIL_PASSWORD' =>'ABao9410',//邮箱密码
//    'MAIL_CHARSET' =>'utf-8',//设置邮件编码
//    'MAIL_ISHTML' =>TRUE, // 是否HTML格式邮件
    /*邮件设置*/
//    'EMAIL_SET'=>array(
//        'Host'=> "smtp.163.com",
//        'Port'=>'25',
//        'email_user'=>'13023957197@123.com',
//        'email_pwd'=>'ABAO9410',
//        'email'=>'jb51@163.com',
//        'email_name'=>'13023957197@123.com',
//    )
];

