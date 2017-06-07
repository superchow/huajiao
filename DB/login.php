<?php 
header( "Access-Control-Allow-Origin:*");            
header('Access-Control-Allow-Methods:POST');    
// 响应头设置    
header('Access-Control-Allow-Headers:x-requested-with,content-type');    
include 'db.php';

$identity=$_POST['identity'];
$school_id=$_POST['school_id'];
$passworddata=$_POST['password'];
$password=md5($passworddata);

$myDB=new DB($identity);
$result=$myDB->find("select * from $identity where school_id='$school_id' AND password='$password'");
$output = [];
if($result){
	$result['password']=$passworddata;
	echo json_encode($result);
}else{
	$output['msg']='faile';
	echo json_encode($output);	
};

?>
