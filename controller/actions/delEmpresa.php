<?php
session_start();
require ("../db/db.php");
require ("../empresas/empresa.php");
$id = trim($_POST["id"]);

$empresas = new Empresas();
$result = $empresas->apagarEmpresa($PDO, $id);
if(!empty($result)){
	echo 1;
}else{
	echo 0;
}