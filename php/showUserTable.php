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
$belong = htmlspecialchars($_POST['username']);
if($belong==null){
	echo 2;
}else{
	$num=0;
	$sqls = 'select * from msg where belong="'.$belong.'"';
	$result = mysqli_query($conn,$sqls);
	while ($durRows = mysqli_fetch_assoc($result)) {
		echo '<tr><td>'.(++$num).'</td><td>'.$durRows["incname"].'</td><td>'.$durRows["time"].'</td><td>'.$durRows["incport"].'</td><td><a href="'.$durRows["site"].'" target="_blank">link</a></td><td>'.$durRows["ps"].'</td></tr>';
	}
}


?>