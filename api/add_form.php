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

$create="CREATE TABLE IF NOT EXISTS data (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
comment VARCHAR(30) NOT NULL,
uid VARCHAR(200) DEFAULT 'na',
post VARCHAR(200) DEFAULT 'na',
image TEXT,
status VARCHAR(50) DEFAULT 'inserted'
)";
mysqli_query($conn,$create);
$title=$data['title'];
$uid=bin2hex(random_bytes(8));
$sql="INSERT INTO data(post,uid,status) VALUES('$title','$uid','status')";
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