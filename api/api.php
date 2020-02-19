<?php
//require handler
require_once('ClientHandler.php');
require_once('ManufacturersHandler.php');
require_once('StockHandler.php');
require_once('DealHandler.php');
require_once('AdminHandler.php');

$method = $_SERVER['REQUEST_METHOD'];
$params = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$controller = $params[0];
$input=$_REQUEST;
if(empty($input)){
	$input = json_decode(file_get_contents('php://input'),true);
}
$queryStr = $_SERVER['QUERY_STRING'];

 switch ($controller){
	// route[/api/user]
	case 'client':
		//to-do handler
	 	$clientHandler = new ClientHandler($method,$params,$input);
	 	echo $clientHandler->response();
		break;
	// route[/api/task]
	case 'manufacturers':
		//to-do handler
	 	$manufacturersHandler = new ManufacturersHandler($method,$params,$input);
	 	echo $manufacturersHandler->response();
		break;
	// route[/api/task]
	case 'stock':
	 	//to-do handler
		$stockHandler = new StockHandler($method,$params,$input);
	 	echo $stockHandler->response();
		break;
	case 'deal':
		//to-do handler
		$dealHandler = new DealHandler($method,$params,$input);
	 	echo $dealHandler->response();
		break;
	case 'admin':
		$adminHandler = new AdminHandler($method,$params,$input);
		echo $adminHandler->response();
		break;
	default:
		header("http/ 404");
		echo 'URL Error!';
 }

?>