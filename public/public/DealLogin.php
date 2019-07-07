<?php
session_start();
if(empty($_SESSION['account'])){
  header("Location: index.php"); 
}
else{
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>世佳事務用品行</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <!--   <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">   -->
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<script src="js/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" href="css\myStyle.css">
<link rel="stylesheet" href="..\DataTables\DataTables-1.10.16\css\jquery.dataTables.min.css">
<script type="text/JavaScript" src="..\DataTables\DataTables-1.10.16\js\jquery.dataTables.min.js"></script>

<script type="text/JavaScript">
$(document).ready(function(){
    $("#login").click(function() {
        $.ajax({
            type: "POST",
            url: "../apiv1/admin/deallogin",
            dataType: "json",
            data: {
                deal_pwd: $("#password").val()           
            },
            success: function(data) {
                if(data=='login success'){
                  window.location = 'PSDealPage.php';
                }
                else{
                  $("#login_msg").html(data);
                }
            },
            error: function(jqXHR) {
                alert("發生錯誤: " + jqXHR.status);
            }
        })
    })
});
</script>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <?php require('module.php'); ?>

  <!-- center -->
  <div class="content-wrapper" style="padding-left: 5px">
      <div class="container-fluid">
        <div class="card card-login mx-auto mt-5">
          <div class="card-header">世佳進銷存系統登入</div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="password">密碼</label>
                <input class="form-control" id="password" type="password" placeholder="password">
              </div>
              <div class="form-group">
                <div class="form-check">
                  <text align="text-center" style="color:red" id="login_status_msg"></text>
                </div>
              </div>
              <a class="btn btn-primary btn-block" id="login" style="color:white">登入</a>
            </form>
          </div>
        </div>
      </div>
      <!-- /.content-wrapper-->
      <!-- Footer and Logout -->
      <?php require('footer_and_logout.php'); ?>
      
      <!-- Bootstrap core JavaScript-->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/popper/popper.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
      <!-- Core plugin JavaScript-->
      <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
      <!-- Page level plugin JavaScript-->
      <script src="vendor/chart.js/Chart.min.js"></script>
      <script src="vendor/datatables/jquery.dataTables.js"></script>
      <!-- <script src="vendor/datatables/dataTables.bootstrap4.js"></script> -->
      <!-- Custom scripts for all pages-->
      <script src="js/sb-admin.min.js"></script>
      <!-- Custom scripts for this page-->
      <script src="js/sb-admin-datatables.min.js"></script>
    </div>
</body>

</html>
