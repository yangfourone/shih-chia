<?php
session_start();
//-----------------------------------------------------------------------------Admin
//response by method
class Admin{
	function login(){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"admin");

		$account = $_POST['account'];
		$pwd = $_POST['pwd'];

		if(!isset($account)||empty($account)||!isset($pwd)||empty($pwd)) {
			return 'account or password is empty';
		}
		else {
			//query data by method
			$login_sql = "SELECT * FROM admin WHERE account = '$account' AND pwd = '$pwd'";
			$login_result = mysqli_query($con,$login_sql);

			if(mysqli_num_rows($login_result) == 0) {
				return 'error account or password';
			}
			else {
				//$login_dataArray = mysqli_fetch_all($login_result,MYSQLI_ASSOC);
				$_SESSION['account'] = $account;
				return 'login success';
			}
		}
	}
	function stocklogin(){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"admin");

		$stock_pwd = $_POST['stock_pwd'];

		if(!isset($stock_pwd)||empty($stock_pwd)) {
			return 'account or password is empty';
		}
		else {
			if($stock_pwd=='6688') {
				$_SESSION['stock_pwd'] = $stock_pwd;
				return 'login success';
			}
			else {
				return 'error account or password';
			}
		}
	}
	function deallogin(){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"admin");

		$deal_pwd = $_POST['deal_pwd'];

		if(!isset($deal_pwd)||empty($deal_pwd)) {
			return 'account or password is empty';
		}
		else {
			if($deal_pwd=='6688') {
				$_SESSION['deal_pwd'] = $deal_pwd;
				return 'login success';
			}
			else {
				return 'error account or password';
			}
		}
	}
}

?>