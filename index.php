<?php	
$retorno = array();
require_once("funcoes.php");
switch($_SERVER['REQUEST_METHOD']){
	case 'GET':
		if(isset($_GET['categoria']) && !empty($_GET['categoria'])){
			if(strcmp($_GET['categoria'],"lanche")==0){
				if(isset($_GET['codigo']) && !empty($_GET['codigo'])){
					//echo "categoria lanche com id";
					le($_GET['codigo']);
				}				
				else{
					echo "todos";
				}
			}
			else{
				$retorno = mer("XXX","Categoria indisponível ou inexistente");
			}			
		}else{
			$retorno = array("estado"=>"XXX","erro"=>"Argumentos da requisição inválidos");
		}
		break;
	case 'POST':	
		break;
	default:
		$retorno = array("requisicao"=>array("estado"=>"404","erro"=>"Método HTTP não permitido"));
		break;	
}	
//header('Content-Type: application/json');
$retorno = json_encode($retorno,true);
//echo $retorno;
?>