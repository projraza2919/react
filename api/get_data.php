<?php  
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
header("Access-Control-Max-Age: 3600");
header('Access-Control-Allow-Methods:GET');
header("Access-Control-Allow-Credentials", "true");
header("Access-Control-Allow-Headers", "Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");
$data=json_decode(file_get_contents("php://input"),true);
$response=array('status'=>false,'msg'=>'Error');
include 'db.php';

$users=array();
$ret=array();
$sql="SELECT * FROM data GROUP BY uid ORDER BY id DESC";
	if (mysqli_query($conn,$sql)) {
		$run=mysqli_query($conn,$sql);
		if(mysqli_num_rows($run)>0){
			$r=array();
			while ($fetch=mysqli_fetch_assoc($run)) {
				array_push($users, $fetch['uid']);
			}
		}else{
			$response=array(
				'status'=>false,
				'msg'=>'No Post Available'
			);
		}
	}else{
		$response=array(
			'status'=>false,
			'msg'=>'Fatal Error'
		);
	}
	if (!empty($users)) {
		for ($i=0; $i < count($users); $i++) { 
			$com=array();
			$title='';
			$uid=$users[$i];
			$sql="SELECT * FROM data WHERE uid='$uid' ORDER BY id DESC";
			if (mysqli_query($conn,$sql)) {
				$run=mysqli_query($conn,$sql);
				if (mysqli_num_rows($run)>0) {
					while ($fetch=mysqli_fetch_assoc($run)) {
						if ($fetch['post']!='na') {
							$title=$fetch['post'];
						}
						array_push($com, $fetch['comment']);
					}
				}
			}
			$g=array(
				'uid'=>$uid,
				'title'=>$title,
				'comments'=>$com
			);
			array_push($ret, $g);
			$response=array(
				'status'=>true,
				'post'=>$ret
			);
		}
	}else{
		$response=array(
			'status'=>false,
			'msg'=>'No Post'
		);
	}

echo json_encode($response);

?>