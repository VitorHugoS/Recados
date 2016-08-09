<?php
//classe para tratamento do menu princial
class Menu{
	//metodos categorias
	public function buscarMenu($PDO, $id=0)
	{
		//tratamento para id do Menu
		$id=intval($id); 
		//busca categoria especifica, se nao busca todas
		if($id>0){
			$buscar=$PDO->prepare("SELECT * FROM menu where id=:id");
			$buscar->bindValue(":id", $id, PDO::PARAM_INT);
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
		}else{
			$buscar=$PDO->query("SELECT * FROM menu order by id asc");
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
		}
	}

	public function criarMenu($PDO, $nome, $url){
		try{
			$inserir=$PDO->prepare("INSERT INTO menu (nome, url) VALUES (:nome, :url)");
			$inserir->bindValue(":nome", $nome, PDO::PARAM_STR);
			$inserir->bindValue(":url", $url, PDO::PARAM_STR);
			$inserir->execute();
			return TRUE;
		}catch (PDOException $e){
			return FALSE;
		}
	}

}