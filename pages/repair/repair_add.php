<?php
$_SESSION['chkDup'] = '0';
include 'repair_function.php';
$RepairEdit = new RepairResult();
$editId = isset($_POST['editIdValue']) ? $_POST['editIdValue'] : '';
$ProductNo = isset($_POST['txtproductno']) ? $_POST['txtproductno'] : '';
$ProductName = isset($_POST['txtproductnm']) ? $_POST['txtproductnm'] : '';
$ProductAT = isset($_POST['txtActoProduct']) ? $_POST['txtActoProduct'] : '';
$ProductId = isset($_POST['AddIdValue']) ? $_POST['AddIdValue'] : '';
$ProductALl = $RepairEdit->ProductListAll($ProductNo, $ProductName, $ProductAT, $_SESSION['id'], $db);
$SetAddRepair = $RepairEdit->ProductListID($ProductId, $db);
if (count($SetAddRepair) != 0) {
    $ProductNoToRepair = $SetAddRepair['0']['AMS_PRODUCT_NO'];
    $ProductNMToRepair = $SetAddRepair['0']['AMS_PRODUCT_NM'];
    $ProductIDToRepair = $SetAddRepair['0']['AMS_PRODUCT_ID'];
} else {
    $ProductNoToRepair = "";
    $ProductNMToRepair = "";
    $ProductIDToRepair = "";
}

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

        <div class="row" style="display: <?php if ($ProductId == '') {
                                                echo 'block';
                                            } else {
                                                echo 'none';
                                            } ?> ;">
            <div class="col-12">

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-database-search"></i> ค้นหาข้อมูลทะเบียนครุภัณฑ์เพื่อบันทึกซ่อม</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <form class="form-horizontal" id="f_productsr" name="f_productsr" action="?Page=rp-add" method="post" autocomplete="off">
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
                                        <button type="button" class="btn btn-danger2" onclick="window.location.href='?Page=rp-manage';"><i class="mdi mdi-arrow-left-circle"></i> กลับ</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <?php if ($ProductAT != "") { ?>
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
                                            <td><?php echo $value_pro['AMS_PRODUCT_NO']; ?></td>
                                            <td><?php echo $value_pro['AMS_PRODUCT_NM']; ?></td>
                                            <td>

                                                <?php
                                                if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202') {
                                                    if ($value_pro['AMS_REPAIR_ID'] != "") {
                                                ?>
                                                        <form action="?Page=rp-edit" method="POST">
                                                            <input type="hidden" value="<?php echo $value_pro['AMS_REPAIR_ID']; ?>" name="editIdValue">
                                                            <button class="btn btn-sm btn-outline-danger"><i class="mdi mdi-cog"></i> แก้ไขบันทึกซ่อม</button>
                                                        </form>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <form action="?Page=rp-add" method="POST">
                                                            <input type="hidden" value="<?php echo $value_pro['AMS_PRODUCT_ID']; ?>" name="AddIdValue">
                                                            <button class="btn btn-sm btn-outline-dark"><i class="mdi mdi-cog"></i> บันทึกซ่อม</button>
                                                        </form>
                                                    <?php

                                                    }
                                                } else {

                                                    if ($value_pro['AMS_REPAIR_STF'] == $_SESSION['id']) { ?>
                                                        <form action="?Page=rp-edit" method="POST">
                                                            <input type="hidden" value="<?php echo $value_pro['AMS_REPAIR_ID']; ?>" name="editIdValue">
                                                            <button class="btn btn-sm btn-outline-danger"><i class="mdi mdi-cog"></i> แก้ไขบันทึกซ่อม</button>
                                                        </form>
                                                        <?php } else {
                                                        if ($value_pro['AMS_REPAIR_RST'] == '0') {
                                                            echo '<h5><span class="badge rounded-pill bg-danger text-dark">อยู่ในระหว่างการส่งซ่อม</span></h5>';
                                                        } else {
                                                        ?>
                                                            <form action="?Page=rp-add" method="POST">
                                                                <input type="hidden" value="<?php echo $value_pro['AMS_PRODUCT_ID']; ?>" name="AddIdValue">
                                                                <button class="btn btn-sm btn-outline-dark"><i class="mdi mdi-cog"></i> บันทึกซ่อม</button>
                                                            </form>
                                                <?php }
                                                    }
                                                }
                                                ?>


                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>


                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>

        <div class="row" style="display: <?php if ($ProductId == '') {
                                                echo 'none';
                                            } else {
                                                echo 'block';
                                            } ?>;">
            <div class="col-12">

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-plus-box"></i> <?php echo $editId == "" ? 'เพิ่ม' : 'แก้ไข'; ?>ข้อมูลการบันทึกซ่อม <?php echo $editId; ?></h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <form class="form-horizontal" id="f_repair" name="f_repair" action="?Page=rp-result" method="post" autocomplete="off">
                            <div class="row gy-4">
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="txtrppdcno" class="form-label"><b>เลขทะเบียนครุภัณฑ์</b></label>
                                        <input type="text" class="required form-control" name="txtrppdcno" value="<?php echo $ProductNoToRepair; ?>" readonly>
                                        <input type="hidden" class="form-control" id="fdate" name="fdate" value="<?= date('Y-m-d H:i:s'); ?>">
                                        <input type="hidden" class="form-control" id="fstf" name="fstf" value="<?php echo $_SESSION['id']; ?>">
                                        <input type="hidden" name="IdProductRepair" value="<?php echo $ProductIDToRepair; ?>">
                                        <input type="hidden" class="form-control" id="Actionrepair" name="Actionrepair" value="Add">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="txtrppdcname" class="form-label"><b>ชื่อครุภัณฑ์</b></label>
                                        <input type="text" class="required form-control" name="txtrppdcname" value="<?php echo $ProductNMToRepair; ?>" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="txtrpcase" class="form-label"><b>อาการเสีย</b></label>
                                        <textarea class="required form-control" name="txtrpcase"></textarea>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="txtrpdate" class="form-label"><b>วันที่ส่งซ่อม</b></label>
                                        <input type="text" class="required form-control" id="txtrpdate" name="txtrpdate">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="textsuccessdate" class="form-label"><b>วันที่กำหนดแล้วเสร็จ</b></label>
                                        <input type="text" class="required form-control" id="textsuccessdate" name="textsuccessdate">
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="txtprice" class="form-label"><b>ค่าใช้จ่ายในการซ่อม</b></label>
                                        <input type="text" class="required form-control" required="required" name="txtprice" id="txtprice" data-type="currency">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="txtvendar" class="form-label"><b>บริษัทที่ส่งซ่อม</b></label>
                                        <input type="text" class="required form-control" id="txtvendar" name="txtvendar">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="txtrepairst" class="form-label"><b>สถานะรายการซ่อม</b></label>
                                        <select class="required form-select" id="txtrepairst" name="txtrepairst" style="width: 100%; height:36px;" required>
                                            <option value="0">อยู่ระหว่างการซ่อม</option>
                                            <option value="1">ซ่อมแล้ว</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="txtstatus" class="form-label"><b>สถานะของข้อมูล</b></label>
                                        <select class="required form-select" id="txtstatus" name="txtstatus" style="width: 100%; height:36px;" required>
                                            <option value="10">ใช้งาน</option>
                                            <option value="20">แบบร่าง</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                            <br>
                            <div class="border-top">
                                <div class="card-body text-right">
                                    <button type="button" class="btn btn-danger2" onclick="window.location.href='?Page=rp-manage';"><i class="mdi mdi-arrow-left-circle"></i> กลับหน้าหลัก</button>
                                    <button type="button" class="btn btn-success" onclick="window.location.href='?Page=rp-add';"><i class="mdi mdi-text-search"></i> ค้นหาใหม่</button>
                                    <button type="submit" class="btn btn-info2"><i class="mdi mdi-content-save"></i> บันทึกข้อมูล</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>