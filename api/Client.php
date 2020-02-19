<?php
//-----------------------------------------------------------------------------client
//response by method
class Client{
	
	function getAll(){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"client");
		//query data by method
		$getAll_sql = "SELECT * FROM client";
		$getAll_result = mysqli_query($con,$getAll_sql);

		$getAll_dataArray = array();

		if(mysqli_num_rows($getAll_result) == 0) {
			return 'NULL';
		}
		else {
			while ($row = mysqli_fetch_array($getAll_result,MYSQLI_ASSOC)) {
				$getAll_dataArray[] = $row;
			}
			//$getAll_dataArray = mysqli_fetch_array($getAll_result,MYSQLI_ASSOC);
 			return $getAll_dataArray;
		}
	}
	function getById($id){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"client");
		
		//query data by method
		$getById_sql = "SELECT * FROM client WHERE N = '$id'";
		$getById_result = mysqli_query($con,$getById_sql);

		if(mysqli_num_rows($getById_result) == 0) {
			return 'NULL';
		}
		else {
			$getById_dataArray = mysqli_fetch_array($getById_result,MYSQLI_ASSOC);
			return $getById_dataArray;
		}
	}

	function add($input){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"client");

		$name = $input['name'];
		$address = $input['address'];
		$phone = $input['phone'];
		$fax = $input['fax'];
		$uniform_number = $input['uniform_number'];
		$email = $input['email'];
		$cellphone = $input['cellphone'];
		$comment = $input['comment'];

		if(!isset($name)||empty($name)||!isset($address)||!isset($phone)||!isset($fax)||!isset($uniform_number)||!isset($cellphone)||!isset($email)||!isset($comment)){
			return 'EMPTY';
		}
		else {
			$sql_check = "SELECT * FROM client WHERE name = '$name'";
			$check_result = mysqli_query($con,$sql_check);
			if(mysqli_num_rows($check_result) == 0) {
				$sql_insert = "INSERT INTO client (name,address,phone,fax,uniform_number,email,cellphone,comment) VALUES ('$name','$address','$phone','$fax','$uniform_number','$email','$cellphone','$comment')";
				$add_result = mysqli_query($con,$sql_insert);
				return 'ok';
			}
			else {	
				return 'EXIST';
			}
		}
	}

	function delete($id){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"client");

		$sql_check = "SELECT * FROM client WHERE N = '$id'";
		$check_result = mysqli_query($con,$sql_check);
		if(mysqli_num_rows($check_result) == 0) {
			return 'NULL';
		}
		else {
			$sql_delete = "DELETE FROM client WHERE N = '$id'";
			$del_result = mysqli_query($con,$sql_delete);	
			return 'ok';
		}
	}
	
	function update($input){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"client");

		$N = $input['N'];
		$name = $input['name'];
		$address = $input['address'];
		$phone = $input['phone'];
		$fax = $input['fax'];
		$uniform_number = $input['uniform_number'];
		$email = $input['email'];
		$cellphone = $input['cellphone'];
		$comment = $input['comment'];

		if(!isset($N)||empty($N)||!isset($name)||empty($name)||!isset($address)||!isset($phone)||!isset($fax)||!isset($uniform_number)||!isset($cellphone)||!isset($email)||!isset($comment)){
			return 'EMPTY';
		}
		else{
			$sql_update ="UPDATE client SET name='$name', address='$address', phone='$phone', fax='$fax', uniform_number='$uniform_number', email='$email', cellphone='$cellphone', comment='$comment' WHERE N='$N'";
			$update_result = mysqli_query($con,$sql_update);	
			return 'ok';
		}
	}
	function login($input){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"admin");

		$id = $input['id'];
		$pwd = $input['pwd'];
		//query data by method
		$getclient_sql = "SELECT * FROM admin where id = '$id' and pwd ='$pwd'";
		$getAll_result = mysqli_query($con,$getclient_sql);
		$row = mysqli_fetch_array($getAll_result,MYSQLI_ASSOC);
		if(!empty($row)){
			return $row;
		}
		return 'LoginFailed';
	}

}
?>