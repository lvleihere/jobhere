<?php  

$localhost = 'localhost';
$username = 'wd52130899';
$password = 'wd52130899';
$database = 'wd52130899';

$conn = mysqli_connect($localhost,$username,$password,$database);
mysqli_query($conn,'set names utf8');
if(!conn){
	die('数据库连接失败！');
}

$username = htmlspecialchars($_POST['username']);
if($username==null){
	echo -1;
}else{
	$sql = 'select * from login where username="'.$username.'"';
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	$dataJson = '{"id":'.$row["id"].',"username":"'.$row["username"].'","nick":"'.$row["nick"].'","status":"'.$row["status"].'"}';
	echo $dataJson;
}

?>