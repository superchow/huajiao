<?php
require_once(dirname(__FILE__)."/functions.php");
$flag = sendMail('13170888430@163.com','测试','<span style="color:red;">测试</span><br/>测试');
if(!$flag){
    echo "发送邮件成功！";
}else{
    echo "发送邮件失败！";
}
?>