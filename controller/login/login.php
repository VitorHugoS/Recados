<?php

class Login{
	public function buscarLogin($PDO, $id=0, $usuario, $senha)
	{
		//tratamento para id do user
		$id=intval($id); 
		//busca usuario especifico, se nao busca usuario e senha
		if($id>0){
			$buscar=$PDO->prepare("SELECT * FROM login where id=:id");
			$buscar->bindValue(":id", $id, PDO::PARAM_INT);
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
		}else{
			$buscar=$PDO->prepare("SELECT * FROM login where emailuser=:user and senha = MD5(:senha)");
			$buscar->bindValue(":user", $usuario, PDO::PARAM_STR);
			$buscar->bindValue(":senha", $senha, PDO::PARAM_STR);
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
		}
	}

	public function buscarNotificacoes($PDO, $id=0, $id_usuario=0){
		//tratar ids
		$id=intval($id);
		$id_usuario=intval($id_usuario);
		if($id>0){
		}else{
			$buscar=$PDO->prepare("SELECT * FROM recados r INNER JOIN empresa e on r.empresa = e.id where r.id_usuario=:user and r.concluido = 0 order by r.tipo desc, r.hora desc, r.concluido asc ");
			$buscar->bindValue(":user", $id_usuario, PDO::PARAM_INT);
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
		}
	}

	public function buscarNotificacoesEspecifica($PDO, $id=0, $id_usuario=0, $tipo){
		//tratar ids
		$id=intval($id);
		$id_usuario=intval($id_usuario);
		$tipo=intval($tipo);
		if($tipo==1){
			$buscar=$PDO->prepare("SELECT * FROM recados r INNER JOIN empresa e on r.empresa = e.id where r.id_usuario=:user and r.tipo = 1 and r.concluido = 0");
			$buscar->bindValue(":user", $id_usuario, PDO::PARAM_INT);
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
		}else{
			$buscar=$PDO->prepare("SELECT * FROM recados r INNER JOIN empresa e on r.empresa = e.id where r.id_usuario=:user and r.tipo = 2 and r.concluido = 0");
			$buscar->bindValue(":user", $id_usuario, PDO::PARAM_INT);
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
		}
	}

}