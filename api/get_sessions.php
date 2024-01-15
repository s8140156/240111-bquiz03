<?php

include_once "db.php";

$movie=$_GET['movie'];
$movieName=$Movie->find($movie)['name'];
$date=$_GET['date'];
$H=date('G'); //取不補零的24小時格式 拿來算時間
// $start=($H<14)?1:6-(ceil((24-$H)/2)-1);
$start=($H>=14 && $date==date('Y-m-d'))?7-ceil((24-$H)/2):1;

for($i=$start;$i<=5;$i++){
	$qt=$Order->sum('qt',['movie'=>$movieName,'date'=>$date,'session'=>$sess[$i]]);
	$lave=20-$qt; //剩餘座位
	echo "<option value='{$sess[$i]}'>{$sess[$i]} 剩餘座位 $lave</option>";
}

?>
