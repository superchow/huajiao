<?php
header( "Access-Control-Allow-Origin:*");            
header('Access-Control-Allow-Methods:GET');    
// 响应头设置    
header('Access-Control-Allow-Headers:x-requested-with,content-type');    

$kw = $_GET['search'];
$output = [];
$temp1 = [];
$temp2 = [];
if(empty($kw))
{
	$output['msg']="empty";
   	echo json_encode($output);
    return ;
}
$conn = mysqli_connect('127.0.0.1','root','','huajiao');
$sql = "SET NAMES UTF8";
mysqli_query($conn,$sql);

$sql = "SELECT * FROM `teacher` WHERE name LIKE '%$kw%' OR school_id LIKE '%$kw%' OR email LIKE '%$kw%' OR phone LIKE '%$kw%' ";

$result = mysqli_query($conn,$sql);

while(true)
{
    $row = mysqli_fetch_assoc($result);
    if(!$row)
    {
    	$output['msg'] = "success";   	
        break;
    }
    $temp1[] = $row;    
}
$sql = "SELECT * FROM `student` WHERE name LIKE '%$kw%' OR school_id LIKE '%$kw%' OR email LIKE '%$kw%' OR phone LIKE '%$kw%' ";

$result = mysqli_query($conn,$sql);

while(true)
{
    $row = mysqli_fetch_assoc($result);
    if(!$row)
    {
    	$output['msg'] = "success";   	
        break;
    }
    $temp2[] = $row;    
}
$output['teacher'] = $temp1;
$output['student'] = $temp2;
echo json_encode($output);
		
?>