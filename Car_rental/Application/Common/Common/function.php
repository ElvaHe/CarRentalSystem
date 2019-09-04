<?php
function sendMail($to, $title, $content) {
    Vendor('PHPMailer.PHPMailerAutoload');
    $mail = new PHPMailer(); //实例化
    $mail->isSMTP(); // 启用SMTP
    $mail->Host='smtp.163.com';  //smtp服务器的名称（这里以QQ邮箱为例）
    $mail->SMTPAuth = true; //启用smtp认证
    $mail->Username = '18960937550@163.com';   //你的邮箱名
    $mail->Password = 'wo2584560';    //邮箱密码
    $mail->From ='18960937550@163.com'; //发件人地址（也就是你的邮箱地址）
    $mail->FromName ='神舟租车';
    $mail->AddAddress($to,"尊敬的客户");
    $mail->WordWrap = 50; //设置每行字符长度
    $mail->IsHTML(true);   // 是否HTML格式邮件
    $mail->CharSet = 'utf-8';
//    $mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码
    $mail->Subject =$title; //邮件主题
    $mail->Body = $content; //邮件内容
    $mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
    $mail->send();
    if(!$mail->send()){
        echo $mail->ErrorInfo;
    };

}