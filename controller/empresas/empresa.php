<?php

class Empresas{
	public function buscarEmpresas($PDO, $id=0)
	{
		//tratamento para id da empresa
		$id=intval($id); 
		//busca empresa especifico, se nao busca todas
		if($id>0){
			$buscar=$PDO->prepare("SELECT * FROM empresa where id=:id");
			$buscar->bindValue(":id", $id, PDO::PARAM_INT);
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
		}else{
			$buscar=$PDO->query("SELECT * FROM empresa order by empresa asc");
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
		}
	}
	public function apagarEmpresa($PDO, $id)
	{
		$apagar = $PDO->prepare("DELETE from cliente where empresa = :id");
		$apagar->bindValue(":id", $id, PDO::PARAM_INT);
		if(!$apagar->execute()){
			return 0;
		}
		$apagar = $PDO->prepare("DELETE from empresa where id = :id");
		$apagar->bindValue(":id", $id, PDO::PARAM_INT);
		if(!$apagar->execute()){
			return 0;
		}
		return 1;
		
	}
	public function criarEmpresa($PDO, $empresa="", $telefonemp1="", $telefonemp2="", $celularemp="", $emailemp="", $enderecoemp="", $cnpj, $texto)
	{
		$inserir = $PDO->prepare("INSERT INTO empresa (empresa, telefonemp1, telefonemp2, celularemp, emailemp, enderecoemp, cnpj, texto) VALUES (:empresa, :telefonemp1, :telefonemp2, :celularemp, :emailemp, :enderecoemp, :cnpj, :texto)");
		$inserir->bindValue(":empresa", $empresa, PDO::PARAM_STR);
		$inserir->bindValue(":telefonemp1", $telefonemp1, PDO::PARAM_STR);
		$inserir->bindValue(":telefonemp2", $telefonemp2, PDO::PARAM_STR);
		$inserir->bindValue(":celularemp", $celularemp, PDO::PARAM_STR);
		$inserir->bindValue(":emailemp", $emailemp, PDO::PARAM_STR);
		$inserir->bindValue(":enderecoemp", $enderecoemp, PDO::PARAM_STR);
		$inserir->bindValue(":cnpj", $cnpj, PDO::PARAM_STR);
		$inserir->bindValue(":texto", $texto, PDO::PARAM_STR);
		if($inserir->execute()){
			return 1;
		}else{
			return 0;
		}
	}
	public function atualizarEmpresa($PDO, $id, $tel1, $tel2, $cel, $email, $end, $emp, $cnpj, $texto)
	{
		$atualizar = $PDO->prepare("UPDATE empresa SET empresa=:empresa, telefonemp1=:tel1, telefonemp2=:tel2, celularemp=:cel, emailemp=:email, enderecoemp=:endd, cnpj=:cnpj, texto=:texto where id = :id");
		$atualizar->bindValue(":empresa", $emp, PDO::PARAM_STR);
		$atualizar->bindValue(":tel1", $tel1, PDO::PARAM_STR);
		$atualizar->bindValue(":tel2", $tel2, PDO::PARAM_STR);
		$atualizar->bindValue(":cel", $cel, PDO::PARAM_STR);
		$atualizar->bindValue(":email", $email, PDO::PARAM_STR);
		$atualizar->bindValue(":endd", $end, PDO::PARAM_STR);
		$atualizar->bindValue(":id", $id, PDO::PARAM_INT);
		$atualizar->bindValue(":cnpj", $cnpj, PDO::PARAM_STR);
		$atualizar->bindValue(":texto", $texto, PDO::PARAM_STR);
		if($atualizar->execute()){
			return 1;
		}else{
			return 0;
		}
	}
}