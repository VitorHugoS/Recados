<?php

class Usuarios{
	public function buscarUsuario($PDO, $id=0)
	{
		//tratamento para id do user
		$id=intval($id); 
		//busca usuario especifico, se nao busca todos
		if($id>0){
			$buscar=$PDO->prepare("SELECT * FROM login where id=:id");
			$buscar->bindValue(":id", $id, PDO::PARAM_INT);
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
		}else{
			$buscar=$PDO->query("SELECT * FROM login order by usuario asc");
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
		}
	}

	public function buscarUsuarioId($PDO, $name="")
	{
			$buscar=$PDO->prepare("SELECT id FROM login where user_name=:id");
			$buscar->bindValue(":id", $name, PDO::PARAM_INT);
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
	}

	public function criarUsuario($PDO, $user, $senha, $tipo=2, $email="")
	{
		$inserir = $PDO->prepare("INSERT INTO login (usuario, senha, tipo, emailuser) VALUES (:user, MD5(:senha), :tipo, :email)");
		$inserir->bindValue(":user", $user, PDO::PARAM_STR);
		$inserir->bindValue(":senha", $senha, PDO::PARAM_STR);
		$inserir->bindValue(":tipo", $tipo, PDO::PARAM_INT);
		$inserir->bindValue(":email", $email, PDO::PARAM_STR);

		if($inserir->execute()){
			return 1;
		}else{
			return 0;
		}
	}

	public function atualizarUsuario($PDO, $user, $senha="", $tipo, $email="", $id)
	{
		if(empty($id))
			return 0;

		if(empty($senha)){
			$atualizar = $PDO->prepare("UPDATE login set usuario = :usuario, tipo = :tipo, emailuser = :email where id = :id");
			$atualizar->bindValue("usuario", $user, PDO::PARAM_STR);
			$atualizar->bindValue("tipo", $tipo, PDO::PARAM_INT);
			$atualizar->bindValue("email", $email, PDO::PARAM_STR);
			$atualizar->bindValue("id", $id, PDO::PARAM_INT);
		}else{
			$atualizar = $PDO->prepare("UPDATE login set usuario = :usuario, senha = MD5(:senha),tipo = :tipo, emailuser = :email where id = :id");
			$atualizar->bindValue("usuario", $user, PDO::PARAM_STR);
			$atualizar->bindValue("senha", $senha, PDO::PARAM_STR);
			$atualizar->bindValue("tipo", $tipo, PDO::PARAM_INT);
			$atualizar->bindValue("email", $email, PDO::PARAM_STR);
			$atualizar->bindValue("id", $id, PDO::PARAM_INT);
		}
		if($atualizar->execute()){
			return 1;
		}else{
			return 0;
		}
	}

	public function buscarNotificacoes($PDO, $id=0, $id_usuario=0){
		//tratar ids
		$id=intval($id);
		$id_usuario=intval($id_usuario);
		if($id>0){
		}else{
			$buscar=$PDO->prepare("SELECT * FROM recados r INNER JOIN empresa e on r.empresa = e.id where r.create_user=:user order by r.tipo desc, r.hora desc, r.concluido asc ");
			$buscar->bindValue(":user", $id_usuario, PDO::PARAM_INT);
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
		}
	}

	public function apagarUsuario($PDO, $id)
	{
		$apagar = $PDO->prepare("DELETE from recados where id_usuario = :id");
		$apagar->bindValue(":id", $id, PDO::PARAM_STR);
		if(!$apagar->execute()){
			return 0;
		}
		$apagar = $PDO->prepare("DELETE from calendario where id_usuario = :id");
		$apagar->bindValue(":id", $id, PDO::PARAM_STR);
		if(!$apagar->execute()){
			return 0;
		}
		$apagar = $PDO->prepare("DELETE from login where id = :id");
		$apagar->bindValue(":id", $id, PDO::PARAM_STR);
		if(!$apagar->execute()){
			return 0;
		}
		return 1;
	}
}