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

/*重新排序*/
$sql = 'SET @i=0;';
mysqli_query($conn,$sql);
$sql = 'UPDATE msg SET id=(@i:=@i+1);';
mysqli_query($conn,$sql);
$sql = 'ALTER TABLE  tablename  AUTO_INCREMENT=0;';
mysqli_query($conn,$sql);

$sql = 'select * from msg where belong="public"';
//定义序列
$num = 0;

$result = mysqli_query($conn,$sql);
while ($durRows = mysqli_fetch_assoc($result)) {
	echo '<tr><td>'.++$num.'</td><td>'.$durRows["incname"].'</td><td>'.$durRows["time"].'</td><td>'.$durRows["incport"].'</td><td><a href="'.$durRows["site"].'" target="_blank">link</a></td><td>'.$durRows["ps"].'</td></tr>';
}



?>