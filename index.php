<?php	
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_ALL, 'pt_BR');
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
					$retorno = le($_GET['codigo']);
				}				
				else{
					$op = 2;
					$op = "2";
					$st = 200;
					$retorno = lc();
				}
			}
			else{
				$op = 3;
				$st = 404;
				$retorno = mer($st,"Categoria indisponível ou inexistente");
			}			
		}else{
			$op = 4;
			$st = 404;
			$retorno = mer($st,"Argumentos da requisição inválidos");
		}
		break;
	case 'POST':
		if(isset($_POST['acao']) && !empty($_POST['acao'])){
			switch($_POST['acao']){
				case 'novo':
					$apelido = "";
					if(isset($_POST['apelido-cliente'])){
						$apelido = $_POST['apelido-cliente'];
					}
					$retorno = novo($apelido);
					break;				
				case 'finalizar':
					if(isset($_POST['codigo']) && !empty($_POST['codigo'])){
						$retorno = finaliza($_POST['codigo']);
					}else{
						$op = 4;
						$st = 404;
						$retorno = mer($st,"Argumentos da requisição inválidos");
					}					
					break;					
				case 'cancelar':
					$st = 404;
					$retorno = mer($st,"Ação temporariamente indisponível");
					break;					
				case 'adicionar':
					echo "adicionar";
					break;					
				default:
					$st = 404;
					$retorno = mer($st,"Ação indisponível ou inexistente");
					break;			
			}			
		}else{
			$op = 4;
			$st = 404;
			$retorno = mer($st,"Argumentos da requisição inválidos");
		}	
		break;
	default:
		$st = 405;
		$retorno = mer($st,"Método HTTP não permitido");
		break;	
}
$rm = $_SERVER['REQUEST_METHOD'];
$rt = $_SERVER['REQUEST_TIME'];
$rea = $_SERVER['REMOTE_ADDR'];
rer($op,$st,$rm,$rt,$rea);
header('Content-Type: application/json');
$retorno = json_encode($retorno, true);
echo $retorno;
?>