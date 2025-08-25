<?php
$_SESSION['chkDup'] = '0';
include 'deprec_function.php';
$DeprecEdit = new DeprecResult();
$editId = isset($_POST['editIdValue']) ? $_POST['editIdValue'] : '';
$EditResultdp = $DeprecEdit->ResultEditDeprec($editId,$db);

?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-calculator"></i> จัดการประเภทครุภัณฑ์ </h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-plus-box"></i> <?php echo $editId == "" ? 'เพิ่ม' : 'แก้ไข'; ?>ข้อมูลประเภทครุภัณฑ์ <?php echo $editId; ?></h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <?php if ($editId == "") { ?>
                            <form class="form-horizontal" id="f_deprec" name="f_deprec" action="?Page=deprec-result" method="post" autocomplete="off">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="txtprotype" class="form-label"><b>ประเภทของครุภัณฑ์</b></label>
                                            <input type="text" class="required form-control" id="txtprotype" name="txtprotype"  required>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <!-- <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="txtprotime" class="form-label"><b>ระยะเวลาเสื่อมราคา</b></label>
                                            <input type="number" class="required form-control" name="txtprotime" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;" required />
                                        </div>
                                    </div> -->
                                    <!--end col-->
                                    <!-- <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="txtrate" class="form-label"><b>อัตราการเสื่อมราคา</b></label>
                                            <input type="number" class="required form-control" name="txtrate" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==12) return false;" required />
                                        </div>
                                    </div> -->
                                    <!--end col-->
                                    <div class="col-xxl-2 col-md-6">
                                        <div>
                                            <label for="txtdcst" class="form-label"><b>สถานะข้อมูล</b></label>
                                            <select class="required form-select" id="txtbdst" name="txtdcst" style="width: 100%; height:36px;" required>
                                                <option name="txtdcst" value="10">ใช้งาน</option>
                                                <option name="txtdcst" value="20">แบบร่าง</option>
                                            </select>
                                            <input type="hidden" class="form-control" id="fdate" name="fdate" value="<?= date('Y-m-d H:i:s'); ?>">
                                            <input type="hidden" class="form-control" id="fstf" name="fstf" value="<?php echo $_SESSION['id']; ?>">
                                            <input type="hidden" class="form-control" id="Actiondeprec" name="Actiondeprec" value="Add">
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                                <br>
                                <div class="border-top">
                                    <div class="card-body text-right">
                                        <button type="button" class="btn btn-danger2" onclick="window.location.href='?Page=deprec-setting';"><i class="mdi mdi-arrow-left-circle"></i> กลับ</button>
                                        <button type="submit" class="btn btn-info2"><i class="mdi mdi-content-save"></i> บันทึกข้อมูล</button>
                                    </div>
                                </div>
                            </form>

                        <?php } else {
                        ?>
                            <form class="form-horizontal" id="f_depreced" name="f_depreced" action="?Page=deprec-result" method="post" autocomplete="off">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="txtprotype" class="form-label"><b>ประเภทของครุภัณฑ์</b></label>
                                            <input type="text" class="required form-control" id="txtprotype" name="txtprotype" value="<?php echo $EditResultdp['0']['AMS_DEPRECIATION_TYPE']; ?>" required>
                                            <input type="hidden" class="required form-control" id="txtprotypechk" name="txtprotypechk" value="<?php echo $EditResultdp['0']['AMS_DEPRECIATION_TYPE']; ?>" >
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <!-- <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="txtprotime" class="form-label"><b>ระยะเวลาเสื่อมราคา</b></label>
                                            <input type="number" class="required form-control" name="txtprotime" value="<?php echo $EditResultdp['0']['AMS_DEPRECIATION_YEAR']; ?>" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;" required />
                                        </div>
                                    </div> -->
                                    <!--end col-->
                                    <!-- <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="txtrate" class="form-label"><b>อัตราการเสื่อมราคา</b></label>
                                            <input type="number" class="required form-control" name="txtrate" value="<?php echo $EditResultdp['0']['AMS_DEPRECIATION_RATE']; ?>" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==12) return false;" required />
                                        </div>
                                    </div> -->
                                    <!--end col-->
                                    <div class="col-xxl-2 col-md-6">
                                        <div>
                                            <label for="txtdcst" class="form-label"><b>สถานะข้อมูล</b></label>
                                            <select class="required form-select" id="txtbdst" name="txtdcst" style="width: 100%; height:36px;" required>
                                                <option name="txtdcst" value="10" <?php if ($EditResultdp['0']['AMS_DEPRECIATION_ST'] == '10') {
                                                                            echo 'selected';
                                                                        } else {
                                                                        } ?>>ใช้งาน</option>
                                                <option name="txtdcst" value="20" <?php if ($EditResultdp['0']['AMS_DEPRECIATION_ST'] == '20') {
                                                                            echo 'selected';
                                                                        } else {
                                                                        } ?>>แบบร่าง</option>
                                            </select>
                                            <input type="hidden" class="form-control" id="fdate" name="fdate" value="<?= date('Y-m-d H:i:s'); ?>">
                                            <input type="hidden" class="form-control" id="fstf" name="fstf" value="<?php echo $_SESSION['id']; ?>">
                                            <input type="hidden" class="form-control" id="Actiondeprec" name="Actiondeprec" value="Edit">
                                            <input type="hidden" class="form-control" id="Idedit" name="Idedit" value="<?php echo $editId; ?>">
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                                <br>
                                <div class="border-top">
                                    <div class="card-body text-right">
                                        <button type="button" class="btn btn-danger2" onclick="window.location.href='?Page=deprec-setting';"><i class="mdi mdi-arrow-left-circle"></i> กลับ</button>
                                        <button type="submit" class="btn btn-info2"><i class="mdi mdi-content-save"></i> บันทึกข้อมูล</button>
                                    </div>
                                </div>
                            </form>
                        <?php
                        } ?>


                    </div>
                </div>

            </div>
        </div>

    </div>
</div>