<?php  
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
header("Access-Control-Max-Age: 3600");
header('Access-Control-Allow-Methods:POST');
header("Access-Control-Allow-Credentials", "true");
header("Access-Control-Allow-Headers", "Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");
$data=json_decode(file_get_contents("php://input"),true);
$response=array('status'=>false,'msg'=>'Error');
include 'db.php';


$comment=$data['comment'];
$uid=$data['uid'];
//$uid=bin2hex(random_bytes(8));
$sql="INSERT INTO data(comment,uid,status) VALUES('$comment','$uid','status')";
if (mysqli_query($conn,$sql)) {
		$response=array(
			'status'=>true,
		);
	}else{
		$response=array(
			'status'=>false,
			'msg'=>'Failed To add',
		);
	}

echo json_encode($response);

?>