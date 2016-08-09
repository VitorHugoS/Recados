<?php
session_start();
require ("../db/db.php");
require ("../recados/recados.php");

$id = trim($_POST["id"]);
$recado = new Recados();
$result = $recado->atualizarRecado($PDO, $id);
if(!empty($result)){
	echo 1;
}else{
	echo 0;
}