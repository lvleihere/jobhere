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

$clearUsersNum = htmlspecialchars($_POST['clearUsersNum']);
$sql = 'delete from login where id='.$clearUsersNum;
$result = mysqli_query($conn,$sql);
if($result){
	echo '删除成功！';
}else{
	echo '删除失败！';
}


?>