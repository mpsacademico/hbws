<?php
//mensagem estado requisição
function mer($estado, $erro){
	return array("solicitacao"=>array("estado"=>$estado,"mensagem"=>$erro));
}
//retorna lanche específico
function le($codigo){		
	require('conexao.php');
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
	return $retorno;
}
//retorna cardápio de lanches
function lc(){		
	require('conexao.php');
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
	return $retorno;
}
//registra um novo pedido
function novo($apelido_cliente){
	require('conexao.php');
	$sql = "INSERT INTO pedido(id_pedido, apelido_cliente, ts_abertura) VALUES (null, ?, FROM_UNIXTIME(?))";
	$rs = $con->prepare($sql);
	$rs->bindParam(1,$apelido_cliente);
	$rs->bindParam(2,time());
	$r = $rs->execute();
	$retorno = array();
	if($r){
		$retorno = mer(200,"Pedido inserido com sucesso!");
		$retorno['pedido'] = array("codigo"=>(int)$con->lastInsertId());
	}
	else{
		$retorno = mer(503,"Inserção de pedido falhou!");
	}
	return $retorno;
}
//finaliza um pedido aberto - sem total e validação
function finaliza($codigo){
	require('conexao.php');
	$sql = "UPDATE pedido SET ts_fechamento = FROM_UNIXTIME(?) WHERE id_pedido = ?";
	$rs = $con->prepare($sql);	
	$rs->bindParam(1,time());
	$rs->bindParam(2,$codigo);
	$r = $rs->execute();
	$retorno = array();
	if($r){
		$retorno = mer(200,"Pedido finalizado com sucesso!");
		$retorno['pedido'] = array("total"=>total_pedido($codigo));
	}
	else{
		$retorno = mer(503,"Finalização de pedido falhou!");
	}
	return $retorno;
}
//adiciona mercadorias a um pedido - sem confirmação
function adiciona($codigo_pedido, $mercadorias){
	require('conexao.php');
	$ms = json_decode($mercadorias, true);
	$sql = "INSERT INTO pedido_tem_lanche(id_pedido, id_lanche, quantidade) VALUES (?, ?, ?)";
	foreach ($ms as $key => $value){
		$rs = $con->prepare($sql);
		$rs->bindParam(1,$codigo_pedido);
		$rs->bindParam(2,$value['id-mercadoria']);
		$rs->bindParam(3,$value['quantidade']);	
		$r = $rs->execute();
	}
	return mer(200,"Mercadorias adicionadas com sucesso!");
}
//calcula valor total de um pedido
function total_pedido($codigo){
	require('conexao.php');
	$sql = "SELECT SUM(quantidade*preco_unitario) AS total FROM pedido_tem_lanche AS pl, lanche AS l WHERE pl.id_lanche = l.id_lanche AND pl.id_pedido = ?";
	$rs = $con->prepare($sql);		
	$rs->bindParam(1,$codigo);
	$rs->execute();
	while($l = $rs->fetch(PDO::FETCH_OBJ)){
		$total = $l->total;
	}
	return (float) $total;
}
//registra estatísticas de requisição
function rer($op, $st, $rm, $rt, $rea){
	require('conexao.php');
	$sql = "INSERT INTO rstat(operacao, status, request_method, request_time, remote_addr) VALUES (?, ?, ?, FROM_UNIXTIME(?), ?)";
	$rs = $con->prepare($sql);
	$rs->bindParam(1,$op);
	$rs->bindParam(2,$st);
	$rs->bindParam(3,$rm);
	$rs->bindParam(4,$rt);
	$rs->bindParam(5,$rea);
	$rs->execute();
}
?>