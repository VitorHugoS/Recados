<?php
session_start();
require ("../db/db.php");
require ("../clientes/clientes.php");
$empresa = trim($_POST["empresa"]);
$nome = trim($_POST["nome"]);
$tel = trim($_POST["tel"]);
$cel = trim($_POST["cel"]);
$email = trim($_POST["email"]);
$cpf = trim($_POST["cpf"]);

$clientes = new Clientes();
$result = $clientes->criarCliente($PDO, $empresa, $nome, $tel, $cel, $email, $cpf);
if(!empty($result)){
	echo 1;
}else{
	echo 0;
}