<?php  
header("Access-Control-Allow-Origin: *"); 
$name = isset($_POST['username'])? $_POST['username'] : '';    
$filename =date('Y-m-d', time()).'_'.iconv('utf-8','gb2312',$name).'_'.iconv('utf-8','gb2312',$_FILES['files']['name']);
$fileurl = '';
if($_FILES['files']['type'] == 'image/jpeg' or $_FILES['files']['type'] == 'image/pjpeg' or $_FILES['files']['type'] == 'image/gif'){
	$fileurl .='../../img/'.$filename;
}else{
	$fileurl .='../../upfiles/'.$filename;
}
$response['name'] = $name;  
$response['fileurl'] = $fileurl;
//$filename = "../img/".iconv('utf-8','gb2312',$name)."".substr($_FILES['file']['name'], strrpos($_FILES['file']['name'],'.'));  
$response = array();  
if(move_uploaded_file($_FILES['files']['tmp_name'], $fileurl)){  
    $response['isSuccess'] = true;  
    $response['name'] = $name;  
    $response['fileurl'] = $fileurl;  
}else{ 
	 $response['fileurl'] =$name;
	 $response['filename'] =$filename;
    $response['isSuccess'] = false;    
}  
echo json_encode($response);  
?>