<?php
//classe para tratamento de produtos
class Produtos{
	//atributos do meu produto
	private $Nome;
	private $Preco;
	private $Imagem;
	private $Id;
	private $Descricao;

	//metodos do meu produto
	public function buscar($PDO, $prod=0, $cat=0)
	{
		//tratamento para id do produto
		$prod=intval($prod); 
		//busca produto especifico, se nao busca todos
		if($prod>0){
			$buscar=$PDO->prepare("SELECT * FROM produto where id=:id order by id desc");
			$buscar->bindValue(":id", $prod, PDO::PARAM_INT);
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
		}elseif($cat==0){
			$buscar=$PDO->query("SELECT * FROM produto order by id desc");
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
		}elseif($cat>0){
			$buscar=$PDO->prepare("SELECT * FROM produto where categoria=:id_cat order by id desc");
			$buscar->bindValue(":id_cat", $cat, PDO::PARAM_INT);
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
		}
	}

	public function criarproduto($nome, $preco, $imagem, $descricao){
		try{
			$inserir=$PDO->prepare("INSERT INTO produto (nome, preco, imagem, descricao) VALUES (:nome, :preco, :imagem, :descricao)");
			$inserir->bindValue(":nome", $nome, PDO::PARAM_STR);
			$inserir->bindValue(":preco", $preco, PDO::PARAM_FLOAT);
			$inserir->bindValue(":imagem", $imagem, PDO::PARAM_STR);
			$inserir->bindValue(":descricao", $descricao, PDO::PARAM_STR);
			$inserir->execute();
			return TRUE;
		}catch (PDOException $e){
			return FALSE;
		}
	}

}