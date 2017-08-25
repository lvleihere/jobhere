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

$sql = 'select * from login';
$result = mysqli_query($conn,$sql);
$flag = 0;
while ($row = mysqli_fetch_assoc($result)) {
	if($row['username']==$username&&$row['password']==$password&&$row['status']==1){
		$nick = $row['nick'];
		$flag = 1;
		break;
	}else if($row['username']==$username&&$row['password']==$password&&$row['status']==0){
		$flag = -1;
		break;
	}
}
if($flag==1){
	echo $nick;
}else if($flag==0){
	echo 0;
}else{
	echo -1;
}


?>