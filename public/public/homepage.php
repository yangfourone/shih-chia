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
      
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/popper/popper.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Page level plugin JavaScript-->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <!-- <script src="vendor/datatables/dataTables.bootstrap4.js"></script> -->
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>
  <!-- Custom scripts for this page-->
  <script src="js/sb-admin-datatables.min.js"></script>

  <!--   <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">   -->
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <script src="js/jquery-1.11.3.min.js" type='text/javascript'></script>  
</head>
<link rel="stylesheet" href="css\Style.css">

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <?php require('module.php'); ?>

  <!-- center -->
  <div class="content-wrapper">
    <div class="container" align="center">
      <img class="img-fluid" src="pic/super.png" width="1433" height="575"><br>
      <br><h1><strong>世佳事務用品行</strong></h1><br>
      <h4>台南市安南區北安路二段23號</h4><br>
      <h4>06-2806688 / 06-2502055</h4><br>
      <h4>楊進利 0935-465-688</h4><br>
      <h4>super2502055@gmail.com</h4><br>
    </div>
    <!-- Footer and Logout -->
    <?php require('footer_and_logout.php'); ?>
  </div>
</body>

</html>
