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

$incname = htmlspecialchars($_POST['incname']);
$time = htmlspecialchars($_POST['time']);
$incport = htmlspecialchars($_POST['incport']);
$site = htmlspecialchars($_POST['site']);
$ps = htmlspecialchars($_POST['ps']);
$belong = htmlspecialchars($_POST['belong']);

$sql = 'insert into msg values(null,"'.$incname.'","'.$time.'","'.$incport.'","'.$site.'","'.$ps.'","'.$belong.'")';
mysqli_query($conn,$sql);
echo '提交成功';



?>