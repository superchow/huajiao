<?php 
header( "Access-Control-Allow-Origin:*");            
header('Access-Control-Allow-Methods:POST');    
// 响应头设置    
header('Access-Control-Allow-Headers:x-requested-with,content-type');    
include 'db.php';

$identity=$_POST['identity'];
$school_id=$_POST['school_id'];
$password=$_POST['password'];
$name=$_POST['name'];
$sex=$_POST['sex'];
$email=$_POST['email'];
$academy=$_POST['_academy'];
$major=$_POST['_major'];
$class=$_POST['_class'];
$birth=$_POST['birth'];
$birthplace=$_POST['birthplace'];

$myDB=new DB($identity);
$result=$myDB->find("select * from $identity where school_id='$school_id'");
$arr = [];
if($result['school_id']>0){
	$arr['msg']='Already';
	echo json_encode($arr,true);
}else{
	$data["school_id"]=$school_id;
	$data["password"]=$password;
	$data["name"]=$name;
	$data["sex"]=$sex;
	$data["email"]=$email;
	$data["academy"]=$academy;
	if($identity=="student"){
		$data["major"]=$major;
		$data["class"]=$class;
		$data["birth"]=$birth;
		$data["birthplace"]=$birthplace;
	};	
	$myDB->add($data);
	$result=$myDB->find("select * from $identity where school_id='$school_id'");
	if($result['school_id']>0){
		$arr['msg']='success';
		echo json_encode($arr,true);
	}else{
		$arr['msg']='faile';
		echo json_encode($arr,true);
	};
};
?>