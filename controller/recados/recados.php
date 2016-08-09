<?php

class Recados{
	public function buscarRecados($PDO, $id=0, $id_usuario=0){
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

	public function criarRecado($PDO, $id_usuario=0, $id_usuario_criador=0, $tipo=0, $empresa, $titulo, $texto, $concluido=0, $hash){
		//hora da criacao do recado
		date_default_timezone_set('America/Sao_Paulo');
		$atual = date("Y-m-d H:i:s");   

		//insercao no bd 
		$inserir = $PDO->prepare("INSERT INTO recados (id_usuario, tipo, empresa, titulo, texto, concluido, visto, hora, create_user, hash) VALUES (:id_usuario, :tipo, :empresa, :titulo, :texto, :concluido, :visto, :hora, :id_usuario_criador, :hash)");
		$inserir->bindValue(":id_usuario", $id_usuario, PDO::PARAM_INT);
		$inserir->bindValue(":tipo", $tipo, PDO::PARAM_INT);
		$inserir->bindValue(":empresa", $empresa, PDO::PARAM_INT);
		$inserir->bindValue(":titulo", $titulo, PDO::PARAM_STR);
		$inserir->bindValue(":texto", $texto, PDO::PARAM_STR);
		$inserir->bindValue(":concluido", $concluido, PDO::PARAM_INT);
		$inserir->bindValue(":visto", "0000-00-00 00:00:00", PDO::PARAM_STR);
		$inserir->bindValue(":hora", $atual, PDO::PARAM_STR);
		$inserir->bindValue(":id_usuario_criador", $id_usuario_criador, PDO::PARAM_INT);
		$inserir->bindValue(":hash", $hash, PDO::PARAM_STR);
		if($inserir->execute()){
			return 1;
		}else{
			return 0;
		}
	}

	public function atualizarRecado($PDO, $hash){
		$atualizar = $PDO->prepare("UPDATE recados set concluido = 1 where hash = :hash");
		$atualizar->bindValue(":hash", $hash, PDO::PARAM_STR);
		if($atualizar->execute()){
			return 1;
		}else{
			return 0;
		}
	}

}