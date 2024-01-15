<?php

include_once "db.php";

// echo "<option value='1'>1</option>";
// echo "<option value='2'>2</option>";
// echo "<option value='3'>3</option>";

$move=$_GET['id'];
$ondate =$Moive->find($movie)['ondate'];
$today = date("Y-m-d"); //不要使用now 


$movies = $Movie->all(" where `ondate`>='$ondate' && `ondate`<='$today' && `sh`=1 order by rank");
foreach($movies as $movie){
	echo "<option value='{$movie['id']}'>{$movie['ondate']}</option>";
}

?>
