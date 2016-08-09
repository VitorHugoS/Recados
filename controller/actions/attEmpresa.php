<?php
session_start();
require ("../db/db.php");
require ("../empresas/empresa.php");

$id = trim($_POST["id"]);
$tel1 = trim($_POST["tel1"]);
$tel2 = trim($_POST["tel2"]);
$cel = trim($_POST["cel"]);
$email = trim($_POST["email"]);
$endereco = trim($_POST["endereco"]);
$empresas = trim($_POST["empresa"]);
$cnpj = trim($_POST["cnpj"]);
$texto = trim($_POST["texto"]);

$empresa = new Empresas();
$result = $empresa->atualizarEmpresa($PDO, $id, $tel1, $tel2, $cel, $email, $endereco, $empresas, $cnpj, $texto);

if(!empty($result)){
	echo 1;
}else{
	echo 0;
}
