<?php

class Clientes{
	public function buscarClientes($PDO, $id=0)
	{
		//tratamento para id do user
		$id=intval($id); 
		//busca usuario especifico, se nao busca usuario e senha
		if($id>0){
			$buscar=$PDO->prepare("SELECT * FROM cliente where id=:id");
			$buscar->bindValue(":id", $id, PDO::PARAM_INT);
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
		}else{
			$buscar=$PDO->query("SELECT c.*, e.id AS idEmp, e.empresa AS nomeEmp FROM cliente c left JOIN empresa e on c.empresa = e.id order by c.nome asc");
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
		}
	}
	public function criarCliente($PDO, $empresa="", $nome="", $tel="", $cel="", $email="", $cpf)
	{
		$inserir = $PDO->prepare("INSERT INTO cliente (nome, telefone, empresa, email, celular, cpf) VALUES (:nome, :telefone, :empresa, :email, :celular, :cpf)");
		$inserir->bindValue(":nome", $nome, PDO::PARAM_STR);
		$inserir->bindValue(":telefone", $tel, PDO::PARAM_STR);
		$inserir->bindValue(":empresa", $empresa, PDO::PARAM_STR);
		$inserir->bindValue(":email", $email, PDO::PARAM_STR);
		$inserir->bindValue(":celular", $cel, PDO::PARAM_STR);
		$inserir->bindValue(":cpf", $cpf, PDO::PARAM_STR);
		if($inserir->execute()){
			return 1;
		}else{
			return 0;
		}
	}
	public function atualizarCliente($PDO, $idt, $nomet, $telt, $celt, $emailt, $empresa, $cpf)
	{
		if($empresa==0){
			$atualizar = $PDO->prepare("UPDATE cliente SET nome=:nome, telefone=:tel, email=:email, celular=:celular, cpf=:cpf where id = :id");
			$atualizar->bindValue(":nome", $nomet, PDO::PARAM_STR);
			$atualizar->bindValue(":tel", $telt, PDO::PARAM_STR);
			$atualizar->bindValue(":email", $emailt, PDO::PARAM_STR);
			$atualizar->bindValue(":celular", $celt, PDO::PARAM_STR);
			$atualizar->bindValue(":id", $idt, PDO::PARAM_INT);
			$atualizar->bindValue(":cpf", $cpf, PDO::PARAM_STR);
		}else{
			$atualizar = $PDO->prepare("UPDATE cliente SET nome=:nome, telefone=:tel, empresa=:empresa, email=:email, celular=:celular, cpf=:cpf where id = :id");
			$atualizar->bindValue(":nome", $nomet, PDO::PARAM_STR);
			$atualizar->bindValue(":tel", $telt, PDO::PARAM_STR);
			$atualizar->bindValue(":empresa", $empresa, PDO::PARAM_STR);
			$atualizar->bindValue(":email", $emailt, PDO::PARAM_STR);
			$atualizar->bindValue(":celular", $celt, PDO::PARAM_STR);
			$atualizar->bindValue(":id", $idt, PDO::PARAM_INT);
			$atualizar->bindValue(":cpf", $cpf, PDO::PARAM_STR);
		}
		if($atualizar->execute()){
			return 1;
		}else{
			return 0;
		}
	}
	public function apagarCliente($PDO, $id)
	{
		$apagar = $PDO->prepare("DELETE from cliente where id = :id");
		$apagar->bindValue(":id", $id, PDO::PARAM_INT);
		if($apagar->execute()){
			return 1;
		}else{
			return 0;
		}
	}
}