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
$personEditNum = htmlspecialchars($_POST['personEditNum']);
if($username==null){
	echo '用户未登陆！';
}else{
	//检测输入值是否超出范围
$maxNum=0;
$sql = 'select * from msg where belong="'.$username.'"';
$max = mysqli_query($conn,$sql);
while($rows = mysqli_fetch_assoc($max)){
	$maxNum++;
};
if($personEditNum>$maxNum){
	echo '超出范围！';
}else{
	$sql = 'select * from msg where belong="'.$username.'" limit '.--$personEditNum.',1';
	$queryDelThis= mysqli_query($conn,$sql);
	$queryDurSelArr = mysqli_fetch_assoc($queryDelThis);
	$durId = $queryDurSelArr['id'];
	$delThis = 'delete from msg where id='.$durId;
	$delRes = mysqli_query($conn,$delThis);
	if($delRes){
		echo '删除成功！';
	}else{
		echo '删除失败！';
	}
}
/*重新排序msg*/
$sql = 'SET @i=0;';
mysqli_query($conn,$sql);
$sql = 'UPDATE msg SET id=(@i:=@i+1);';
mysqli_query($conn,$sql);
$sql = 'ALTER TABLE  tablename  AUTO_INCREMENT=0;';
mysqli_query($conn,$sql);
}


?>