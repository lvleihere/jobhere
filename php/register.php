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
$password = htmlspecialchars($_POST['password']);
$nick = htmlspecialchars($_POST['nick']);

$flag = 1;
$checkRepeat = 'select * from login';
$checkResult = mysqli_query($conn,$checkRepeat);
while ($checkRow = mysqli_fetch_assoc($checkResult)) {//0:账号已存在  -1:昵称已存在
	if($checkRow['username']==$username){
		$flag = 0;
		break;
	}else if($checkRow['nick']==$nick){
		$flag = -1;
		break;
	}
}
if($flag==0){
	echo 0;
}else if($flag==-1){
	echo -1;
}else{
	$sql = 'insert into login values(null,"'.$username.'","'.$password.'","'.$nick.'","1")';
	$result = mysqli_query($conn,$sql);
	echo 1;
}



?>