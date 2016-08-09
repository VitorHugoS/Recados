<?php
session_start();
require ("../db/db.php");
require ("../calendario/calendario.php");
$id = trim($_POST["id"]);

$calendario = new Calendario();
$result = $calendario->buscarEventos($PDO, $id);
$novo = json_encode($result);

echo $novo;