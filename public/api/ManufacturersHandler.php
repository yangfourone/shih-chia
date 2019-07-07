<?php
//---------------------------------------------------------------------------------UserHandler
require_once('connect.php');
require_once('SimpleRest.php');
require_once('Manufacturers.php');
class ManufacturersHandler extends SimpleRest{
	public $method, $action, $id, $input;
	//constructor
	public function __construct($method,$params,$input){
		$this->method = strtolower($method);
		$this->action = strtolower($params[1]);
		if(isset($params[2]))
			$this->id = strtolower($params[2]);
		if(isset($input))
			$this->input = $input;
	}
	function response(){
		//parsing method 
		switch($this->method){
			case 'get':
				if($this->action == 'getall'){
					$manufacturers_all = new Manufacturers();
					$this->set_status_code($this->encodeJson($manufacturers_all->getAll()));
					break;
				}
				else if($this->action == 'getbyid'){
					$manufacturers_id = new Manufacturers();
					$this->set_status_code($this->encodeJson($manufacturers_id->getById($this->id)));
					break;
				}
			case 'post':
				if($this->action == 'add'){
					$manufacturers_add = new Manufacturers();
					$this->set_status_code($this->encodeJson($manufacturers_add->add($this->input)));
					break;
				}
				else if($this->action == 'update'){
					$manufacturers_update = new Manufacturers();
					$this->set_status_code($this->encodeJson($manufacturers_update->update($this->input)));
					break;
				}
				else if($this->action == 'delete'){
					$manufacturers_delete = new Manufacturers();
					$this->set_status_code($this->encodeJson($manufacturers_delete->delete($this->id)));
					break;
				}
			case 'delete':
				if($this->action == 'delete'){
					$manufacturers_delete = new Manufacturers();
					$this->set_status_code($this->encodeJson($manufacturers_delete->delete($this->id)));
					break;
				}
			default:
				$this ->setHttpHeaders('application/json', 404);
				echo 'URL Error!';
		}
		
	}

	public function set_status_code($responseData) {
		if($responseData == '"NULL"') {
			$this ->setHttpHeaders('application/json', 601);
			//直接key URL錯誤時頁面顯示提醒
			echo 'Error: No data avaliable.';
		}
		else if($responseData == '"EXIST"') {
			$this ->setHttpHeaders('application/json', 602);
			//直接key URL錯誤時頁面顯示提醒
			echo 'Error: This account is already existence.';
		}
		else if($responseData == '"EMPTY"') {
			$this ->setHttpHeaders('application/json', 603);
			//直接key URL錯誤時頁面顯示提醒
			echo 'Error: Data is empty.';
		} 
		else if($responseData =='"LoginFailed"'){
			$this ->setHttpHeaders('application/json', 604);
			//直接key URL錯誤時頁面顯示提醒
			echo 'Error: Authentication fail.';
		}
		else {
			$this ->setHttpHeaders('application/json', 200);
			//Return 正確之資料
			echo $responseData;
		}
	}

	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}
	
	public function encodeXml($responseData) {
		// 创建 SimpleXMLElement 对象
		$xml = new SimpleXMLElement('<?xml version="1.0"?><site></site>');
		foreach($responseData as $key=>$value) {
			$xml->addChild($key, $value);
		}
		return $xml->asXML();
	}
}

?>