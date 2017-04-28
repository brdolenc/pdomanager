<?php

	require_once('pdomanager.class.php');
	
	$pdo = new PDO_Manager('localhost','clube_tres','root','');
	$retorno = $pdo->table("cadastros")
					->condition("id", ">", 0)
					->condition("nome", "like", '%bruno%' , "OR")
					->limit(0,100)
					->orderby('id','ASC')
					->orderby('nome','DESC')
					->groupby('id')
					->ready('*', 'echo');
	
	var_dump($retorno);
	echo $pdo->count();
	$pdo->close();


	$retorno = $pdo->table("cadastros")
					->condition("id", ">", 0)
					->condition("nome", "like", '%bruno%' , "OR")
					->limit(0,100)
					->orderby('id','ASC')
					->orderby('nome','DESC')
					->groupby('id')
					->ready('*', 'echo');
	
	var_dump($retorno);
	echo $pdo->count();
	$pdo->close();
	

?>