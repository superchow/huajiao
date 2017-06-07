<?php
header( "Access-Control-Allow-Origin:*");            
header('Access-Control-Allow-Methods:GET');    
// 响应头设置    
header('Access-Control-Allow-Headers:x-requested-with,content-type');    

$table = $_GET['class_table'];
$output = [];
$temp1 = [];
$conn = mysqli_connect('127.0.0.1','root','','huajiao');
$sql = "SET NAMES UTF8";
mysqli_query($conn,$sql);
//表1  [连接形式]  join  表2  [on  连接条件]  [连接形式]  join  表3  [on  连接条件]　
//教师表中查询
$sql = 'SELECT * FROM `'.$table.'`inner JOIN `teacher` ON `'.$table.'`.`school_id`=`teacher`.`school_id`';
$result= mysqli_query($conn,$sql);
if($result){
	while($row = mysqli_fetch_assoc($result)){
		$temp1[] = $row;
	}	
	$output['msg'] = "success";
	$output['length'] = count($temp1,0);
	$output['teacher'] = $temp1;
	echo json_encode($output);
}

//////学生表中查询
//$sql = 'select * from $table inner join student on $table.school_id=student.school_id ';
//$result= mysqli_query($conn,$sql);
//if($result){
//	while($row = mysqli_fetch_assoc($result)){
//		$temp2[] = $row;
//	}
//	$output['msg'] = "success";
//	$output['student'] = $temp2;
//}	
//计算结果数
//$output['length'] = count($temp1,0) + count($temp2,0);
//
//if(!count($temp,0)){
//	$output['msg'] = "noone";
//}
//echo json_encode($output);
		
?>