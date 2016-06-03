<?php
//mensagem estado requisição
function mer($estado, $erro){
	return array("solicitacao"=>array("estado"=>$estado,"erro"=>$erro));
}
//retorna lanche específico
function le($codigo){	
	header('Content-Type: application/json');	
	$con = new PDO("mysql:host=localhost;dbname=hummm;charset=utf8", "root", ""); 
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	$sql = "SELECT la.id_lanche, la.nome, la.preco_unitario, GROUP_CONCAT(ins.ingrediente_individual ORDER BY ins.id_ingrediente ASC) AS ingredientes FROM lanche as la, (SELECT l.id_lanche, li.id_ingrediente, CONCAT(i.id_ingrediente,';' ,i.nome) AS ingrediente_individual FROM lanche AS l, lanche_tem_ingrediente AS li, ingrediente AS i WHERE l.id_lanche = li.id_lanche AND li.id_ingrediente = i.id_ingrediente) AS ins WHERE la.id_lanche = ins.id_lanche AND la.id_lanche = ? GROUP BY la.id_lanche ORDER BY la.id_lanche ASC";
	$rs = $con->prepare($sql);		
	$rs->bindParam(1,$codigo);
	$rs->execute();
	while($l = $rs->fetch(PDO::FETCH_OBJ)){
		$id_lanche = (int) $l->id_lanche;
		$nome_lanche = $l->nome;
		$preco_unitario = (float) $l->preco_unitario;		
		$registros = explode(",",$l->ingredientes);
		$ingredientes = array();
		foreach ($registros as $chave => $valor){
			$atributo = explode(";",$valor);
			$ingredientes[] = array("id_ingrediente"=>(int)$atributo[0],"nome"=>$atributo[1]);
		}		
		$retorno = array("id_lanche"=>$id_lanche,
						   "nome_lanche"=>$nome_lanche,
						   "preco_unitario"=>$preco_unitario,
						   "ingredientes"=>$ingredientes);		
	}
	echo json_encode($retorno, true);
}
//retorna cardápio de lanches
function lc(){	
	header('Content-Type: application/json');
	$con = new PDO("mysql:host=localhost;dbname=hummm;charset=utf8", "root", ""); 
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	$sql = "SELECT la.id_lanche, la.nome, la.preco_unitario, GROUP_CONCAT(ins.ingrediente_individual ORDER BY ins.id_ingrediente ASC) AS ingredientes FROM lanche as la, (SELECT l.id_lanche, li.id_ingrediente, CONCAT(i.id_ingrediente,';' ,i.nome) AS ingrediente_individual FROM lanche AS l, lanche_tem_ingrediente AS li, ingrediente AS i WHERE l.id_lanche = li.id_lanche AND li.id_ingrediente = i.id_ingrediente) AS ins WHERE la.id_lanche = ins.id_lanche GROUP BY la.id_lanche ORDER BY la.id_lanche ASC";
	$rs = $con->prepare($sql);	
	$rs->execute();
	while($l = $rs->fetch(PDO::FETCH_OBJ)){
		$id_lanche = (int) $l->id_lanche;
		$nome_lanche = $l->nome;
		$preco_unitario = (float) $l->preco_unitario;		
		$registros = explode(",",$l->ingredientes);
		$ingredientes = array();
		foreach ($registros as $chave => $valor){
			$atributo = explode(";",$valor);
			$ingredientes[] = array("id_ingrediente"=>(int)$atributo[0],"nome"=>$atributo[1]);
		}		
		$retorno[] = array("id_lanche"=>$id_lanche,
						   "nome_lanche"=>$nome_lanche,
						   "preco_unitario"=>$preco_unitario,
						   "ingredientes"=>$ingredientes);		
	}
	echo json_encode($retorno, true);
}
?>