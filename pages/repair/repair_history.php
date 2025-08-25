<?php
$_SESSION['chkDup'] = '0';
include 'repair_function.php';
$RepairEdit = new RepairResult();
$ProductNo = isset($_POST['txtproductno']) ? $_POST['txtproductno'] : '';
$ProductName = isset($_POST['txtproductnm']) ? $_POST['txtproductnm'] : '';
$ProductAT = isset($_POST['txtActoProduct']) ? $_POST['txtActoProduct'] : '';
$ProductId = isset($_POST['AddIdValue']) ? $_POST['AddIdValue'] : '';
$ProductALl = $RepairEdit->ProductListAll($ProductNo, $ProductName, $ProductAT, $_SESSION['id'], $db);
?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-cog-pause"></i> จัดการข้อมูลการซ่อม </h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-database-search"></i> ค้นหาข้อมูลทะเบียนครุภัณฑ์เพื่อดูประวัติการซ่อม</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <form class="form-horizontal" id="f_productsr" name="f_productsr" action="?Page=rp-his" method="post" autocomplete="off">
                            <div class="row gy-4">
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                        <label for="txtproductno" class="form-label"><b>เลขทะเบียนครุภัณฑ์</b></label>
                                        <input type="text" class="form-control" name="txtproductno">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="txtproductnm" class="form-label"><b>ชื่อครุภัณฑ์</b></label>
                                        <input type="text" class="form-control" name="txtproductnm">
                                        <input type="hidden" name="txtActoProduct" value="success">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <br>
                                        <button type="submit" class="btn btn-info2 text-light"><i class="mdi mdi-database-search"></i> ค้นหา</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <table id="repairmanage" class="table table-bordered dt-responsive  table-striped align-middle text-wrap table-hover" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th hidden></th>
                                    <th>เลขทะเบียนครุภัณฑ์</th>
                                    <th>ชื่อครุภัณฑ์</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ProductALl as $key_pro => $value_pro) { ?>
                                    <tr class="text-center">
                                        <td hidden><?php echo $value_pro['AMS_PRODUCT_ID']; ?></td>
                                        <td ><?php echo $value_pro['AMS_PRODUCT_NO']; ?></td>
                                        <td><?php echo $value_pro['AMS_PRODUCT_NM']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-dark btn-block" data-bs-toggle="modal" data-bs-target="#RepairHistoryModal" data-bs-idbd="<?php echo $value_pro['AMS_PRODUCT_ID']; ?>">ประวัติการซ่อม</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade zoomIn" id="RepairHistoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="RepairHistoryModalLabel">รายละเอียดข้อมูล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <div class="modal-body">
                <!-- <form action="" method="POST">
                    <div class="idpro"><input type="hidden" name="txtidpro" class="form-control"></div>
                </form> -->
            </div>
        </div>
    </div>
</div>
<!--end modal -->