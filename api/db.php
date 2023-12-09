<?php  

$servername="Localhost";
$database="reacttest";
$dussername="root";
$dpassword="";

$conn= mysqli_connect($servername,$dussername,$dpassword,$database);
if (!$conn) {
	die("connection_error");
}
$globalDomain='https://webmuza.com/';
?>