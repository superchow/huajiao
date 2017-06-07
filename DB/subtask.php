<?php
header( "Access-Control-Allow-Origin:*");            
header('Access-Control-Allow-Methods:POST');    
// 响应头设置    
header('Access-Control-Allow-Headers:x-requested-with,content-type');    
//include 'db.php';
$school_id=$_POST['school_id'];
$identity=$_POST['identity'];
$Class=$_POST['Class'];
$title=$_POST['title'];
$info=$_POST['info'];
$starttime=$_POST['starttime'];
$endtime=$_POST['endtime'];
$filesurl=$_POST['filesurl'];
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
//  	$sql = "select * from task where school_id='$school_id' and info='$info' and who='$name' and starttime='$starttime' ";
//  	if(mysqli_query($conn,$sql)){//防止相同的任务发布
//  		$output['msg']='has';
//			echo json_encode($output);	
//  	}else{//插入任务
    		$sql = "INSERT INTO task(school_id, title, who, starttime, endtime, info, filesurl, Class)VALUES('$school_id', '$title','$name', '$starttime', '$endtime', '$info', '$filesurl', '$Class')";
			if(!mysqli_query($conn,$sql)){//插入失败
			    $output['msg']='faile';
			    echo json_encode($output);
			} else {//插入成功
				$output['msg']='success';
				echo json_encode($output);	
			}
//  	}
 		
   }
}else{
	$output['msg']='other';
	echo json_encode($output);	
};
?>