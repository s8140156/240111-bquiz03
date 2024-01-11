<?php

include_once "db.php";
// dd($_FILES);

if(isset($_FILES['poster']['tmp_name'])){
	move_uploaded_file($_FILES['poster']['tmp_name'],"../img/{$_FILES['poster']['name']}");
	$_POST['img']=$_FILES['poster']['name'];
}
// dd($_FILES);
$_POST['sh']=1;
$_POST['rank']=$Poster->max('id')+1;
// 因為要排序(交換)所以用id最大值+1來增加(id一開始預設是0) 進而可以有效的建立rank增加命名;
$_POST['ani']=rand(1,3);

$Poster->save($_POST);
to("../back.php?do=poster");


?>