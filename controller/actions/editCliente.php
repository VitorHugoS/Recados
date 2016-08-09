<?php
session_start();
require ("../db/db.php");
require ("../clientes/clientes.php");
$id = trim($_POST["id"]);


$clientes = new Clientes();
$result = $clientes->buscarClientes($PDO, $id);
$novo = json_encode($result);
if(!empty($novo)){
	echo $novo;
}else{
	echo 0;
}