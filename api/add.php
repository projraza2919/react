<?php  

include 'db.php';


$comment=$_POST['comment'];
$uid=bin2hex(random_bytes(8));
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