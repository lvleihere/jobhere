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

$laheiRestoreNum = htmlspecialchars($_POST['laheiResotreNum']);
$sql = 'update login set status=1 where id='.$laheiRestoreNum;
$result = mysqli_query($conn,$sql);
if($result){
	echo '已拉黑解除！';
}else{
	echo '解除拉黑失败！';
}


?>