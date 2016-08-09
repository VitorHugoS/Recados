<?php
//classe para tratar urls
class Url{


	//funcao que trata a rota, recebe url e retorna posicao especifica
	public function rota($url, $posicao)
	{
		$tratarurl = explode("/", $url);
		$urlTotal=count($tratarurl);
		switch ($posicao) {
			case 2:
			return $tratarurl[$posicao];
			break;
			case 3:
			if($urlTotal==4 && !empty($tratarurl[$posicao])){
				return $tratarurl[$posicao];
			}else{
				return 404;
			}
			break;
			default:
				return 404;
			break;
		}
	}
}