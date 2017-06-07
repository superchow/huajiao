<?php
header( "Access-Control-Allow-Origin:*");            
header('Access-Control-Allow-Methods:POST');    
// 响应头设置    
header('Access-Control-Allow-Headers:x-requested-with,content-type');    
//include 'db.php';
$taskid=$_POST['taskid'];
$direction=$_POST['direction'];
$Class=$_POST['fromClass'];

$output = [];
$temp = [];
$conn = mysqli_connect('127.0.0.1','root','','huajiao');
$sql = "SET NAMES UTF8";
mysqli_query($conn,$sql);

if( ($taskid == 0)&& ($direction == "up") ){
	$output['msg'] = "cannot";
	echo json_encode($output);
}else{
	if($direction == "down"){
		$sql = "select * from task where Class='$Class' AND taskid > '$taskid' order by taskid desc LIMIT 5";
	}else{
		$sql = "select * from task where Class='$Class' AND taskid < '$taskid' order by taskid desc LIMIT 5";
	}
	$result= mysqli_query($conn,$sql);
	while($row = mysqli_fetch_assoc($result)){
		$temp[] = $row;
	}	
	$output['msg'] = "success";
	$output['length'] = count($temp,0);
	if(!count($temp,0)){
		$output['msg'] = "nomore";
	}
	$output['data'] = $temp;
	echo json_encode($output);	
}
?>