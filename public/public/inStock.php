<?php
session_start();
if(empty($_SESSION['stock_pwd'])){
  header("Location: StockLogin.php"); 
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
            var stockDataTable = jQuery('#myTable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ]
            });
            getstockData();

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
            jQuery('#myTable').on('click', 'tr', function() {
                var row = jQuery(this).children('td:first-child').text();
                row == '' ? '' : click_row(row);
            });
        });

        function getstockData() {
            jQuery.ajax({
                type: 'GET',
                url: '../apiv1/stock/getall',
                dataType: 'json',
                cache: false,
                success: function(result) {
                    jQuery("#myTable").show();
                    LoadstockDataToTable(result);
                },
                error: function(jqXHR) {
                    if (jqXHR.status == '601') {
                        jQuery("#myTable").hide();
                    }
                }
            });
        }

        function LoadstockDataToTable(stockData) {
            var stockDataTable = jQuery('#myTable').DataTable();
            stockDataTable.clear().draw(false);
            for (var i in stockData) {

                if (stockData[i].product_category == '0') {
                    stockData[i].product_category = '單機電話機';
                } else if (stockData[i].product_category == '1') {
                    stockData[i].product_category = '無線電話機';
                } else if (stockData[i].product_category == '2') {
                    stockData[i].product_category = '系統電話機';
                } else if (stockData[i].product_category == '3') {
                    stockData[i].product_category = '電話主機';
                } else if (stockData[i].product_category == '4') {
                    stockData[i].product_category = '電話配件';
                } else if (stockData[i].product_category == '5') {
                    stockData[i].product_category = '監視主機';
                } else if (stockData[i].product_category == '6') {
                    stockData[i].product_category = '紅外線攝影機';
                } else if (stockData[i].product_category == '7') {
                    stockData[i].product_category = '星光級攝影機';
                } else if (stockData[i].product_category == '8') {
                    stockData[i].product_category = '吸頂CCD';
                } else if (stockData[i].product_category == '9') {
                    stockData[i].product_category = '偽裝CCD';
                } else if (stockData[i].product_category == '10') {
                    stockData[i].product_category = '硬碟';
                } else if (stockData[i].product_category == '11') {
                    stockData[i].product_category = '監視配件';
                } else if (stockData[i].product_category == '12') {
                    stockData[i].product_category = '影印機/配件';
                } else if (stockData[i].product_category == '13') {
                    stockData[i].product_category = '事務機/配件';
                } else if (stockData[i].product_category == '14') {
                    stockData[i].product_category = '傳真機/配件';
                } else if (stockData[i].product_category == '15') {
                    stockData[i].product_category = '打卡鐘/配件';
                } else if (stockData[i].product_category == '16') {
                    stockData[i].product_category = '考勤機/配件';
                } else if (stockData[i].product_category == '17') {
                    stockData[i].product_category = '讀卡機/配件';
                } else if (stockData[i].product_category == '18') {
                    stockData[i].product_category = '投影機/配件';
                } else if (stockData[i].product_category == '19') {
                    stockData[i].product_category = '碳粉/碳粉組';
                } else if (stockData[i].product_category == '20') {
                    stockData[i].product_category = '列印配件';
                } else if (stockData[i].product_category == '21') {
                    stockData[i].product_category = '分享器/網路配件';
                } else if (stockData[i].product_category == '22') {
                    stockData[i].product_category = '維修/其他配件';
                }

                stockDataTable.row.add([
                    stockData[i].N,
                    stockData[i].manufacturers,
                    stockData[i].product_category,
                    stockData[i].product_name,
                    stockData[i].stock_quantity,
                    stockData[i].cost,
                    stockData[i].comment
                ]).draw(false);
            }
            stockDataTable.columns.adjust().draw();
        }

        function delete_data() {
            jQuery.ajax({
                type: "POST",
                url: "../apiv1/stock/delete/" + jQuery("#N").val(),
                dataType: "json",
                data: {},
                success: function(data) {
                    getstockData();
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
                url: "../apiv1/stock/" + action,
                dataType: "json",
                data: {
                    N: jQuery("#N").val(),
                    product_category: jQuery("#product_category").val(),
                    product_name: jQuery("#product_name").val(),
                    stock_quantity: jQuery("#stock_quantity").val(),
                    cost: jQuery("#cost").val(),
                    manufacturers: jQuery("#manufacturers").val(),
                    comment: jQuery("#comment").val()
                },
                success: function(data) {
                    getstockData();
                    modalHide();
                },
                error: function(jqXHR) {
                    jQuery("#post_result").show();
                    jQuery("#post_result").html('資料輸入不完全');
                }
            })
        }

        function click_row(row) {
            topFunction();
            jQuery.ajax({
                type: "GET",
                url: "../apiv1/stock/getbyid/" + row,
                dataType: "json",
                data: {},
                success: function(data) {
                    document.getElementById('N').value = data.N;
                    document.getElementById('product_category').value = data.product_category;
                    document.getElementById('product_name').value = data.product_name;
                    document.getElementById('stock_quantity').value = data.stock_quantity;
                    document.getElementById('cost').value = data.cost;
                    document.getElementById('manufacturers').value = data.manufacturers;
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
            jQuery("#index-div").show();
            jQuery("#post_result").hide();
            modalShow();
        }


        function clear_add_table() {
            document.getElementById('N').value = '';
            document.getElementById('product_category').value = '0';
            document.getElementById('product_name').value = '';
            document.getElementById('stock_quantity').value = '';
            document.getElementById('cost').value = '';
            document.getElementById('manufacturers').value = '';
            document.getElementById('comment').value = '';
            jQuery("input[id='delete_checkbox']").prop("checked", false);
            jQuery("#patient_delete").hide();
            jQuery("#delete_checkbox").hide();
            jQuery("#delete_label").hide();
            jQuery("#patient_update").hide();
            jQuery("#patient_save").show();
            jQuery("#patient_close").show();
            jQuery("#index-div").hide();
            jQuery("#post_result").hide();
            modalShow();
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
                        <span><i class="fa fa-save"></i>&nbsp;&nbsp;產品資料表</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12" id="index-div">
                                <label for="N" id="N_name">編號：</label>
                                <input type="text" id="N" style="width: 50%;" disabled> <br><br>
                            </div>
                            <div class="col-lg-4">
                                <label for="manufacturers">廠商：</label>
                                <input type="text" id="manufacturers"> <br>
                            </div>
                            <div class="col-lg-4">
                                <label for="product_name">產品代號：</label>
                                <input type="text" id="product_name"> <br>
                            </div>
                            <div class="col-lg-4">
                                <label for="product_category">產品類別：</label>
                                <select id="product_category">
                                    <option value="0">單機電話機</option>
                                    <option value="1">無線電話機</option>
                                    <option value="2">系統電話機</option>
                                    <option value="3">電話主機</option>
                                    <option value="4">電話配件</option>
                                    <option value="5">監視主機</option>
                                    <option value="6">紅外線攝影機</option>
                                    <option value="7">星光級攝影機</option>
                                    <option value="8">吸頂CCD</option>
                                    <option value="9">偽裝CCD</option>
                                    <option value="10">硬碟</option>
                                    <option value="11">監視配件</option>
                                    <option value="12">影印機/配件</option>
                                    <option value="13">事務機/配件</option>
                                    <option value="14">傳真機/配件</option>
                                    <option value="15">打卡鐘/配件</option>
                                    <option value="16">考勤機/配件</option>
                                    <option value="17">讀卡機/配件</option>
                                    <option value="18">投影機/配件</option>
                                    <option value="19">碳粉/碳粉組</option>
                                    <option value="20">列印配件</option>
                                    <option value="21">分享器/網路配件</option>
                                    <option value="22">維修/其他配件</option>
                                </select> <br>
                            </div>
                            <div class="col-lg-6">
                                <label for="stock_quantity">庫存量：</label>
                                <input type="text" id="stock_quantity"> <br>
                            </div>
                            <div class="col-lg-6">
                                <label for="cost">成本價：</label>
                                <input type="text" id="cost"> <br>
                            </div>
                            <div class="col-lg-12">
                                <label for="comment">備註：</label>
                                <input type="text" id="comment"> <br>
                            </div>
                        </div>
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
                      &nbsp;<button class="btn btn-dark" id="NewPatient">新增庫存資料</button>
                    </div>
                </div>
                <br>

                <!-- stockDataTable-->
                <div id="datatable_patient_visible">
                    <table id="myTable" class="display" cellspacing="0" width="100%" >
                        <thead class="thead-dark">
                            <tr>
                                <th>編號</th>
                                <th>廠商名稱</th>
                                <th>產品類別</th>
                                <th>產品代號</th>
                                <th>庫存量</th>
                                <th>成本價</th>
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
