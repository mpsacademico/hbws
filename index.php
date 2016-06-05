<?php	
$retorno = array();
$op = 0;
$st = 0;
require_once("funcoes.php");
switch($_SERVER['REQUEST_METHOD']){
	case 'GET':		
		if(isset($_GET['categoria']) && !empty($_GET['categoria'])){			
			if(strcmp($_GET['categoria'],"lanche")==0){				
				if(isset($_GET['codigo']) && !empty($_GET['codigo'])){
					$op = 1;
					$st = 200;
					le($_GET['codigo']);
				}				
				else{
					$op = 2;
					$op = "2";
					$st = 200;
					lc();
				}
			}
			else{
				$op = 3;
				$st = 404;
				$retorno = mer("404","Categoria indisponível ou inexistente");
			}			
		}else{
			$op = 4;
			$st = 404;
			$retorno = array("estado"=>"404","erro"=>"Argumentos da requisição inválidos");
		}
		break;
	case 'POST':	
		break;
	default:
		$st = 405;
		$retorno = array("requisicao"=>array("estado"=>"405","erro"=>"Método HTTP não permitido"));
		break;	
}	
	$rm = $_SERVER['REQUEST_METHOD'];
	$rt = $_SERVER['REQUEST_TIME'];
	$rea = $_SERVER['REMOTE_ADDR'];
	rer($op, $st,$rm,$rt,$rea);
//header('Content-Type: application/json');
//$retorno = json_encode($retorno,true);
//echo $retorno;
?>