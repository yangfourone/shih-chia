<?php
session_start();
if(empty($_SESSION['deal_pwd'])){
  header("Location: DealLogin.php"); 
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
        jQuery(document).ready(function() {
            initial_date();

            jQuery('#myTable').DataTable({
                // "lengthMenu": [
                //     [10],
                //     [10]
                // ],
                "paging": true,
                "ordering": true,
                "info": true,
                "filter": true,
                "order": [
                    [9, "desc"]
                ],
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ]
            });

            getdealData();

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
                let row = jQuery(this).children('td:first-child').text();
                row == '' ? '' : click_row(row);
            });
            jQuery("#year").change(function() {
                getdealData();
                modalHide();
            })
            jQuery("#season").change(function() {
                getdealData();
                modalHide();
            })
        });

        function getdealData() {
            jQuery.ajax({
                type: 'GET',
                url: '../apiv1/deal/getall',
                dataType: 'json',
                cache: false,
                data: {
                    year: jQuery("#year").val(),
                    season: jQuery('#season').val(),
                },
                success: function(result) {
                    LoaddealDataToTable(result);
                    jQuery('#myTable').show();
                },
                error: function(jqXHR) {
                    if (jqXHR.status === '601') {
                        jQuery('#myTable').hide();
                    }
                }
            });
        }

        function LoaddealDataToTable(dealData) {
            let dealDataTable = jQuery('#myTable').DataTable();
            dealDataTable.clear().draw(false);
            for (let i in dealData) {
                if (dealData[i].status === 'in') {
                    dealData[i].status = '進貨';
                } else if (dealData[i].status == 'out') {
                    dealData[i].status = '銷售';
                }

                if (dealData[i].product_category == '0') {
                    dealData[i].product_category = '單機電話機';
                } else if (dealData[i].product_category == '1') {
                    dealData[i].product_category = '無線電話機';
                } else if (dealData[i].product_category == '2') {
                    dealData[i].product_category = '系統電話機';
                } else if (dealData[i].product_category == '3') {
                    dealData[i].product_category = '電話主機';
                } else if (dealData[i].product_category == '4') {
                    dealData[i].product_category = '電話配件';
                } else if (dealData[i].product_category == '5') {
                    dealData[i].product_category = '監視主機';
                } else if (dealData[i].product_category == '6') {
                    dealData[i].product_category = '紅外線攝影機';
                } else if (dealData[i].product_category == '7') {
                    dealData[i].product_category = '星光級攝影機';
                } else if (dealData[i].product_category == '8') {
                    dealData[i].product_category = '吸頂CCD';
                } else if (dealData[i].product_category == '9') {
                    dealData[i].product_category = '偽裝CCD';
                } else if (dealData[i].product_category == '10') {
                    dealData[i].product_category = '硬碟';
                } else if (dealData[i].product_category == '11') {
                    dealData[i].product_category = '監視配件';
                } else if (dealData[i].product_category == '12') {
                    dealData[i].product_category = '影印機/配件';
                } else if (dealData[i].product_category == '13') {
                    dealData[i].product_category = '事務機/配件';
                } else if (dealData[i].product_category == '14') {
                    dealData[i].product_category = '傳真機/配件';
                } else if (dealData[i].product_category == '15') {
                    dealData[i].product_category = '打卡鐘/配件';
                } else if (dealData[i].product_category == '16') {
                    dealData[i].product_category = '考勤機/配件';
                } else if (dealData[i].product_category == '17') {
                    dealData[i].product_category = '讀卡機/配件';
                } else if (dealData[i].product_category == '18') {
                    dealData[i].product_category = '投影機/配件';
                } else if (dealData[i].product_category == '19') {
                    dealData[i].product_category = '碳粉/碳粉組';
                } else if (dealData[i].product_category == '20') {
                    dealData[i].product_category = '列印配件';
                } else if (dealData[i].product_category == '21') {
                    dealData[i].product_category = '分享器/網路配件';
                } else if (dealData[i].product_category == '22') {
                    dealData[i].product_category = '維修/其他配件';
                }

                dealDataTable.row.add([
                    dealData[i].N,
                    dealData[i].status,
                    dealData[i].client,
                    dealData[i].product_category,
                    dealData[i].product_name,
                    dealData[i].manufacturers,
                    dealData[i].deal_quantity,
                    dealData[i].price,
                    dealData[i].total,
                    dealData[i].time
                ]).draw(false);
            }
            dealDataTable.columns.adjust().draw();
        }

        function delete_data() {
            jQuery.ajax({
                type: "POST",
                url: "../apiv1/deal/delete/" + jQuery("#N").val(),
                dataType: "json",
                success: function(data) {
                    getdealData();
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
                url: "../apiv1/deal/" + action,
                dataType: "json",
                data: {
                    N: jQuery("#N").val(),
                    product_category: jQuery("#product_category").val(),
                    product_name: jQuery("#product_name").val(),
                    status: jQuery("#status").val(),
                    deal_quantity: jQuery("#deal_quantity").val(),
                    original_quantity: jQuery("#original_quantity").val(),
                    total: jQuery("#price").val() * jQuery("#deal_quantity").val(),
                    cost: jQuery("#cost").val(),
                    cost_total: jQuery("#cost").val() * jQuery("#deal_quantity").val(),
                    price: jQuery("#price").val(),
                    manufacturers: jQuery("#manufacturers").val(),
                    client: jQuery("#client").val(),
                    time: jQuery("#time").val(),
                    comment: jQuery("#comment").val()
                },
                success: function(data) {
                    getdealData();
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
                url: "../apiv1/deal/getbyid",
                dataType: "json",
                data: {
                    row: row,
                    year: jQuery("#year").val()
                },
                success: function(data) {
                    document.getElementById('N').value = data.N;
                    document.getElementById('product_category').value = data.product_category;
                    document.getElementById('product_name').value = data.product_name;
                    document.getElementById('status').value = data.status;
                    document.getElementById('deal_quantity').value = data.deal_quantity;
                    document.getElementById('original_quantity').value = data.deal_quantity;
                    document.getElementById('cost').value = data.cost;
                    document.getElementById('price').value = data.price;
                    document.getElementById('total').value = data.total;
                    document.getElementById('manufacturers').value = data.manufacturers;
                    document.getElementById('client').value = data.client;
                    document.getElementById('time').value = data.time;
                    document.getElementById('comment').value = data.comment;
                    document.getElementById('cost_total').value = data.cost_total;
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
            jQuery("#newid_label").hide();
            jQuery("#post_result").hide();
            modalShow();
        }


        function clear_add_table() {
            initial_date();
            document.getElementById('N').value = '';
            document.getElementById('product_category').value = '0';
            document.getElementById('product_name').value = '';
            document.getElementById('status').value = 'out';
            document.getElementById('deal_quantity').value = '';
            document.getElementById('original_quantity').value = '';
            document.getElementById('cost').value = '';
            document.getElementById('price').value = '';
            document.getElementById('total').value = '';
            document.getElementById('manufacturers').value = '';
            document.getElementById('client').value = '';
            document.getElementById('comment').value = '';
            document.getElementById('cost_total').value = '';
            jQuery("input[id='delete_checkbox']").prop("checked", false);
            jQuery("#patient_delete").hide();
            jQuery("#delete_checkbox").hide();
            jQuery("#delete_label").hide();
            jQuery("#patient_update").hide();
            jQuery("#patient_save").show();
            jQuery("#patient_close").show();
            jQuery("#newid_label").show();
            jQuery("#post_result").hide();
            modalShow();
        }

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }

        function initial_date() {
            let today = new Date();
            if ((today.getMonth() + 1) < 10) {
                if (today.getDate() < 10) {
                    document.getElementById('time').value = today.getFullYear() + "-0" + (today.getMonth() + 1) + "-0" + today.getDate();
                } else {
                    document.getElementById('time').value = today.getFullYear() + "-0" + (today.getMonth() + 1) + "-" + today.getDate();
                }
            } else {
                if (today.getDate() < 10) {
                    document.getElementById('time').value = today.getFullYear() + "-" + (today.getMonth() + 1) + "-0" + today.getDate();
                } else {
                    document.getElementById('time').value = today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
                }
            }
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
        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span><i class="fa fa-money"></i>&nbsp;交易資料表</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="N" style="display: none;">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="client">客戶名:</label>
                                <input type="text" id="client"> <br>

                                <label for="product_category">產品類別:</label>
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

                                <label for="time">交易時間:</label>
                                <input type="date" id="time"> <br>

                                <label for="cost">成本單價:</label>
                                <input type="text" id="cost" > <br>
                            </div>
                            <div class="col-lg-6">
                                <label for="manufacturers">廠商名:</label>
                                <input type="text" id="manufacturers"> <br>

                                <label for="product_name">產品代號:</label>
                                <input type="text" id="product_name"> <br>

                                <label for="status">進銷:</label>
                                <select id="status">
                                    <option value="out">售出</option>
                                    <option value="in">進貨</option>
                                </select> <br>

                                <label for="cost_total">總成本價:</label>
                                <input type="text" id="cost_total"  disabled> <br>
                            </div>

                            <div class="col-lg-4">
                                <label for="price">單價:</label>
                                <input type="text" id="price" > <br>
                            </div>
                            <div class="col-lg-4">
                                <label for="deal_quantity">交易量:</label>
                                <input type="text" id="deal_quantity" > <br>
                                <input type="text" id="original_quantity" style="display: none;">
                            </div>
                            <div class="col-lg-4">
                                <label for="total">總價:</label>
                                <input type="text" id="total" disabled> <br>
                            </div>

                            <div class="col-lg-12">
                                <label for="comment">備註:</label>
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
                        <select class="mx-2" id="year">
                            <option value="2020">2020年</option>
                            <option value="2019">2019年</option>
                            <option value="2018">2018年</option>
                            <option value="2017">2017年</option>
                            <option value="2016">2016年</option>
                            <option value="2015">2015年</option>
                        </select>
                        <select class="mx-2" id="season">
                            <option value="Q1">第 1 季</option>
                            <option value="Q2">第 2 季</option>
                            <option value="Q3">第 3 季</option>
                            <option value="Q4">第 4 季</option>
                            <option value="all">整   年</option>
                        </select>
                    &nbsp;&nbsp;  <button class="btn btn-dark" id="NewPatient">新增交易資料</button>
                    </div>
                </div>
            </div>
            <br>
            <!-- dealDataTable-->
            <div style="margin-bottom: 15%;">
                <div id="datatable_patient_visible">
                    <table id="myTable" class="display" cellspacing="0" width="100%" >
                        <thead class="thead-dark">
                            <tr>
                                <th>編號</th>
                                <th>狀態</th>
                                <th>客戶名稱</th>
                                <th>產品類別</th>
                                <th>產品代號</th>
                                <th>廠商名稱</th>
                                <th>交易量</th>
                                <th>單價</th>
                                <th>總價</th>
                                <th>時間</th>
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
