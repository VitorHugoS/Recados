<?php
session_start();
require ("../db/db.php");
require ("../clientes/clientes.php");
$id = trim($_POST["id"]);

$clientes = new Clientes();
$result = $clientes->apagarCliente($PDO, $id);
if(!empty($result)){
	echo 1;
}else{
	echo 0;
}