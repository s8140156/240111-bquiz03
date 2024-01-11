<?php

include_once "db.php";

$DB=new DB($_POST['table']); //因為會有兩個頁面(movie & poster)會使用到這個排序功能 所以直接放變數 讓哪個頁面使用就帶那個頁面的變數
$row=$DB->find($_POST['id']); //這是點選要變換的id
$sw=$DB->find($_POST['sw']); //這是準備要被交換的id

$tmp=$row['rank'];
$row['rank']=$sw['rank'];
$sw['rank']=$tmp;

$DB->save($row);
$DB->save($sw);