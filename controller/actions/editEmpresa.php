<?php
session_start();
require ("../db/db.php");
require ("../empresas/empresa.php");

$id = trim($_POST["id"]);

$empresa = new Empresas();
$result = $empresa->buscarEmpresas($PDO, $id);
$result = json_encode($result);
if(!empty($result)){
	echo $result;
}else{
	echo 0;
}
