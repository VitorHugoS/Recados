<?php
//classe para tratamento de categorias
class Categorias{
	//atributos da categoria
	private $Nome;
	private $Id;

	//metodos categorias
	public function buscar($PDO, $id=0)
	{
		//tratamento para id da categoria
		$id=intval($id); 
		//busca categoria especifica, se nao busca todas
		if($id>0){
			$buscar=$PDO->prepare("SELECT * FROM categorias where id=:id order by id desc");
			$buscar->bindValue(":id", $id, PDO::PARAM_INT);
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
		}else{
			$buscar=$PDO->query("SELECT * FROM categorias order by id desc");
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
		}
	}

	public function criarcategoria($nome, $icone){
		try{
			$inserir=$PDO->prepare("INSERT INTO categorias (nome, icone) VALUES (:nome, :icone)");
			$inserir->bindValue(":nome", $nome, PDO::PARAM_STR);
			$inserir->bindValue(":icone", $icone, PDO::PARAM_STR);
			$inserir->execute();
			return TRUE;
		}catch (PDOException $e){
			return FALSE;
		}
	}

}