<?php
session_start();
require ("../db/db.php");
require ("../usuarios/usuario.php");

$id = trim($_POST["id"]);


$usuario = new Usuarios();
$result = $usuario->apagarUsuario($PDO, $id);
if(!empty($result)){
	echo 1;
}else{
	echo 0;
}
