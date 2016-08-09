<?php
session_start();
require ("../db/db.php");
require ("../login/login.php");

$user = trim($_POST["user"]);
$pass = trim($_POST["pass"]);

$login = new Login();
$result = $login->buscarLogin($PDO, 0, $user, $pass);
if(!empty($result)){
	$_SESSION["login"]=$result;
	echo 1;
}else{
	$_SESSION["login"]=NULL;
	session_destroy();
	echo 0;
}
