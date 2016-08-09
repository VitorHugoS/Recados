<?php
session_start();
require ("../db/db.php");
require ("../usuarios/usuario.php");

$id = trim($_POST["id"]);

$usuario = new Usuarios();
$result = $usuario->buscarUsuario($PDO, $id);
$result = json_encode($result);
if(!empty($result)){
	echo $result;
}else{
	echo 0;
}
