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
      <script src="vendor/datatables/jquery.dataTables.js"></script>
      <!-- <script src="vendor/datatables/dataTables.bootstrap4.js"></script> -->
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
        jQuery(document).ready(function() {
            jQuery('#clientTable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ]
            });
            getclientData();

            jQuery("#NewPatient").click(function() {
                clear_add_table();
            })
            jQuery("#patient_close").click(function() {
                modalHide();
            })
            jQuery("#patient_save").click(function() {
                post_data('add');
            })
            jQuery("#patient_update").click(function() {
                post_data('update');
            })
            jQuery("#patient_delete").click(function() {
                if (confirm("確定要刪除嗎？")) {
                    delete_data();
                }
            })
            jQuery('#clientTable').on('click', 'tr', function() {
                var row = jQuery(this).children('td:first-child').text();
                row == '' ? '' : click_row(row);
            });
        });

        function getclientData() {
            jQuery.ajax({
                type: 'GET',
                url: '../apiv1/client/getall',
                dataType: 'json',
                cache: false,
                success: function(result) {
                    LoadclientDataToTable(result);
                }
            });
        }

        function LoadclientDataToTable(clientData) {
            var clientDataTable = jQuery('#clientTable').DataTable();
            clientDataTable.clear().draw(false);
            for (var i in clientData) {
                clientDataTable.row.add([
                    clientData[i].N,
                    clientData[i].name,
                    clientData[i].phone,
                    clientData[i].cellphone,
                    clientData[i].fax,
                    clientData[i].address,
                    clientData[i].uniform_number,
                    clientData[i].comment
                ]).draw(false);
            }
            clientDataTable.columns.adjust().draw();
        }

        function delete_data() {
            jQuery.ajax({
                type: "POST",
                url: "../apiv1/client/delete/" + jQuery("#N").val(),
                dataType: "json",
                data: {},
                success: function(data) {
                    getclientData();
                    modalHide();
                },
                error: function(jqXHR) {
                    alert("發生錯誤: " + jqXHR.status + ' ' + jqXHR.statusText);
                }
            })
        }

        function post_data(action) {
            jQuery.ajax({
                type: "POST",
                url: "../apiv1/client/" + action,
                dataType: "json",
                data: {
                    N: jQuery("#N").val(),
                    name: jQuery("#name").val(),
                    address: jQuery("#address").val(),
                    phone: jQuery("#phone").val(),
                    fax: jQuery("#fax").val(),
                    uniform_number: jQuery("#uniform_number").val(),
                    email: jQuery("#email").val(),
                    cellphone: jQuery("#cellphone").val(),
                    comment: jQuery("#comment").val()
                },
                success: function(data) {
                    getclientData();
                    modalHide();
                },
                error: function(jqXHR) {
                    jQuery("#post_result").show();
                    if (jqXHR.status == '602') {
                        jQuery("#post_result").html('這間公司已存在於資料庫');
                    } else {
                        jQuery("#post_result").html('資料輸入不完全');
                    }
                }
            })
        }

        function click_row(row) {
            topFunction();
            jQuery.ajax({
                type: "GET",
                url: "../apiv1/client/getbyid/" + row,
                dataType: "json",
                data: {},
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
            jQuery("input[id='delete_checkbox']").prop("checked", false);
            jQuery("#patient_delete").show();
            jQuery("#delete_checkbox").show();
            jQuery("#delete_label").show();
            jQuery("#patient_update").show();
            jQuery("#patient_save").hide();
            jQuery("#patient_close").show();
            jQuery("#N").show();
            jQuery("#N_name").show();
            jQuery("#post_result").hide();
            modalShow();
        }


        function clear_add_table() {
            document.getElementById('N').value = '';
            document.getElementById('name').value = '';
            document.getElementById('address').value = '台南市';
            document.getElementById('phone').value = '';
            document.getElementById('fax').value = '';
            document.getElementById('uniform_number').value = '';
            document.getElementById('cellphone').value = '';
            document.getElementById('email').value = '';
            document.getElementById('comment').value = '';
            jQuery("input[id='delete_checkbox']").prop("checked", false);
            jQuery("#patient_delete").hide();
            jQuery("#delete_checkbox").hide();
            jQuery("#delete_label").hide();
            jQuery("#patient_update").hide();
            jQuery("#patient_save").show();
            jQuery("#patient_close").show();
            jQuery("#N").hide();
            jQuery("#N_name").hide();
            jQuery("#post_result").hide();
            modalShow();
        }

        function add_corporation() {
            document.getElementById('name').value = jQuery('#name').val() + '股份有限公司';
        }

        function add_gmail() {
            document.getElementById('email').value = jQuery('#email').val() + '@gmail.com';
        }

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }

        function modalShow() {
            jQuery.noConflict();
            $('#exampleModal').modal('show');
        }

        function modalHide() {
            jQuery.noConflict();
            $('#exampleModal').modal('hide');
        }
    </script>

    <body class="fixed-nav sticky-footer" id="page-top">
        <!-- Navigation-->
        <?php require('module.php'); ?>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span><i class="fa fa-fw fa-child"></i>&nbsp;&nbsp;客戶資料表</span>
                        <div>
                            <button class="btn btn-dark" onclick="add_corporation()">股份有限公司</button>
                            <button class="btn btn-dark" onclick="add_gmail()">gmail</button>
                        </div>
                    </div>
                    <div class="modal-body">
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
                    <div class="modal-footer">
                        <text align="text-center" id="post_result"></text>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-success" id="patient_save">儲存</button>
                        <button class="btn btn-danger" id="patient_delete">刪除</button>
                        <button class="btn btn-primary" id="patient_update">更新</button>
                        <button class="btn btn-secondary" id="patient_close" data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- center -->
        <div style="margin: 1%;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12" align="right">
                      &nbsp;<button class="btn btn-dark" id="NewPatient">新增客戶</button>
                    </div>
                </div>
                <br>
                <!-- clientDataTable-->
                <div id="datatable_patient_visible">
                    <table id="clientTable" class="display" cellspacing="0" width="100%" >
                        <thead class="thead-dark">
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
