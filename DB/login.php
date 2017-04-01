<?php 
header( "Access-Control-Allow-Origin:*");            
header('Access-Control-Allow-Methods:POST');    
// 响应头设置    
header('Access-Control-Allow-Headers:x-requested-with,content-type');    
//include 'db.php';
$identity=$_POST['identity'];
$school_id=$_POST['school_id'];
$password=$_POST['password'];
//$myDB=new DB($identity);
//$result=$myDB->find("select * from '$identity' where school_id='$school_id' and password='$password'");
$conn = mysqli_connect('127.0.0.1','root','','zwz');
$sql = "SET NAMES UTF8";
mysqli_query($conn,$sql);
$sql = "select * from $identity where school_id='$school_id' and password='$password'";
$result = mysqli_query($conn,$sql);
$output = [];
if($result){
	$row = mysqli_fetch_assoc($result);
	echo json_encode($row);
}else{
	$output['msg']='faile';
	echo json_encode($output);	
};

?>
