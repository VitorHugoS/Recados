<?php
session_start();
require ("../db/db.php");
require ("../empresas/empresa.php");
$empresa = trim($_POST["empresa"]);
$telefonemp1 = trim($_POST["telefonemp1"]);
$telefonemp2 = trim($_POST["telefonemp2"]);
$celularemp = trim($_POST["celularemp"]);
$emailemp = trim($_POST["emailemp"]);
$enderecoemp = trim($_POST["enderecoemp"]);
$cnpj = trim($_POST["cnpj"]);
$texto = trim($_POST["texto"]);

$empresas = new Empresas();
$result = $empresas->criarEmpresa($PDO, $empresa, $telefonemp1, $telefonemp2, $celularemp, $emailemp, $enderecoemp, $cnpj, $texto);
if(!empty($result)){
	echo 1;
}else{
	echo 0;
}