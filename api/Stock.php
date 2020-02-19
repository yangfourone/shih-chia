<?php
//-----------------------------------------------------------------------------instock
//response by method
class Stock{
	
	function getAll(){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"instock");
		//query data by method
		$getAll_sql = "SELECT * FROM instock";
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
		mysqli_select_db($con,"instock");
		
		//query data by method
		$getById_sql = "SELECT * FROM instock WHERE N = '$id'";
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
		mysqli_select_db($con,"instock");

		$product_category = $input['product_category'];
		$product_name = $input['product_name'];
		$stock_quantity = $input['stock_quantity'];
		$cost = $input['cost'];
		$manufacturers = $input['manufacturers'];
		$comment = $input['comment'];

		if(!isset($product_category)||!isset($cost)||!isset($product_name)||!isset($manufacturers)||!isset($stock_quantity)||empty($product_name)||empty($manufacturers)){
			return 'EMPTY';
		}
		else {
			$sql_insert = "INSERT INTO instock (product_category,product_name,stock_quantity,cost,manufacturers,comment) VALUES ('$product_category','$product_name','$stock_quantity','$cost','$manufacturers','$comment')";
			$add_result = mysqli_query($con,$sql_insert);
			return 'ok';
		}
	}

	function delete($id){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"instock");

		$sql_check = "SELECT * FROM instock WHERE N = '$id'";
		$check_result = mysqli_query($con,$sql_check);
		if(mysqli_num_rows($check_result) == 0) {
			return 'NULL';
		}
		else {
			$sql_delete = "DELETE FROM instock WHERE N = '$id'";
			$del_result = mysqli_query($con,$sql_delete);	
			return 'ok';
		}
	}
	
	function update($input){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"instock");

		$N = $input['N'];
		$product_category = $input['product_category'];
		$product_name = $input['product_name'];
		$stock_quantity = $input['stock_quantity'];
		$cost = $input['cost'];
		$manufacturers = $input['manufacturers'];
		$comment = $input['comment'];

		if(!isset($N)||empty($N)||!isset($product_category)||!isset($cost)||!isset($product_name)||!isset($manufacturers)||!isset($stock_quantity)||empty($product_name)||empty($manufacturers)){
			return 'EMPTY';
		}
		else{
			$sql_check = "SELECT * FROM instock WHERE N = '$N'";
			$check_result = mysqli_query($con,$sql_check);

			if(mysqli_num_rows($check_result) == 0) {
				return 'NULL';
			}
			else {
				$sql_update ="UPDATE instock SET product_category='$product_category', product_name='$product_name', stock_quantity='$stock_quantity', cost='$cost', manufacturers='$manufacturers', comment='$comment'  WHERE N='$N'";
				$update_result = mysqli_query($con,$sql_update);	
				return 'ok';
			}
		}
	}
}
?>