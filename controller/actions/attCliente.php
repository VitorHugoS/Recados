<?php
session_start();
require ("../db/db.php");
require ("../clientes/clientes.php");
$idt = trim($_POST["idt"]);
$nomet = trim($_POST["nomet"]);
$telt = trim($_POST["telt"]);
$celt = trim($_POST["celt"]);
$emailt = trim($_POST["emailt"]);
$empresa = trim($_POST["empresa"]);
$cpf = trim($_POST["cpf"]);

$clientes = new Clientes();
$result = $clientes->atualizarCliente($PDO, $idt, $nomet, $telt, $celt, $emailt, $empresa, $cpf);
if(!empty($result)){
	echo 1;
}else{
	echo 0;
}