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
$sql = 'UPDATE info SET id=(@i:=@i+1);';
mysqli_query($conn,$sql);
$sql = 'ALTER TABLE  tablename  AUTO_INCREMENT=0;';
mysqli_query($conn,$sql);


$sql = 'select * from info';
$result = mysqli_query($conn,$sql);
while ($rows = mysqli_fetch_assoc($result)) {
	echo '<tr><td>'.$rows["id"].'</td><td>'.$rows["username"].'</td><td>'.$rows["who"].'</td><td>'.$rows["app"].'</td><td>'.$rows["classify"].'</td><td>'.$rows["content"].'</td><td>'.$rows["time"].'</td></tr>';
}



?>