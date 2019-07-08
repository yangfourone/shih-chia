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

      <!-- Bootstrap core JavaScript-->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/popper/popper.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
      <!-- Core plugin JavaScript-->
      <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
      <!-- Page level plugin JavaScript-->
      <script src="vendor/chart.js/Chart.min.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="js/sb-admin.min.js"></script>
      <!-- Custom scripts for this page-->
      <script src="js/sb-admin-datatables.min.js"></script>

      <script src="js/jquery-1.11.3.min.js"></script>
      <link rel="stylesheet" href="..\DataTables\DataTables-1.10.16\css\jquery.dataTables.min.css">
      <script type="text/JavaScript" src="..\DataTables\DataTables-1.10.16\js\jquery.dataTables.min.js"></script>

      <!-- DataTable for Mobile -->
      <script src="js/rowReorder.min.js"></script>
      <script src="js/responsive.min.js"></script>
      <link rel="stylesheet" href="css\responsive.dataTables.min.css">
      <link rel="stylesheet" href="css\rowReorder.dataTables.min.css">

      <!--  modal.js  -->
      <script src="js/modal.js"></script>
      <link rel="stylesheet" href="css/myStyle.css">

    </head>

    <script type="text/JavaScript">

      $(document).ready(function(){
        $('#ManufacturersTable').DataTable({
          rowReorder: {
            selector: 'td:nth-child(2)'
          },
          responsive: true
        });
        getmanufacturersData();

        $("#NewPatient").click(function(){
          clear_add_table();
        })
        $("#patient_close").click(function(){
          $('#myModal').hide();
        })
        $("#patient_save").click(function() {
          post_data('add');
        })
        $("#patient_update").click(function() {
          post_data('update');
        })
        $("#patient_delete").click(function() {
          if(confirm("確定要刪除嗎？")){
            delete_data();
          }
        })
        $('#ManufacturersTable').on('click', 'tr', function(){
          var row = $(this).children('td:first-child').text();
          row==''? '':click_row(row);
        });
      });

      function getmanufacturersData() {
        $.ajax({
          type : 'GET',
          url  : '../apiv1/manufacturers/getall',
          dataType: 'json',
          cache: false,
          success :  function(result) {
            LoadmanufacturersDataToTable(result);
          }
        });
      }

      function LoadmanufacturersDataToTable(manufacturersData) {
        var manufacturersDataTable = $('#ManufacturersTable').DataTable();
        manufacturersDataTable.clear().draw(false);
        for (var i in manufacturersData){
          manufacturersDataTable.row.add([
            manufacturersData[i].N,
            manufacturersData[i].name,
            manufacturersData[i].phone,
            manufacturersData[i].cellphone,
            manufacturersData[i].fax,
            manufacturersData[i].address,
            manufacturersData[i].uniform_number,
            manufacturersData[i].comment
          ]).draw(false);
        }
        manufacturersDataTable.columns.adjust().draw();
      }

      function delete_data() {
        $.ajax({
          type: "POST",
          url: "../apiv1/manufacturers/delete/" + $("#N").val(),
          dataType: "json",
          data: {
          },
          success: function(data) {
            getmanufacturersData();
            $('#myModal').hide();
          },
          error: function(jqXHR) {
            alert("發生錯誤: " + jqXHR.status + ' ' + jqXHR.statusText);
          }
        })
      }

      function post_data($action){
        $.ajax({
          type: "POST",
          url: "../apiv1/manufacturers/" + $action,
          dataType: "json",
          data: {
            N: $("#N").val(),
            name: $("#name").val(),
            address: $("#address").val(),
            phone: $("#phone").val(),
            fax: $("#fax").val(),
            uniform_number: $("#uniform_number").val(),
            email: $("#email").val(),
            cellphone: $("#cellphone").val(),
            comment: $("#comment").val()
          },
          success: function(data) {
            console.log(data);
            getmanufacturersData();
            $('#myModal').hide();
          },
          error: function(jqXHR) {
            $("#post_result").show();
            if(jqXHR.status=='602'){
              $("#post_result").html('這間公司已存在於資料庫');
            }
            else{
              $("#post_result").html('資料輸入不完全');
            }
          }
        })
      }

      function click_row(row){
        topFunction();
        $.ajax({
          type: "GET",
          url: "../apiv1/manufacturers/getbyid/" + row,
          dataType: "json",
          data: {
          },
          success: function(data) {
            document.getElementById('N').value = data.N;
            document.getElementById('name').value = data.name;
            document.getElementById('address').value = data.address;
            document.getElementById('phone').value = data.phone;
            document.getElementById('fax').value = data.fax;
            document.getElementById('uniform_number').value = data.uniform_number;
            document.getElementById('cellphone').value = data.cellphone;
            document.getElementById('email').value = data.email;
            document.getElementById('comment').value = data.comment;
          },
          error: function(jqXHR) {
              alert("發生錯誤: " + jqXHR.status + ' ' + jqXHR.statusText);
          }
        })
        $("input[id='delete_checkbox']").prop("checked", false);
        $("#patient_delete").show();
        $("#delete_checkbox").show();
        $("#delete_label").show();
        $("#patient_update").show();
        $("#patient_save").hide();
        $("#patient_close").show();
        $("#N").show();
        $("#N_name").show();
        $("#post_result").hide();
        $('#myModal').modal('show');
      }


      function clear_add_table(){
        document.getElementById('N').value = '';
        document.getElementById('name').value = '';
        document.getElementById('address').value = '台南市';
        document.getElementById('phone').value = '';
        document.getElementById('fax').value = '';
        document.getElementById('uniform_number').value = '';
        document.getElementById('cellphone').value = '';
        document.getElementById('email').value = '';
        document.getElementById('comment').value = '';
        $("input[id='delete_checkbox']").prop("checked", false);
        $("#patient_delete").hide();
        $("#delete_checkbox").hide();
        $("#delete_label").hide();
        $("#patient_update").hide();
        $("#patient_save").show();
        $("#patient_close").show();
        $("#N").hide();
        $("#N_name").hide();
        $("#post_result").hide();
        $('#myModal').modal('show');
      }

      function add_corporation(){
        document.getElementById('name').value = $('#name').val() + '股份有限公司';
      }

      function add_gmail(){
        document.getElementById('email').value = $('#email').val() + '@gmail.com';
      }

      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script>

    <body class="fixed-nav sticky-footer" id="page-top">
        <!-- Navigation-->
        <?php require('module.php'); ?>

        <!-- modal -->
        <div class="modal" id="myModal" role="dialog" style="margin-top: 3%; background-color: black;"">
            <div class="row">
                <br>
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-handshake-o"></i>&nbsp;&nbsp;廠商資料表
                            <button onclick="add_corporation()" style="margin-left: 40%;">股份有限公司</button>
                            <button onclick="add_gmail()">gmail</button>
                        </div>
                        <div class="card-body" align="left" style="width: 100%; background-color: lightgrey;">

                            <label for="N" id="N_name">編號:</label>
                            <input type="text" id="N" style="width: 85%;" disabled> <br>

                            <label for="name">名稱:</label>
                            <input type="text" id="name" style="width: 85%;"> <br>

                            <label for="address">地址:</label>
                            <input type="text" id="address" style="width: 85%;"> <br>

                            <label for="phone">電話:</label>
                            <input type="text" id="phone" style="width: 85%;"> <br>

                            <label for="cellphone">手機:</label>
                            <input type="text" id="cellphone" style="width: 85%;"> <br>

                            <label for="fax">傳真:</label>
                            <input type="text" id="fax" style="width: 85%;"> <br>

                            <label for="uniform_number">統編:</label>
                            <input type="text" id="uniform_number" style="width: 85%;"> <br>

                            <label for="email">電郵:</label>
                            <input type="text" id="email" style="width: 85%;"> <br>

                            <label for="comment">備註:</label>
                            <input type="text" id="comment" style="width: 85%;"> <br>
                        </div>
                        <div class="card-footer" align="right">
                            <text align="text-center" style="color:red" id="post_result"></text>&nbsp;&nbsp;&nbsp;
                            <button  class="button2" id="patient_save"  style="width: 25%; color: green;">儲存</button>
                            <button  class="button2" id="patient_delete"  style="width: 25%; color: red;">刪除</button>
                            <button  class="button2" id="patient_update"  style="width: 25%; color: dodgerblue;">更新</button>
                            <button  class="button2" id="patient_close"  style="width: 25%; color: black;">取消</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>

        <!-- center -->
        <div style="margin: 1%;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12" align="right">
                        &nbsp;<button id="NewPatient">新增廠商</button>
                    </div>
                </div>
                <br>
                <!-- manufacturersDataTable-->
                <div id="datatable_patient_visible">
                    <table id="ManufacturersTable" class="display" cellspacing="0" width="100%" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>名稱</th>
                                <th>電話</th>
                                <th>手機</th>
                                <th>傳真</th>
                                <th>住址</th>
                                <th>統編</th>
                                <th>備註</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <!-- Footer and Logout -->
        <?php require('footer_and_logout.php'); ?>
    </body>

</html>
