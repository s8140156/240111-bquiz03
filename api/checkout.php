<?php

include_once "db.php";

sort($_POST['seats']); //排序seats陣列
$_POST['seats']=serialize($_POST['seats']); //把陣列序列化轉成字串才能存進資料庫
$id=$Order->max('id')+1; //因為還不知道id then?再聽一次老師講解
$_POST['no']=date("Ymd").sprintf("%04d",$id);
$Order->save($_POST);
echo $_POST['no'];


?>