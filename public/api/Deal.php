<?php
//-----------------------------------------------------------------------------deal
//response by method
class Deal{
	
	function getAll($year){
		//connet db
		require 'connect.php';

		mysqli_select_db($con,"deal");
		//SELECT * FROM `daily` WHERE 1 ORDER by date DESC
		$getAll_sql = "SELECT * FROM deal WHERE year='$year'";
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
	function getById($input){
		//connet db
		require 'connect.php';

		$row = $input['row'];

		mysqli_select_db($con,"deal");
		
		//query data by method
		$getById_sql = "SELECT * FROM deal WHERE N = '$row'";
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

		mysqli_select_db($con,"deal");
		
		$product_category = $input['product_category'];
		$product_name = $input['product_name'];
		$status = $input['status'];
		$deal_quantity = $input['deal_quantity'];
		$original_quantity = $input['original_quantity'];
		$total = $input['total'];
		$cost = $input['cost'];
		$cost_total = $input['cost_total'];
		$price = $input['price'];
		$manufacturers = $input['manufacturers'];
		$client = $input['client'];
		$time = $input['time'];
		$comment = $input['comment'];

		$get_year = date("Y",strtotime($time));

		if(!isset($product_category)||!isset($cost)||!isset($product_name)||empty($product_name)||!isset($price)||!isset($status)||!isset($manufacturers)||empty($deal_quantity)||!isset($deal_quantity)||!isset($client)||!isset($total)||!isset($time)||!isset($cost_total)){
			return 'EMPTY';
		}
		else {
			$sql_insert = "INSERT INTO deal (product_category,product_name,status,deal_quantity,total,cost,cost_total,price,manufacturers,client,time,comment,year) VALUES ('$product_category','$product_name','$status','$deal_quantity','$total','$cost','$cost_total','$price','$manufacturers','$client','$time','$comment','$get_year')";
            $add_result = mysqli_query($con,$sql_insert);
            //fix($deal_quantity,$product_name);
            return 'ok';
		}
	}

	function delete($id){
		//connet db
		require 'connect.php';

		mysqli_select_db($con,"deal");


		$sql_delete = "DELETE FROM deal WHERE N = '$id'";
		$del_result = mysqli_query($con,$sql_delete);	
		return 'ok';
	}
	
	function update($input){
		//connet db
		require 'connect.php';

		mysqli_select_db($con,"deal");
		
		$N = $input['N'];
		$product_category = $input['product_category'];
		$product_name = $input['product_name'];
		$status = $input['status'];
		$deal_quantity = $input['deal_quantity'];
		$original_quantity = $input['original_quantity'];
		$total = $input['total'];
		$cost = $input['cost'];
		$cost_total = $input['cost_total'];
		$price = $input['price'];
		$manufacturers = $input['manufacturers'];
		$client = $input['client'];
		$time = $input['time'];
		$comment = $input['comment'];

		$get_year = date("Y",strtotime($time));

		if(!isset($N)||empty($N)||!isset($product_category)||!isset($cost)||!isset($product_name)||empty($product_name)||!isset($price)||!isset($status)||!isset($manufacturers)||empty($deal_quantity)||!isset($deal_quantity)||!isset($client)||!isset($total)||!isset($time)||!isset($cost_total)){
			return 'EMPTY';
		}
		else{
			$sql_update ="UPDATE deal SET product_category='$product_category', product_name='$product_name', cost_total='$cost_total', status='$status', deal_quantity='$deal_quantity', total='$total', cost='$cost', price='$price', manufacturers='$manufacturers', client='$client', time='$time', comment='$comment', year='$get_year'  WHERE N='$N'";
			$update_result = mysqli_query($con,$sql_update);	
			return 'ok';
		}
	}

	function fix($deal_quantity,$product_name){
		require 'connect.php';
		mysqli_select_db($con,'inStock');
		$sql_query = "SELECT stock_quantity FROM inStock WHERE product_name='$product_name'";
		$result_query = mysqli_query($con,$sql_query);

		$stock_quantity = $result_query - $deal_quantity;
		$sql = "UPDATE inStock SET stock_quantity='$stock_quantity' WHERE product_name='$product_name'";
		$result = mysqli_query($con,$sql);
		return 'ok';
	}
}
?>
