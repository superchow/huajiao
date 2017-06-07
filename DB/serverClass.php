<?php 
header( "Access-Control-Allow-Origin:*");            
header('Access-Control-Allow-Methods:POST');    
// 响应头设置    
header('Access-Control-Allow-Headers:x-requested-with,content-type');    
//对成员的增删改
$action=$_POST['action'];
$school_id=$_POST['changeID'];
$authorizeID=$_POST['authorizeID'];
$classtable=$_POST['current_table'];

$output = [];
$conn = mysqli_connect('127.0.0.1','root','','huajiao');
$sql = "SET NAMES UTF8";
mysqli_query($conn,$sql);
$sql = "SELECT school_id FROM `teacher` WHERE `school_id`='$authorizeID' ";
$result = mysqli_query($conn,$sql);
if($result){	
	if($action == "INSERT"){
		$sql = "INSERT INTO '$classtable'(`school_id`, `infomation`) VALUES ('$school_id', '新添加')";
	}else if($action == "DELETE"){
		$sql = "DELETE FROM $classtable WHERE `school_id`='$school_id' ";
	}else if($action == "UPDATE"){
		$sql = "UPDATE `student` SET `permission`='1' WHERE `school_id`='$school_id' ";
	}else{
		$sql ="";
	}
	if(mysqli_query($conn,$sql)){
		$output['msg'] = 'success';
	}else{
		$output['msg'] = 'fail';
	}
	
}else{
	$output['data'] = $result;
	$output['msg'] = 'cannot';
}
echo json_encode($output,false);
?>
