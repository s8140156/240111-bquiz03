<?php

include_once "db.php";

// echo "<option value='1'>1</option>";
// echo "<option value='2'>2</option>";
// echo "<option value='3'>3</option>";

$movie=$_GET['id'];
$ondate=strtotime($Movie->find($movie)['ondate']);
$end=strtotime("+2 days",$ondate);
$today=strtotime(date("Y-m-d")); //不要使用now 
$diff=($end-$today)/(60*60*24); //差距多少天
for($i=0;$i<=$diff;$i++){ //從今天開始還有幾天可放映?
	$date=date("Y-m-d",strtotime("+$i days"));
		echo "<option value='$date'>$date</option>";
	}

?>
