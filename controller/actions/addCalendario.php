<?php
session_start();
require ("../db/db.php");
require ("../calendario/calendario.php");
$id = trim($_POST["id"]);
$lugar = trim($_POST["lugar"]);
$dia = trim($_POST["dia"]);
$saida = trim($_POST["saida"]);
$chegada = trim($_POST["chegada"]);

$calendario = new Calendario();
$result = $calendario->inserirEvento($PDO, $id, $lugar, $dia, $saida, $chegada);
echo $result;