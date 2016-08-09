<?php
session_start();
require ("../db/db.php");
require ("../recados/recados.php");

$usuario = trim($_POST["usuario"]);
$empresa = trim($_POST["empresa"]);
$prioridade = trim($_POST["prioridade"]);
$titulo = trim($_POST["titulo"]);
$texto = trim($_POST["texto"]);
$idu = trim($_POST["idu"]);
$concluido = 0;
$hash = substr(md5(mt_rand()), 0, 5);
$recado = new Recados();
$result = $recado->criarRecado($PDO, $usuario, $idu, $prioridade, $empresa, $titulo, $texto, $concluido, $hash);
if(!empty($result)){
	echo 1;
}else{
	echo 0;
}