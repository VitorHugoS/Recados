<?php
session_start();
require ("../db/db.php");
require ("../usuarios/usuario.php");

$user = trim($_POST["user"]);
$pass = trim($_POST["pass"]);
$tipo = trim($_POST["tipo"]);
$email = trim($_POST["email"]);

$usuario = new Usuarios();
$result = $usuario->criarUsuario($PDO, $user, $pass, $tipo, $email);
if(!empty($result)){
	echo 1;
}else{
	echo 0;
}
