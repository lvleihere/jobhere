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

$sql = 'select * from login';
$result = mysqli_query($conn,$sql);
$flag = 0;
while ($row = mysqli_fetch_assoc($result)) {
	if($row['username']==$username){
		$nick = $row['nick'];
		$flag = 1;
		break;
	}
}
if($flag==1){
	echo $nick;
}else{
	echo '自动登录失败！';
}


?>