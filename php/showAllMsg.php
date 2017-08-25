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

$sql = 'select * from msg';
$result = mysqli_query($conn,$sql);
while ($rows = mysqli_fetch_assoc($result)) {
	echo '<tr><td>'.$rows["id"].'</td><td>'.$rows["incname"].'</td><td>'.$rows["time"].'</td><td>'.$rows["incport"].'</td><td><a href="'.$rows["site"].'" target="_blank">link</a></td><td>'.$rows["ps"].'</td><td>'.$rows["belong"].'</td></tr>';
}



?>