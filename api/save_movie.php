<?php

include_once "db.php";

if(!empty($_FILES['trailer']['tmp_name'])){
	move_uploaded_file($_FILES['trailer']['tmp_name'],"../img/{$_FILES['trailer']['name']}");
	$_POST['trailer']=$_FILES['trailer']['name'];
}

if(!empty($_FILES['poster']['tmp_name'])){
	move_uploaded_file($_FILES['poster']['tmp_name'],"../img/{$_FILES['poster']['name']}");
	$_POST['poster']=$_FILES['poster']['name'];
}

$_POST['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['date'];
unset($_POST['year'],$_POST['month'],$_POST['date']); //unset()裡面可以放很多參數

if(!isset($_POST['id'])){
	$_POST['sh']=1;
	$_POST['rank']=$Movie->max('id')+1;
}


$Movie->save($_POST);
to("../back.php?do=movie");

//這邊將add_movie與edit_movie合併
//主要是圖檔上傳 在編輯可能不會上傳 所以將isset->!empty判斷
//前面先判斷是否有id傳入 是新增才增加sh, rank設值

