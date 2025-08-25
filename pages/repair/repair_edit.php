
<?php
$_SESSION['chkDup'] = '0';
include 'repair_function.php';
$RepairEdit = new RepairResult();
$editId = isset($_POST['editIdValue']) ? $_POST['editIdValue'] : '';
$ResultEditId = $RepairEdit->RepairEditTabResult($editId,$db);
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
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-plus-box"></i> <?php echo $editId == "" ? 'เพิ่ม' : 'แก้ไข'; ?>ข้อมูลการบันทึกซ่อม <?php echo $editId; ?></h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <form class="form-horizontal" id="f_repair" name="f_repair" action="?Page=rp-result" method="post" autocomplete="off">
                            <div class="row gy-4">
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="txtrppdcno" class="form-label"><b>เลขทะเบียนครุภัณฑ์</b></label>
                                        <input type="text" class="required form-control" name="txtrppdcno" value="<?php echo $ResultEditId['0']['AMS_PRODUCT_NO']; ?>" readonly>
                                        <input type="hidden" class="form-control" id="fdate" name="fdate" value="<?= date('Y-m-d H:i:s'); ?>">
                                        <input type="hidden" class="form-control" id="fstf" name="fstf" value="<?php echo $_SESSION['id']; ?>">
                                        <input type="hidden" name="IdProductRepair" value="<?php echo $ResultEditId['0']['AMS_REPAIR_PID']; ?>">
                                        <input type="hidden" name="Idedit" value="<?php echo $editId; ?>">
                                        <input type="hidden" class="form-control" id="Actionrepair" name="Actionrepair" value="Edit">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="txtrppdcname" class="form-label"><b>ชื่อครุภัณฑ์</b></label>
                                        <input type="text" class="required form-control" name="txtrppdcname" value="<?php echo $ResultEditId['0']['AMS_PRODUCT_NM']; ?>" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="txtrpcase" class="form-label"><b>อาการเสีย</b></label>
                                        <textarea class="required form-control" name="txtrpcase"><?php echo $ResultEditId['0']['AMS_REPAIR_CAUSE']; ?></textarea>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="txtrpdate" class="form-label"><b>วันที่ส่งซ่อม</b></label>
                                        <input type="text" class="required form-control" id="txtrpdate" name="txtrpdate" value="<?php echo $RepairEdit->dateToThai($ResultEditId['0']['AMS_REPAIR_DATE']); ?>">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="textsuccessdate" class="form-label"><b>วันที่กำหนดแล้วเสร็จ</b></label>
                                        <input type="text" class="required form-control" id="textsuccessdate" name="textsuccessdate" value="<?php echo $RepairEdit->dateToThai($ResultEditId['0']['AMS_REPAIR_SDATE']); ?>">
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="txtprice" class="form-label"><b>ค่าใช้จ่ายในการซ่อม</b></label>
                                        <input type="text" class="required form-control" required="required" name="txtprice" id="txtprice" data-type="currency" value="<?php echo $ResultEditId['0']['AMS_REPAIR_EXPEN']; ?>">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="txtvendar" class="form-label"><b>บริษัทที่ส่งซ่อม</b></label>
                                        <input type="text" class="required form-control" id="txtvendar" name="txtvendar" value="<?php echo $ResultEditId['0']['AMS_REPAIR_CPN']; ?>">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="txtrepairst" class="form-label"><b>สถานะรายการซ่อม</b></label>
                                        <select class="required form-select" id="txtrepairst" name="txtrepairst" style="width: 100%; height:36px;" required>
                                            <option value="0" <?php if($ResultEditId['0']['AMS_REPAIR_RST'] == '0'){ echo 'selected'; }else{} ?> >อยู่ระหว่างการซ่อม</option>
                                            <option value="1" <?php if($ResultEditId['0']['AMS_REPAIR_RST'] == '1'){ echo 'selected'; }else{} ?> >ซ่อมแล้ว</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="txtstatus" class="form-label"><b>สถานะของข้อมูล</b></label>
                                        <select class="required form-select" id="txtstatus" name="txtstatus" style="width: 100%; height:36px;" required>
                                            <option value="10" <?php if($ResultEditId['0']['AMS_REPAIR_ST'] == '10'){ echo 'selected'; }else{} ?> >ใช้งาน</option>
                                            <option value="20" <?php if($ResultEditId['0']['AMS_REPAIR_ST'] == '20'){ echo 'selected'; }else{} ?> >แบบร่าง</option>
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