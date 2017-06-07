<?php
header( "Access-Control-Allow-Origin:*");            
header('Access-Control-Allow-Methods:POST');    
// 响应头设置    
header('Access-Control-Allow-Headers:x-requested-with,content-type');    
//include 'db.php';
$school_id=$_POST['school_id'];
$identity=$_POST['identity'];
$Class=$_POST['fromClass'];
$taskid=$_POST['taskid'];
$permission=$_POST['permission'] || "";

$output = [];
$conn = mysqli_connect('127.0.0.1','root','','huajiao');
$sql = "SET NAMES UTF8";
mysqli_query($conn,$sql);
if(empty($Class)){exit();}//判断是否有班级，应该留着查询班级是否存在并建立班级表
if($identity=="teacher"){
	$sql = "select * from teacher where school_id='$school_id' and current_table='$Class' ";
}else{ //加权限判断
	$sql = "select * from student where school_id='$school_id' and current_table='$Class' and permission='$permission' ";
}
$result= mysqli_query($conn,$sql);
if($result){
	$row = mysqli_fetch_assoc($result);
	$name = $row['name'];
	if( ($identity=="student") && ($row['permission'] <=0) ){//权限查询,学生加需要
		$output['msg']='ban';
		echo json_encode($output);
   }else{
    		$sql = "DELETE FROM `task` WHERE taskid = '$taskid' AND school_id = '$school_id' ";
			if(!mysqli_query($conn,$sql)){//删除失败
			    $output['msg']='faile';
			    echo json_encode($output);
			} else {//删除成功
				$output['msg']='success';
				echo json_encode($output);	
			}
 		
   }
}else{
	$output['msg']='other';
	echo json_encode($output);	
};
?>