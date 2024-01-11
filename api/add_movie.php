<?php

include_once "db.php";

if(isset($_FILES['trailer']['tmp_name'])){
	move_uploaded_file($_FILES['trailer']['tmp_name'],"../img/{$_FILES['trailer']['tmp_name']}")
}