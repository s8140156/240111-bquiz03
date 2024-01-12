<?php

include_once "db.php";

$row=$Movie->find($_POST['id']);
// $row['sh']=($row['sh']==1)?0:1; //判斷式 這是三元運算式
$row['sh']=($row['sh']+1)%2;  //運算式=>這種只是運算 效能更快 因為只有0 1判斷
$Movie->save($row);

?>