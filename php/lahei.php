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

$laheiNum = htmlspecialchars($_POST['laheiNum']);
$sql = 'update login set status=0 where id='.$laheiNum;
$result = mysqli_query($conn,$sql);
if($result){
	echo '已拉黑！';
}else{
	echo '拉黑失败！';
}


?>