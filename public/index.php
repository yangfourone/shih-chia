<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>S-Super Manage System Login</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<script type="text/JavaScript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/JavaScript">
$(document).ready(function(){
    $("#login").click(function() {
        $.ajax({
            type: "POST",
            url: "../apiv1/admin/login",
            dataType: "json",
            data: {
                account: $("#account").val(),
                pwd: $("#password").val()           
            },
            success: function(data) {
                if(data=='login success'){
                  window.location = 'homepage.php';
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

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">世佳事務用品行 系統登入</div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <label for="account">帳號</label>
            <input class="form-control" id="account" type="text" placeholder="Account">
          </div>
          <div class="form-group">
            <label for="password">密碼</label>
            <input class="form-control" id="password" type="password" placeholder="Password">
          </div>
          <div class="form-group">
            <div class="form-check">
              <text align="text-center" style="color:red" id="login_msg"></text>
            </div>
          </div>
          <a class="btn btn-primary btn-block" id="login" style="color:white">登入</a>
        </form>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/popper/popper.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
