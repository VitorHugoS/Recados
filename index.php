<?php
session_start();
require_once './vendor/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
require "./controller/funcoes.php";

//carrega minhas views
$loader = new Twig_Loader_Filesystem('views');

$usuario = new Login();
if(empty($_SESSION["login"])){
	$_SESSION["login"] = array();
}else{
	$normal = $usuario->buscarNotificacoesEspecifica($PDO, 0, $_SESSION["login"][0]["id"], 1);
	$urgente = $usuario->buscarNotificacoesEspecifica($PDO, 0, $_SESSION["login"][0]["id"], 2);
}
//titulo
$titulo = "ATA Design";
$twig = new Twig_Environment($loader);
$twig->addExtension(new Twig_Extension_Debug());

//instancia classes
$url=new Url();
$clientes = new Clientes();
$empresas = new Empresas();
$usuarios = new Usuarios();
$calendario = new Calendario();

$urlBase = "http://localhost/sis/";
$redirect=$url->rota($_SERVER['REQUEST_URI'], 2);

//rotas
if(!empty($_SESSION["login"])){
	switch ($redirect) {
	case 'admin':
	$result = $calendario->buscarEventos($PDO, $_SESSION["login"][0]["id"]);
	$novo = json_encode($result);
	$dados2 = $usuarios->buscarUsuario($PDO, 0);
	echo $twig->render('index.html', array(
		'Titulo' => 'Home - '.$titulo,
		'Css' => "views/",
		'totalNotificacoes' => (count($normal)+count($urgente)),
		'normal' => $normal,
		'urgente' => $urgente,
		'urlBase' => $urlBase, 
		'usuario' => $_SESSION["login"],
		'calendario' => $novo,
		'usuarios' => $dados2
		));
	break;
	case '':
	$result = $calendario->buscarEventos($PDO, $_SESSION["login"][0]["id"]);
	$novo = json_encode($result);
	$dados2 = $usuarios->buscarUsuario($PDO, 0);
	echo $twig->render('index.html', array(
		'Titulo' => 'Home - '.$titulo,
		'Css' => "views/",
		'totalNotificacoes' => (count($normal)+count($urgente)),
		'normal' => $normal,
		'urgente' => $urgente,
		'urlBase' => $urlBase,
		'usuario' => $_SESSION["login"],
		'calendario' => $novo,
		'usuarios' => $dados2
		));
	break;
	case 'recados':
	$dados = $usuario->buscarNotificacoes($PDO, 0, $_SESSION["login"][0]["id"]);
	$dados1 = $empresas->buscarEmpresas($PDO, 0);
	$dados2 = $usuarios->buscarUsuario($PDO, 0);
	$dados3 = $usuarios->buscarNotificacoes($PDO, 0, $_SESSION["login"][0]["id"]);
	echo $twig->render('recados.html', array(
		'Titulo' => 'Recados - '.$titulo,
		'Css' => "views/",
		'totalNotificacoes' => (count($normal)+count($urgente)),
		'normal' => $normal,
		'dados' => $dados,
		'urgente' => $urgente,
		'urlBase' => $urlBase,
		'usuario' => $_SESSION["login"],
		'empresa' => $dados1,
		'usuarios' => $dados2,
		'enviados' => $dados3
		));
	break;
	case 'horarios':
	$espe=$url->rota($_SERVER['REQUEST_URI'], 3);
		if($espe!="404"){
			$dados = $usuario->buscarNotificacoes($PDO, 0, $_SESSION["login"][0]["id"]);
			$dados2 = $usuarios->buscarUsuario($PDO, 0);
			$iduser = $usuarios->buscarUsuarioId($PDO, $espe);
			$result = $calendario->buscarEventos($PDO, $iduser[0]["id"]);
			$novo = json_encode($result);
			echo $twig->render('horario.html', array(
				'Titulo' => 'Horários - '.$titulo,
				'Css' => "views/",
				'totalNotificacoes' => (count($normal)+count($urgente)),
				'normal' => $normal,
				'dados' => $dados,
				'urgente' => $urgente,
				'urlBase' => $urlBase,
				'usuario' => $_SESSION["login"],
				'usuarios' => $iduser[0]["id"],
				'calendario' => $novo
				));
		}else{
			$dados = $usuario->buscarNotificacoes($PDO, 0, $_SESSION["login"][0]["id"]);
			$dados2 = $usuarios->buscarUsuario($PDO, 0);
			echo $twig->render('horarios.html', array(
				'Titulo' => 'Horários - '.$titulo,
				'Css' => "views/",
				'totalNotificacoes' => (count($normal)+count($urgente)),
				'normal' => $normal,
				'dados' => $dados,
				'urgente' => $urgente,
				'urlBase' => $urlBase,
				'usuario' => $_SESSION["login"],
				'usuarios' => $dados2,
				));
		}
	break;
	case 'clientes':
	$dados = $clientes->buscarClientes($PDO, 0);
	$dados1 = $empresas->buscarEmpresas($PDO, 0);
	echo $twig->render('clientes.html', array(
		'Titulo' => 'Clientes - '.$titulo,
		'Css' => "views/",
		'totalNotificacoes' => (count($normal)+count($urgente)),
		'normal' => $normal,
		'clientes' => $dados,
		'urgente' => $urgente,
		'urlBase' => $urlBase,
		'usuario' => $_SESSION["login"],
		'empresa' => $dados1
		));
	break;
	case 'empresas':
	$dados = $empresas->buscarEmpresas($PDO, 0);
	echo $twig->render('empresas.html', array(
		'Titulo' => 'Empresas - '.$titulo,
		'Css' => "views/",
		'totalNotificacoes' => (count($normal)+count($urgente)),
		'normal' => $normal,
		'clientes' => $dados,
		'urgente' => $urgente,
		'urlBase' => $urlBase,
		'usuario' => $_SESSION["login"]
		));
	break;
	case 'usuarios':
	$dados = $usuarios->buscarUsuario($PDO, 0);
	echo $twig->render('usuarios.html', array(
		'Titulo' => 'Usuários - '.$titulo,
		'Css' => "views/",
		'totalNotificacoes' => (count($normal)+count($urgente)),
		'normal' => $normal,
		'usuarios' => $dados,
		'urgente' => $urgente,
		'urlBase' => $urlBase,
		'usuario' => $_SESSION["login"]
		));
	break;
	case 'logout':
	session_destroy();
	echo $twig->render('login.html', array(
		'Titulo' => 'Login - '.$titulo,
		'Pagina' => "Home",
		'Css' => "views/",
		'urlBase' => $urlBase
		));
	break;
	default:
		echo $twig->render('index.html', array(
		'Titulo' => '404 - '.$titulo,
		'Css' => "views/",
		'urlBase' => $urlBase,
		'usuario' => $_SESSION["login"]
		));
	break;
	}
}else{
	echo $twig->render('login.html', array(
		'Titulo' => 'Login - '.$titulo,
		'Pagina' => "Home",
		'Css' => "views/",
		'urlBase' => $urlBase
		));
}

