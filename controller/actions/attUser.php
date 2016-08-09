<?php
session_start();
require ("../db/db.php");
require ("../usuarios/usuario.php");

$id = trim($_POST["id"]);
$user = trim($_POST["user"]);
$senha = trim($_POST["pass"]);
$email = trim($_POST["email"]);
$tipo = intval($_POST["tipo"]);
$id = trim($_POST["id"]);

$usuario = new Usuarios();
$result = $usuario->atualizarUsuario($PDO, $user, $senha, $tipo, $email, $id);

if(!empty($result)){
	echo 1;
}else{
	echo 0;
}
