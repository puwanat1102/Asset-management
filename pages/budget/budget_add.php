<?php
$_SESSION['chkDup'] = '0';
include 'budget_function.php';
$budgetEdit = new BudgetResult();
$editId = isset($_POST['editIdValue']) ? $_POST['editIdValue'] : '';
$ResultEditBG = $budgetEdit->EditResultBudget($editId, $db);

?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-cash-multiple"></i> จัดการข้อมูลงบประมาณ </h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-plus-box"></i> <?php echo $editId == "" ?'เพิ่ม':'แก้ไข'?>ข้อมูลงบประมาณ <?php echo $editId; ?> </h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <?php if ($editId == "") { ?>
                                <form class="form-horizontal" id="f_budget" name="f_budget" action="?Page=budget-result" method="post" autocomplete="off">
                                    <div class="row gy-4">

                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <?php
                                                $firstYear = (2022-20);
                                                $lastYear = ((int)date('Y')) + 2;
                                                $Nowyear = ((int)date('Y'));
                                                ?>
                                                <label for="txtyear" class="form-label"><b>ปีงบประมาณ</b></label>
                                                <!-- <input type="text" class="form-control" id="txtyear" required="required" minlength="4" maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"> -->
                                                <select class="required form-select js-example-basic-single" id="txtyear" name="txtyear" required="required">
                                                    <option value="">--กรุณาเลือกปี--</option>
                                                    <!-- <option name="txtyear" style="display:none;"><?= $Nowyear; ?></option> -->
                                                    <?php
                                                    for ($i = $firstYear; $i <= $lastYear; $i++) {
                                                        isset($_POST['txtyear']) ? $txtyear = $_POST['txtyear'] : $txtyear = '';

                                                    ?>
                                                        <option name="txtyear" value="<?= $i; ?>" <?php if ($txtyear == $i) {
                                                                                                        echo 'selected';
                                                                                                    } else {
                                                                                                    } ?>><?= $i + 543; ?></option>
                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="txtsource" class="form-label"><b>ที่มาของงบประมาณ</b></label>
                                                <select class="required form-select" id="txtsource" name="txtsource" required="required" onclick="showbd1();">
                                                    <option value="">--กรุณาเลือกที่มา--</option>
                                                    <option value="101">งบรายได้</option>
                                                    <option value="102">งบรายจ่าย</option>
                                                    <option value="103">งบอื่นๆ</option>
                                                </select>
                                                <div id="etcshow" style="display: none;">
                                                    <input type="text" class="form-control" name="txtsourceetc" placeholder="งบอื่นๆระบุ(ถ้ามี)">
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="txtedu" class="form-label"><b>หลักสูตร</b></label>
                                                <select class="required form-select" id="txtedu" name="txtedu" required="required">
                                                    <option value="">--กรุณาเลือกการศึกษา--</option>
                                                    <option value="201">ปริญญาตรี</option>
                                                    <option value="202">ปริญญาโท</option>
                                                    <option value="203">ปริญญาเอก</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="txtpaped" class="form-label"><b>ภาคการศึกษา</b></label>
                                                <select class="required form-select" id="txtpaped" name="txtpaped" required="required">
                                                    <option value="">--กรุณาเลือกภาคการศึกษา--</option>
                                                    <option value="301">ภาคปกติ</option>
                                                    <option value="302">ภาคพิเศษ</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="txtprice" class="form-label"><b>จำนวนเงิน</b></label>
                                                <!-- <input type="text" class="form-control" id="txtprice" required="required" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"> -->
                                                <!-- <input type="number" class="form-control" min="0.00" max="1000000000.00" step="0.01" id="txtprice" name="txtprice" required="required" /> maxlength="11" step="0.01" -->
                                                <input type="text" class="required form-control"   name="txtprice" id="txtprice" data-type="currency" placeholder="">
                                                <input type="hidden" class="form-control" id="fdate" name="fdate" value="<?= date('Y-m-d H:i:s'); ?>">
                                                <input type="hidden" class="form-control" id="fstf" name="fstf" value="<?php echo $_SESSION['id']; ?>">
                                                <input type="hidden" class="form-control" id="Actionbudget" name="Actionbudget" value="Add">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="txtbdst" class="form-label"><b>สถานะข้อมูล</b></label>
                                                <select class="required form-select" id="txtbdst" name="txtbdst" style="width: 100%; height:36px;" required>
                                                    <option name="txtbdst" value="10">ใช้งาน</option>
                                                    <option name="txtbdst" value="20">แบบร่าง</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->



                                    </div>
                                    <!--end row-->
                                    <br>
                                    <div class="border-top">
                                        <div class="card-body text-right">
                                            <button type="button" class="btn btn-danger2" onclick="window.location.href='?Page=budget-manage';"><i class="mdi mdi-arrow-left-circle"></i> กลับ</button>
                                            <button type="submit" class="btn btn-info2"><i class="mdi mdi-content-save"></i> บันทึกข้อมูล</button>
                                        </div>
                                    </div>
                                </form>
                            <?php } else {
                                // print_r($ResultEditBG);
                            ?>

                                <form class="form-horizontal" id="f_budget" name="f_budget" action="?Page=budget-result" method="post" autocomplete="off">
                                    <div class="row gy-4">

                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <?php
                                                $firstYear = 2022;
                                                $lastYear = ((int)date('Y')) + 5;
                                                $Nowyear = ((int)date('Y'));
                                                ?>
                                                <label for="txtyear" class="form-label"><b>ปีงบประมาณ</b></label>
                                                <!-- <input type="text" class="form-control" id="txtyear" required="required" minlength="4" maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"> -->
                                                <select class="required form-select" id="txtyear" name="txtyear" required="required">
                                                    <option value="">--กรุณาเลือกปี--</option>
                                                    <option name="txtyear" style="display:none;"><?= $Nowyear; ?></option>
                                                    <?php
                                                    for ($i = $firstYear; $i <= $lastYear; $i++) {
                                                        // isset($_POST['txtyear']) ? $txtyear = $_POST['txtyear'] : $txtyear = '';

                                                    ?>
                                                        <option name="txtyear" value="<?= $i; ?>" <?php if ($ResultEditBG['0']['AMS_BUDGET_YEAR'] == $i) {
                                                                                                        echo 'selected';
                                                                                                    } else {
                                                                                                    } ?>><?= $i + 543; ?></option>
                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="txtsource" class="form-label"><b>ที่มาของงบประมาณ</b></label>
                                                <select class="required form-select" id="txtsource" name="txtsource" required="required" onclick="showbd1();">
                                                    <option value="">--กรุณาเลือกที่มา--</option>
                                                    <option value="101" <?php if ($ResultEditBG['0']['AMS_BUDGET_SOURCE'] == '101') {
                                                                            echo 'selected';
                                                                        } else {
                                                                        } ?>>งบรายได้</option>
                                                    <option value="102" <?php if ($ResultEditBG['0']['AMS_BUDGET_SOURCE'] == '102') {
                                                                            echo 'selected';
                                                                        } else {
                                                                        } ?>>งบรายจ่าย</option>
                                                    <option value="103" <?php if ($ResultEditBG['0']['AMS_BUDGET_SOURCE'] == '103') {
                                                                            echo 'selected';
                                                                        } else {
                                                                        } ?>>งบอื่นๆ</option>
                                                </select>
                                                <div id="etcshow" style="display: <?php if ($ResultEditBG['0']['AMS_BUDGET_SOURCE'] == '103') {
                                                                                        echo 'block';
                                                                                    } else {
                                                                                        echo 'none';
                                                                                    } ?>;">
                                                    <input type="text" class="form-control" name="txtsourceetc" value="<?php echo $ResultEditBG['0']['AMS_BUDGET_ETC']; ?>" placeholder="งบอื่นๆระบุ(ถ้ามี)">
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="txtedu" class="form-label"><b>หลักสูตร</b></label>
                                                <select class="required form-select" id="txtedu" name="txtedu" required="required">
                                                    <option value="">--กรุณาเลือกการศึกษา--</option>
                                                    <option value="201" <?php if ($ResultEditBG['0']['AMS_BUDGET_CLASS'] == '201') {
                                                                            echo 'selected';
                                                                        } else {
                                                                        } ?>>ปริญญาตรี</option>
                                                    <option value="202" <?php if ($ResultEditBG['0']['AMS_BUDGET_CLASS'] == '202') {
                                                                            echo 'selected';
                                                                        } else {
                                                                        } ?>>ปริญญาโท</option>
                                                    <option value="203" <?php if ($ResultEditBG['0']['AMS_BUDGET_CLASS'] == '203') {
                                                                            echo 'selected';
                                                                        } else {
                                                                        } ?>>ปริญญาเอก</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="txtpaped" class="form-label"><b>ภาคการศึกษา</b></label>
                                                <select class="required form-select" id="txtpaped" name="txtpaped" required="required">
                                                    <option value="">--กรุณาเลือกภาคการศึกษา--</option>
                                                    <option value="301" <?php if ($ResultEditBG['0']['AMS_BUDGET_TYPE'] == '301') {
                                                                            echo 'selected';
                                                                        } else {
                                                                        } ?>>ภาคปกติ</option>
                                                    <option value="302" <?php if ($ResultEditBG['0']['AMS_BUDGET_TYPE'] == '302') {
                                                                            echo 'selected';
                                                                        } else {
                                                                        } ?>>ภาคพิเศษ</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-4 col-md-6" id="txtprice2">
                                            <div>
                                                <label for="txtpricedfsfsd" id="focusP" class="form-label"><b>จำนวนเงิน</b></label>
                                                <!-- <input type="text" class="form-control" id="txtprice" required="required" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"> -->
                                                <!-- <input type="number" class="form-control" min="0.00" max="1000000000.00" step="0.01" id="txtprice" name="txtprice" required="required" /> -->
                                                <input type="text" class="form-control"  name="txtprice" id="txtprice" data-type="currency" value="<?php echo $ResultEditBG['0']['AMS_BUDGET_AMOUNT']; ?>" autofocus>
                                                <input type="hidden" class="form-control" id="fdate" name="fdate" value="<?= date('Y-m-d H:i:s'); ?>">
                                                <input type="hidden" class="form-control" id="fstf" name="fstf" value="<?php echo $_SESSION['id']; ?>">
                                                <input type="hidden" class="form-control" id="Actionbudget" name="Actionbudget" value="Edit">
                                                <input type="hidden" class="form-control" id="IdbudgetEdit" name="IdbudgetEdit" value="<?php echo $editId; ?>">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-4 col-md-6">
                                            <div>
                                                <label for="txtbdst" class="form-label"><b>สถานะข้อมูล</b></label>
                                                <select class="required form-select" id="txtbdst" name="txtbdst" style="width: 100%; height:36px;" required>
                                                    <option name="txtbdst" value="10"  <?php if ($ResultEditBG['0']['AMS_BUDGET_ST'] == '10') {
                                                                            echo 'selected';
                                                                        } else {
                                                                        } ?>>ใช้งาน</option>
                                                    <option name="txtbdst" value="20"  <?php if ($ResultEditBG['0']['AMS_BUDGET_ST'] == '20') {
                                                                            echo 'selected';
                                                                        } else {
                                                                        } ?>>แบบร่าง</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->



                                    </div>
                                    <!--end row-->
                                    <br>
                                    <div class="border-top">
                                        <div class="card-body text-right">
                                            <button type="button" class="btn btn-danger2" onclick="window.location.href='?Page=budget-manage';"><i class="mdi mdi-arrow-left-circle"></i> กลับ</button>
                                            <button type="submit" class="btn btn-info2"><i class="mdi mdi-content-save"></i> บันทึกข้อมูล</button>
                                            <div style="display: none;">
                                                <button type="button" id="FocusButtonID" class="" onclick="FocusButton();"><i class="mdi mdi-content-save"></i> </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            <?php } ?>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    function showbd1() {
        if (document.getElementById('txtsource').value == '103') {

            document.getElementById('etcshow').style.display = 'block';

        } else {

            document.getElementById('etcshow').style.display = 'none';

        }
    }
<?php if($editId != ""){ ?>

    document.getElementById("txtprice2").addEventListener("mouseover", () => {
        document.getElementById("FocusButtonID").click();
    });

    function FocusButton() {
        document.getElementById("txtyear").focus();
    }
<?php } ?>
</script>

<!-- onmouseover="myFunction();" -->