<?php

  try{
		
		$PDO = new PDO("mysql:host=localhost;dbname=banco", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	}catch (PDOException $e){
	print_r ($e -> getMessage());
		
	}
  
