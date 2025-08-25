<?php
$_SESSION['chkDup'] = '0';
include 'product_function.php';
$ProductEdit = new ProductResult();
$editId = isset($_POST['editIdValue']) ? $_POST['editIdValue'] : '';
$lctList = $ProductEdit->Lctlist($db);
$DeprList = $ProductEdit->Deprlist($db);
$YearbudgetAll = $ProductEdit->YearBudgets($db);
$ProductEditResult = $ProductEdit->ListProductEdit($editId, $db);

?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-laptop"></i> จัดการครุภัณฑ์ </h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-plus-box"></i> <?php echo $editId == "" ? 'เพิ่ม' : 'แก้ไข'; ?>ข้อมูลครุภัณฑ์ <?php echo $editId; ?></h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <?php if ($editId == "") { ?>
                            <form class="form-horizontal" id="f_product" name="f_product" action="?Page=pdc-result" method="post" autocomplete="off">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="txtproductno" class="form-label"><b>เลขทะเบียนครุภัณฑ์</b></label>
                                            <input type="text" class="required form-control" id="txtproductno" name="txtproductno" required="required" maxlength="30">

                                        </div>
                                    </div>
                                    <!--end col เช็คครุภัณฑ์ไม่ให้ซ้ำ-->
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="txtproductname" class="form-label"><b>ชื่อครุภัณฑ์</b></label>
                                            <input type="text" class="required form-control" name="txtproductname" required="required" maxlength="200">

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtunit" class="form-label"><b>หน่วยนับ</b></label>
                                            <input type="text" class="required form-control" name="txtunit" required="required" maxlength="10">

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtprice" class="form-label"><b>ราคา</b></label>
                                            <input type="text" class="required form-control" required="required" name="txtprice" id="txtprice" data-type="currency">

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-2 col-md-6">
                                        <div>
                                            <label for="txtsdate" class="form-label"><b>วันที่ส่งมอบ</b></label>
                                            <input type="text" class="required form-control" id="txtsdate" name="txtsdate" required="required">

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-2 col-md-6">
                                        <div>
                                            <label for="txtexpdate" class="form-label"><b>วันสิ้นสุดประกัน</b></label>
                                            <input type="text" class="required form-control" id="txtexpdate" name="txtexpdate" required="required">

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtproductype" class="form-label"><b>ประเภทของครุภัณฑ์</b></label>
                                            <select class="required form-select js-example-basic-single" id="txtproductype" name="txtproductype" style="width: 100%; height:36px;" required>
                                                <option name="txtproductype" value="">เลือกประเภทของครุภัณฑ์</option>
                                                <?php foreach ($DeprList as $key_depr => $value_depr) { ?>
                                                    <option value="<?php echo $value_depr["AMS_DEPRECIATION_ID"]; ?>"><?php echo $value_depr["AMS_DEPRECIATION_TYPE"]; ?></option>
                                                <?php } ?>
                                            </select>


                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtlctpdc" class="form-label"><b>หน่วยงานรับผิดชอบ</b></label>
                                            <select class="required form-select js-example-basic-single" id="txtlctpdc" name="txtlctpdc" style="width: 100%; height:36px;" required>
                                                <option name="txtlctpdc" value="">เลือกหน่วยงานรับผิดชอบ</option>
                                                <?php foreach ($lctList as $key_lct => $value_lct) { ?>
                                                    <option value="<?php echo $value_lct["AMS_LCT_ID"]; ?>"><?php echo $value_lct["AMS_LCT_NM"]; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtlocation" class="form-label"><b>สถานที่จัดเก็บ</b></label>
                                            <input type="text" class="required form-control" name="txtlocation" required="required" maxlength="100">

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-2 col-md-6">
                                        <div>
                                            <label for="txtstatusproduct" class="form-label"><b>สถานะครุภัณฑ์</b></label>
                                            <select class="required form-select" id="txtstatusproduct" name="txtstatusproduct" style="width: 100%; height:36px;" required>
                                                <option value="">เลือกสถานะครุภัณฑ์</option>
                                                <option value="10">ปกติ</option>
                                                <option value="20">เสีย</option>
                                                <option value="30">รอแทงจำหน่าย</option>
                                                <option value="40">แทงจำหน่าย/ตัดออกจากบัญชี</option>
                                            </select>

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-2 col-md-6">
                                        <div>
                                            <label for="txtyearatc" class="form-label"><b>ปีงบประมาณ</b></label>
                                            <select class="required form-select" id="txtyearatc" name="txtyearatc" style="width: 100%; height:36px;" required>
                                                <option value="">เลือกปีงบประมาณ</option>
                                                <?php foreach ($YearbudgetAll as $key_bgyear => $value_bdyear) { ?>
                                                    <option value="<?php echo $value_bdyear["BGYEAR"]; ?>"><?php echo $value_bdyear["BGYEAR"] + 543; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="txtsourceatc" class="form-label"><b>ที่มางบประมาณ</b></label>
                                            <select class="required form-select" id="txtsourceatc" name="txtsourceatc" style="width: 100%; height:36px;" required>
                                                <option value="">กรุณาเลือกปีงบประมาณก่อน</option>
                                            </select>

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-2 col-md-6">
                                        <div>
                                            <label for="txtpdcst" class="form-label"><b>สถานะของข้อมูล</b></label>
                                            <select class="required form-select" id="txtpdcst" name="txtpdcst" style="width: 100%; height:36px;" required>
                                                <option name="txtpdcst" value="10">ใช้งาน</option>
                                                <option name="txtpdcst" value="20">แบบร่าง</option>
                                            </select>
                                            <input type="hidden" class="form-control" id="fdate" name="fdate" value="<?= date('Y-m-d H:i:s'); ?>">
                                            <input type="hidden" class="form-control" id="fstf" name="fstf" value="<?php echo $_SESSION['id']; ?>">
                                            <input type="hidden" class="form-control" id="ActionProduct" name="ActionProduct" value="Add">

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-6 col-md-6 text-left">
                                        <button class="btn btn-success3" type="button" id="rowadd-button"><i class="mdi mdi-arrow-down-bold"></i>เพิ่มเติมครุภัณย่อย</button>
                                        <button class="btn btn-danger2" type="button" id="remove-button">ลบ</button>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-6 col-md-6 text-left">

                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-12 col-md-12">

                                        <table id="exp02Table" class="responsive-table table">
                                            <tbody id="bodyTableAddFood" class="tblfood">


                                            </tbody>
                                        </table>

                                    </div>
                                    <!--end col -->
                                </div>
                                <!--end row-->
                                <br>
                                <div class="border-top">
                                    <div class="card-body text-right" align="right">
                                        <button type="button" class="btn btn-danger2" onclick="window.location.href='?Page=product-manage';"><i class="mdi mdi-arrow-left-circle"></i> กลับ</button>
                                        <button type="submit" class="btn btn-info2"><i class="mdi mdi-content-save"></i> บันทึกข้อมูล</button>
                                    </div>
                                </div>
                            </form>
                        <?php } else { 
                            $subsetlist = $ProductEdit->productSubsetList($editId, $db);
                        ?>

                            <form class="form-horizontal" id="f_producted" name="f_producted" action="?Page=pdc-result" method="post" autocomplete="off">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="txtproductno" class="form-label"><b>เลขทะเบียนครุภัณฑ์</b></label>
                                            <input type="text" class="required form-control" id="txtproductno" name="txtproductno" required="required" maxlength="30" value="<?php echo $ProductEditResult['0']['AMS_PRODUCT_NO']; ?>">
                                            <input type="hidden" id="txtproductnochk" name="txtproductnochk" value="<?php echo $ProductEditResult['0']['AMS_PRODUCT_NO']; ?>">

                                        </div>
                                    </div>
                                    <!--end col เช็คครุภัณฑ์ไม่ให้ซ้ำ-->
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="txtproductname" class="form-label"><b>ชื่อครุภัณฑ์</b></label>
                                            <input type="text" class="required form-control" name="txtproductname" required="required" maxlength="200" value="<?php echo $ProductEditResult['0']['AMS_PRODUCT_NM']; ?>">

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtunit" class="form-label"><b>หน่วยนับ</b></label>
                                            <input type="text" class="required form-control" name="txtunit" required="required" maxlength="10" value="<?php echo $ProductEditResult['0']['AMS_PRODUCT_QTY']; ?>">

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtprice" class="form-label"><b>ราคา</b></label>
                                            <input type="text" class="required form-control" required="required" name="txtprice" id="txtprice" data-type="currency" value="<?php echo $ProductEditResult['0']['AMS_PRODUCT_PRICE']; ?>">
                                            <input type="hidden" class="required form-control" required="required" name="txtpriceed" id="txtpriceed" value="<?php echo $ProductEditResult['0']['AMS_PRODUCT_PRICE']; ?>">

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-2 col-md-6">
                                        <div>
                                            <label for="txtsdate" class="form-label"><b>วันที่ส่งมอบ</b></label>
                                            <input type="text" class="required form-control" id="txtsdate" name="txtsdate" required="required" value="<?php echo $ProductEdit->dateToThai($ProductEditResult['0']['AMS_PRODUCT_SDATE']); ?>">

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-2 col-md-6">
                                        <div>
                                            <label for="txtexpdate" class="form-label"><b>วันสิ้นสุดประกัน</b></label>
                                            <input type="text" class="required form-control" id="txtexpdate" name="txtexpdate" required="required" value="<?php echo $ProductEdit->dateToThai($ProductEditResult['0']['AMS_PRODUCT_EXPDATE']); ?>">

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtproductype" class="form-label"><b>ประเภทของครุภัณฑ์</b></label>
                                            <select class="required form-select js-example-basic-single" id="txtproductype" name="txtproductype" style="width: 100%; height:36px;" required>
                                                <option name="txtproductype" value="">เลือกประเภทของครุภัณฑ์</option>
                                                <?php foreach ($DeprList as $key_depr => $value_depr) { ?>
                                                    <option value="<?php echo $value_depr["AMS_DEPRECIATION_ID"]; ?>" <?php if ($ProductEditResult['0']["AMS_PRODUCT_TYPE"] == $value_depr["AMS_DEPRECIATION_ID"]) {
                                                                                                                            echo 'selected';
                                                                                                                        } else {
                                                                                                                        } ?>> <?php echo $value_depr["AMS_DEPRECIATION_TYPE"]; ?></option>
                                                <?php } ?>
                                            </select>


                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtlctpdc" class="form-label"><b>หน่วยงานรับผิดชอบ</b></label>
                                            <select class="required form-select js-example-basic-single" id="txtlctpdc" name="txtlctpdc" style="width: 100%; height:36px;" required>
                                                <option name="txtlctpdc" value="">เลือกหน่วยงานรับผิดชอบ</option>
                                                <?php foreach ($lctList as $key_lct => $value_lct) { ?>
                                                    <option value="<?php echo $value_lct["AMS_LCT_ID"]; ?>" <?php if ($ProductEditResult['0']["AMS_PRODUCT_LCT"] == $value_lct["AMS_LCT_ID"]) {
                                                                                                                echo 'selected';
                                                                                                            } else {
                                                                                                            } ?>><?php echo $value_lct["AMS_LCT_NM"]; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtlocation" class="form-label"><b>สถานที่จัดเก็บ</b></label>
                                            <input type="text" class="required form-control" name="txtlocation" required="required" maxlength="100" value="<?php echo $ProductEditResult['0']["AMS_PRODUCT_LOC"]; ?>">

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-2 col-md-6">
                                        <div>
                                            <label for="txtstatusproduct" class="form-label"><b>สถานะครุภัณฑ์</b></label>
                                            <select class="required form-select" id="txtstatusproduct" name="txtstatusproduct" style="width: 100%; height:36px;" required>
                                                <option value="">เลือกสถานะครุภัณฑ์</option>
                                                <option value="10" <?php if ($ProductEditResult['0']["AMS_PRODUCT_ST"] == '10') {
                                                                        echo 'selected';
                                                                    } else {
                                                                    } ?>>ปกติ</option>
                                                <option value="20" <?php if ($ProductEditResult['0']["AMS_PRODUCT_ST"] == '20') {
                                                                        echo 'selected';
                                                                    } else {
                                                                    } ?>>เสีย</option>
                                                <option value="30" <?php if ($ProductEditResult['0']["AMS_PRODUCT_ST"] == '30') {
                                                                        echo 'selected';
                                                                    } else {
                                                                    } ?>>รอแทงจำหน่าย</option>
                                                <option value="40" <?php if ($ProductEditResult['0']["AMS_PRODUCT_ST"] == '40') {
                                                                        echo 'selected';
                                                                    } else {
                                                                    } ?>>แทงจำหน่าย/ตัดออกจากบัญชี</option>
                                            </select>

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-2 col-md-6">
                                        <div>
                                            <label for="txtyearatc" class="form-label"><b>ปีงบประมาณ</b></label>
                                            <select class="required form-select" id="txtyearatc" name="txtyearatc" style="width: 100%; height:36px;" required>
                                                <option value="<?php echo $ProductEditResult['0']["AMS_PRODUCT_YEAR"]; ?>"><?php echo $ProductEditResult['0']["AMS_PRODUCT_YEAR"] + 543; ?></option>
                                                <?php foreach ($YearbudgetAll as $key_bgyear => $value_bdyear) { ?>
                                                    <option value="<?php echo $value_bdyear["BGYEAR"]; ?>"><?php echo $value_bdyear["BGYEAR"] + 543; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="txtsourceatc" class="form-label"><b>ที่มางบประมาณ</b></label>
                                            <select class="required form-select" id="txtsourceatc" name="txtsourceatc" style="width: 100%; height:36px;" required>
                                                <option value="<?php echo $ProductEditResult['0']["AMS_PRODUCT_SOURCE"]; ?>"><?php echo $ProductEditResult['0']['AMS_BUDGET_SOURCENM'] . ' ' . $ProductEditResult['0']['AMS_BUDGET_CLASSNM'] . ' ' . $ProductEditResult['0']['AMS_BUDGET_TYPENM'] . '[' . number_format($ProductEditResult['0']['AMS_BUDGET_AMOUNT'], 2) . ']'; ?></option>
                                            </select>

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-2 col-md-6">
                                        <div>
                                            <label for="txtpdcst" class="form-label"><b>สถานะของข้อมูล</b></label>
                                            <select class="required form-select" id="txtpdcst" name="txtpdcst" style="width: 100%; height:36px;" required>
                                                <option name="txtpdcst" value="10" <?php if ($ProductEditResult['0']["AMS_PRODUCT_DELST"] == '10') {
                                                                                        echo 'selected';
                                                                                    } else {
                                                                                    } ?>>ใช้งาน</option>
                                                <option name="txtpdcst" value="20" <?php if ($ProductEditResult['0']["AMS_PRODUCT_DELST"] == '20') {
                                                                                        echo 'selected';
                                                                                    } else {
                                                                                    } ?>>แบบร่าง</option>
                                            </select>
                                            <input type="hidden" class="form-control" id="fdate" name="fdate" value="<?= date('Y-m-d H:i:s'); ?>">
                                            <input type="hidden" class="form-control" id="fstf" name="fstf" value="<?php echo $_SESSION['id']; ?>">
                                            <input type="hidden" class="form-control" id="ActionProduct" name="ActionProduct" value="Edit">
                                            <input type="hidden" class="form-control" id="PdcIdEdit" name="PdcIdEdit" value="<?php echo $ProductEditResult['0']["AMS_PRODUCT_ID"]; ?>">

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-6 col-md-6 text-left">
                                        <button class="btn btn-success3" type="button" id="rowadd-button"><i class="mdi mdi-arrow-down-bold"></i>เพิ่มเติมครุภัณย่อย</button>
                                        <button class="btn btn-danger2" type="button" id="removesubset-button">ลบ</button>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-6 col-md-6 text-left">

                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-12 col-md-12">

                                        <table id="exp02Table" class="responsive-table table">
                                            <tbody id="bodyTableAddFood" class="tblfood">
                                                <?php
                                                    $i = 1;
                                                    foreach ($subsetlist as $key_subset => $value_subset) {
                                                ?>
                                                <tr class='del'>
                                                    <td>
                                                        <div class='row gy-4'>
                                                            <h5>รายการที่ [<?php echo $value_subset['AMS_PRODUCTSUBSET_ID']; ?>]</h5>
                                                            <div class='col-xxl-6 col-md-6'>
                                                                <input type='hidden' name='idpdcchk2[]' value='<?php echo $value_subset['AMS_PRODUCTSUBSET_ID']; ?>'>
                                                                <div><label for='txtproductsubno<?php echo $i; ?>' class='form-label'><b>เลขทะเบียนครุภัณฑ์ย่อย</b></label><input type='text' class='required form-control' value="<?php echo $value_subset['AMS_PRODUCTSUBSET_NO']; ?>" id='txtproductsubno<?php echo $i; ?>' name='txtproductsubno[]' required='required' maxlength='30'></div>
                                                            </div>
                                                            <div class='col-xxl-6 col-md-6'>
                                                                <div><label for='txtproductsubname<?php echo $i; ?>' class='form-label'><b>ชื่อครุภัณฑ์ย่อย</b></label><input type='text' class='required form-control' value="<?php echo $value_subset['AMS_PRODUCTSUBSET_NM']; ?>" name='txtproductsubname[]' required='required' maxlength='200'></div>
                                                            </div>
                                                            <hr />
                                                    </td>
                                                    <td>
                                                            <input type="checkbox" class="btn-check" name="chkDel2[<?php echo $i-1; ?>]" id="btn-check-2-outlined<?php echo $i; ?>" value="1">
                                                            <label class="btn btn-outline-danger shadow-none" for="btn-check-2-outlined<?php echo $i; ?>"><i class="mdi mdi-trash-can"></i></label>
                                                    </td>
                                                </tr>
                                                <?php $i++; } ?>

                                            </tbody>
                                        </table>

                                    </div>
                                    <!--end col -->
                                </div>
                                <!--end row-->
                                <br>
                                <div class="border-top">
                                    <div class="card-body text-right" align="right">
                                        <button type="button" class="btn btn-danger2" onclick="window.location.href='?Page=product-manage';"><i class="mdi mdi-arrow-left-circle"></i> กลับ</button>
                                        <button type="submit" class="btn btn-info2"><i class="mdi mdi-content-save"></i> บันทึกข้อมูล</button>
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