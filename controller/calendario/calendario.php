<?php
class Calendario{
	public function buscarEventos($PDO, $id=0)
	{
		//tratamento para id do user
		$id=intval($id); 
		//buscar eventos
			$buscar=$PDO->prepare("SELECT date, title, url, timeStart, timeEnd FROM calendario where id_usuario = :id");
			$buscar->bindValue(":id", $id, PDO::PARAM_INT);
			$buscar->execute();
			$lista=$buscar->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
	}
	public function inserirEvento($PDO, $id, $lugar, $dia, $saida, $chegada)
	{
			//buscar eventos
			$inserir=$PDO->prepare("INSERT INTO calendario (date, title, url, timeStart, timeEnd, id_usuario) VALUES (:data, :title, :url, :timeStart, :timeEnd, :id_user)");
			$inserir->bindValue(":data", $dia, PDO::PARAM_STR);
			$inserir->bindValue(":title", $lugar, PDO::PARAM_STR);
			$inserir->bindValue(":url", "javascript:void(0)", PDO::PARAM_STR);
			$inserir->bindValue(":timeStart", $saida, PDO::PARAM_STR);
			$inserir->bindValue(":timeEnd", $chegada, PDO::PARAM_STR);
			$inserir->bindValue(":id_user", $id, PDO::PARAM_INT);
			if($inserir->execute()){
				return 1;
			}else{
				return 0;
			}
			
	}
}