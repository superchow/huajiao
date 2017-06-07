<?php
header( "Access-Control-Allow-Origin:*");            
header('Access-Control-Allow-Methods:POST');    
// 响应头设置    
header('Access-Control-Allow-Headers:x-requested-with,content-type');    
include 'db.php';
/* 判断是否有身份,没有的话都去查找  太麻烦(历史纪录会带来trouble)，故直接全找(效率低)
 * 最好是分表，然后根据学号对应，这里是简化了
 */
changePassword('teacher');//先去教师表里查询
function changePassword($identity) {
	//结果存放
	$arr = [];
	$school_id = $_POST['school_id'];
	$email = $_POST['email'];
	$myDB=new DB($identity);
	$result=$myDB->find("select * from $identity where school_id='$school_id' and email='$email'");
	if($result['school_id']>0){
		$passworddata = GetRandStr(6);
		$data['password']=md5($passworddata);
		$password=$data['password'];
		$sql="school_id='$school_id'";
		$myDB->update($data,$sql);
		$result=$myDB->find("select * from $identity where school_id='$school_id' and password='$password' ");
		if($result['school_id']>0){
			require_once("./phpmailer/functions.php");
			$flag = sendMail($email,'花椒——密码找回','<span style="color:red;">'.$passworddata.'</span><br/>');
			if(!$flag){
				$arr['msg']='fail';
				//输出结果
				echo json_encode($arr,true);
			}else{
				$arr['msg']='success';
				$arr['password']=$passworddata;
				//输出结果
				echo json_encode($arr,true);
			}
		}else{
			$arr['msg']='faile';
			//输出结果
			echo json_encode($arr,true);
		};
		return;	
	}else{
		if($identity=="teacher"){
			$identity="student";
			changePassword($identity);	
			return;	
		}		
	}
	$arr['msg']='notfind';
	//输出结果
	echo json_encode($arr,true);
}
//生成随机数
function GetRandStr($len) { 
    $chars = array( 
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",  
        "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",  
        "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",  
        "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",  
        "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",  
        "3", "4", "5", "6", "7", "8", "9" 
    ); 
    $charsLen = count($chars) - 1; 
    shuffle($chars);   
    $output = ""; 
    for ($i=0; $i<$len; $i++) 
    { 
        $output .= $chars[mt_rand(0, $charsLen)]; 
    }  
    return $output;  
} 
//发送邮件	
/*function sendEmail($email, $password){
	require_once "email.class.php";
	//******************** 配置信息 ********************************
	$smtpserver = "smtp.qq.com";//SMTP服务器
	$smtpserverport =465;//SMTP服务器端口
	$smtpusermail = "2665752129@qq.com";//SMTP服务器的用户邮箱
	$smtpemailto = $email;//发送给谁
	$smtpuser = "2665752129";//SMTP服务器的用户帐号
	$smtppass = "cildalpvunujdigi";//SMTP服务器的用户密码
	$mailtitle = "花椒-密码找回";//邮件主题
	$mailcontent = "<h1>".$password."</h1>";//邮件内容
	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
	//************************ 配置信息 ****************************
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = true;//是否显示发送的调试信息
	return $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
}*/
?>