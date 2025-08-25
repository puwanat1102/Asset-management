<?php
$_SESSION['chkDup'] = '0';
include 'product_function.php';
$ProductEdit = new ProductResult();
$editId = isset($_POST['editIdValue']) ? $_POST['editIdValue'] : '';
$lctList = $ProductEdit->Lctlist($db);
$DeprList = $ProductEdit->Deprlist($db);
$YearbudgetAll = $ProductEdit->YearBudgets($db);
$ProductEditResult = $ProductEdit->ListProductEdit($editId, $db);
$chkSet = isset($ProductEditResult["0"]["AMS_PRODUCT_SET"]) ? $ProductEditResult["0"]["AMS_PRODUCT_SET"] : "";
$subsetlist = $ProductEdit->productSubsetList($editId, $db);
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
        <!--  -->
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-plus-box"></i> แก้ไขข้อมูลครุภัณฑ์ <?php echo $editId; ?></h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <?php if ($chkSet == "") { ?>
                            <form class="form-horizontal" id="f_producted" name="f_producted" action="?Page=pdc-resultkrp" method="post" autocomplete="off">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="txtproductno" class="form-label"><b>เลขทะเบียนครุภัณฑ์</b></label>
                                            <input type="text" class="required form-control" id="txtproductno" name="txtproductno" required="required" maxlength="30" value="<?php echo $ProductEditResult['0']['AMS_PRODUCT_NO']; ?>" disabled="disabled">
                                            <input type="hidden" id="txtproductnochk" name="txtproductnochk" value="<?php echo $ProductEditResult['0']['AMS_PRODUCT_NO']; ?>">

                                        </div>
                                    </div>
                                    <!--end col เช็คครุภัณฑ์ไม่ให้ซ้ำ-->
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="txtproductname" class="form-label"><b>ชื่อครุภัณฑ์</b></label>
                                            <input type="text" class="required form-control" name="txtproductname" required="required" maxlength="200" value="<?php echo $ProductEditResult['0']['AMS_PRODUCT_NM']; ?>" disabled="disabled">

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtunit" class="form-label"><b>หน่วยนับ</b></label>
                                            <input type="text" class="required form-control" name="txtunit" required="required" maxlength="10" value="<?php echo $ProductEditResult['0']['AMS_PRODUCT_QTY']; ?>" disabled="disabled">

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtprice" class="form-label"><b>ราคา</b></label>
                                            <input type="text" class="required form-control" required="required" name="txtprice" id="txtprice" data-type="currency" value="<?php echo $ProductEditResult['0']['AMS_PRODUCT_PRICE']; ?>" disabled="disabled">
                                            <input type="hidden" class="required form-control" required="required" name="txtpriceed" id="txtpriceed" value="<?php echo $ProductEditResult['0']['AMS_PRODUCT_PRICE']; ?>">

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-2 col-md-6">
                                        <div>
                                            <label for="txtsdate" class="form-label"><b>วันที่ส่งมอบ</b></label>
                                            <input type="text" class="required form-control" id="txtsdate" name="txtsdate" required="required" value="<?php echo $ProductEdit->dateToThai($ProductEditResult['0']['AMS_PRODUCT_SDATE']); ?>" disabled="disabled">

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-2 col-md-6">
                                        <div>
                                            <label for="txtexpdate" class="form-label"><b>วันสิ้นสุดประกัน</b></label>
                                            <input type="text" class="required form-control" id="txtexpdate" name="txtexpdate" required="required" value="<?php echo $ProductEdit->dateToThai($ProductEditResult['0']['AMS_PRODUCT_EXPDATE']); ?>" disabled="disabled">

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-4 col-md-6">
                                        <div>
                                            <label for="txtproductype" class="form-label"><b>ประเภทของครุภัณฑ์</b></label>
                                            <select class="required form-select js-example-basic-single" id="txtproductype" name="txtproductype" style="width: 100%; height:36px;" disabled="disabled">
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
                                            <select class="required form-select" id="txtstatusproduct" name="txtstatusproduct" style="width: 100%; height:36px;" disabled="disabled">
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
                                            <select class="required form-select" id="txtyearatc" name="txtyearatc" style="width: 100%; height:36px;" disabled="disabled">
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
                                            <select class="required form-select" id="txtsourceatc" name="txtsourceatc" style="width: 100%; height:36px;" disabled="disabled">
                                                <option value="<?php echo $ProductEditResult['0']["AMS_PRODUCT_SOURCE"]; ?>"><?php echo $ProductEditResult['0']['AMS_BUDGET_SOURCENM'] . ' ' . $ProductEditResult['0']['AMS_BUDGET_CLASSNM'] . ' ' . $ProductEditResult['0']['AMS_BUDGET_TYPENM'] . '[' . number_format($ProductEditResult['0']['AMS_BUDGET_AMOUNT'], 2) . ']'; ?></option>
                                            </select>

                                        </div>
                                    </div>
                                    <!--end col -->
                                    <div class="col-xxl-2 col-md-6">
                                        <div>
                                            <label for="txtpdcst" class="form-label"><b>สถานะของข้อมูล</b></label>
                                            <select class="required form-select" id="txtpdcst" name="txtpdcst" style="width: 100%; height:36px;" disabled="disabled">
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
                                        <b>รายการครุภัณฑ์ย่อย: </b>
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
                                                                    <div><label for='txtproductsubno<?php echo $i; ?>' class='form-label'><b>เลขทะเบียนครุภัณฑ์ย่อย</b></label><input type='text' class='required form-control' value="<?php echo $value_subset['AMS_PRODUCTSUBSET_NO']; ?>" id='txtproductsubno<?php echo $i; ?>' name='txtproductsubno[]' required='required' maxlength='30' disabled='disabled'></div>
                                                                </div>
                                                                <div class='col-xxl-6 col-md-6'>
                                                                    <div><label for='txtproductsubname<?php echo $i; ?>' class='form-label'><b>ชื่อครุภัณฑ์ย่อย</b></label><input type='text' class='required form-control' value="<?php echo $value_subset['AMS_PRODUCTSUBSET_NM']; ?>" name='txtproductsubname[]' required='required' maxlength='200' disabled='disabled'></div>
                                                                </div>
                                                                <hr />
                                                        </td>
                                                        <td>

                                                        </td>
                                                    </tr>
                                                <?php $i++;
                                                } ?>

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

                            $idSet = $ProductEditResult['0']['AMS_PRODUCT_SET'];
                            $ProductSetData = $ProductEdit->ProductSetEditAll($idSet, $db);
                            $ListSetdata = $ProductEdit->ListProductToSetEdit($idSet, $db);
                            $result_listAllUser = $ProductEdit->ListUserAMS($db);

                        ?>
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills nav-customs nav-danger mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#border-navs-home" role="tab"><i class="mdi mdi-circle-edit-outline"></i> แก้ไขรายการครุภัณฑ์</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#border-navs-profile" role="tab"><i class="mdi mdi-data-matrix-edit"></i> แก้ไขชุดครุภัณฑ์</a>
                                </li>

                            </ul><!-- Tab panes -->
                            <div class="tab-content text-muted">
                                <div class="tab-pane active" id="border-navs-home" role="tabpanel">
                                    <!-- แก้ไขรายการ -->
                                    <form class="form-horizontal" id="f_productsetlisted" name="f_productsetlisted" action="?Page=pdc-resultkrp" method="post" autocomplete="off">
                                        <div class="row gy-4">
                                            <div class="col-xxl-6 col-md-6">
                                                <div>
                                                    <label for="txtproductno" class="form-label"><b>เลขทะเบียนครุภัณฑ์</b></label>
                                                    <input type="text" class="required form-control" id="txtproductno" name="txtproductno" required="required" maxlength="30" value="<?php echo $ProductEditResult['0']['AMS_PRODUCT_NO']; ?>" disabled="disabled">
                                                    <input type="hidden" id="txtproductnochk" name="txtproductnochk" value="<?php echo $ProductEditResult['0']['AMS_PRODUCT_NO']; ?>">

                                                </div>
                                            </div>
                                            <!--end col เช็คครุภัณฑ์ไม่ให้ซ้ำ-->
                                            <div class="col-xxl-6 col-md-6">
                                                <div>
                                                    <label for="txtproductname" class="form-label"><b>ชื่อครุภัณฑ์</b></label>
                                                    <input type="text" class="required form-control" name="txtproductname" required="required" maxlength="200" value="<?php echo $ProductEditResult['0']['AMS_PRODUCT_NM']; ?>" disabled="disabled">

                                                </div>
                                            </div>
                                            <!--end col -->
                                            <div class="col-xxl-4 col-md-6">
                                                <div>
                                                    <label for="txtunit" class="form-label"><b>หน่วยนับ</b></label>
                                                    <input type="text" class="required form-control" name="txtunit" required="required" maxlength="10" value="<?php echo $ProductEditResult['0']['AMS_PRODUCT_QTY']; ?>" disabled="disabled">

                                                </div>
                                            </div>
                                            <!--end col -->
                                            <div class="col-xxl-4 col-md-6">
                                                <div>
                                                    <label for="txtprice" class="form-label"><b>ราคา</b></label>
                                                    <input type="text" class="required form-control" required="required" name="txtprice" id="txtprice" data-type="currency" value="<?php echo $ProductEditResult['0']['AMS_PRODUCT_PRICE']; ?>" disabled="disabled">
                                                    <input type="hidden" class="required form-control" required="required" name="txtpriceed" id="txtpriceed" value="<?php echo $ProductEditResult['0']['AMS_PRODUCT_PRICE']; ?>">

                                                </div>
                                            </div>
                                            <!--end col -->
                                            <div class="col-xxl-2 col-md-6" style="display: none;">
                                                <div>
                                                    <label for="txtsdate" class="form-label"><b>วันที่ส่งมอบ</b></label>
                                                    <input type="text" class="required form-control" id="txtsdate" name="txtsdate" required="required" value="<?php echo $ProductEdit->dateToThai($ProductEditResult['0']['AMS_PRODUCT_SDATE']); ?>" disabled="disabled">

                                                </div>
                                            </div>
                                            <!--end col -->
                                            <div class="col-xxl-2 col-md-6 " style="display: none;">
                                                <div>
                                                    <label for="txtexpdate" class="form-label"><b>วันสิ้นสุดประกัน</b></label>
                                                    <input type="text" class="required form-control" id="txtexpdate" name="txtexpdate" required="required" value="<?php echo $ProductEdit->dateToThai($ProductEditResult['0']['AMS_PRODUCT_EXPDATE']); ?>" disabled="disabled">

                                                </div>
                                            </div>
                                            <!--end col -->
                                            <div class="col-xxl-4 col-md-6">
                                                <div>
                                                    <label for="txtproductype" class="form-label"><b>ประเภทของครุภัณฑ์</b></label>
                                                    <select class="required form-select js-example-basic-single" id="txtproductype" name="txtproductype" style="width: 100%; height:36px;" disabled="disabled">
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
                                            <div class="col-xxl-4 col-md-6" style="display: none;">
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
                                                    <select class="required form-select" id="txtstatusproduct" name="txtstatusproduct" style="width: 100%; height:36px;" disabled="disabled">
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
                                            <div class="col-xxl-2 col-md-6" style="display: none;">
                                                <div>
                                                    <label for="txtyearatc" class="form-label"><b>ปีงบประมาณ</b></label>
                                                    <select class="required form-select" id="txtyearatc" name="txtyearatc" style="width: 100%; height:36px;" disabled="disabled">
                                                        <option value="<?php echo $ProductEditResult['0']["AMS_PRODUCT_YEAR"]; ?>"><?php echo $ProductEditResult['0']["AMS_PRODUCT_YEAR"] + 543; ?></option>
                                                        <?php foreach ($YearbudgetAll as $key_bgyear => $value_bdyear) { ?>
                                                            <option value="<?php echo $value_bdyear["BGYEAR"]; ?>"><?php echo $value_bdyear["BGYEAR"] + 543; ?></option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                            </div>
                                            <!--end col -->
                                            <div class="col-xxl-4 col-md-6" style="display: none;">
                                                <div>
                                                    <label for="txtsourceatc" class="form-label"><b>ที่มางบประมาณ</b></label>
                                                    <select class="required form-select" id="txtsourceatc" name="txtsourceatc" style="width: 100%; height:36px;" disabled="disabled">
                                                        <option value="<?php echo $ProductEditResult['0']["AMS_PRODUCT_SOURCE"]; ?>"><?php echo $ProductEditResult['0']['AMS_BUDGET_SOURCENM'] . ' ' . $ProductEditResult['0']['AMS_BUDGET_CLASSNM'] . ' ' . $ProductEditResult['0']['AMS_BUDGET_TYPENM'] . '[' . number_format($ProductEditResult['0']['AMS_BUDGET_AMOUNT'], 2) . ']'; ?></option>
                                                    </select>

                                                </div>
                                            </div>
                                            <!--end col -->
                                            <div class="col-xxl-2 col-md-6">
                                                <div>
                                                    <label for="txtpdcst" class="form-label"><b>สถานะของข้อมูล</b></label>
                                                    <select class="required form-select" id="txtpdcst" name="txtpdcst" style="width: 100%; height:36px;" disabled="disabled" >
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
                                                <b>รายการครุภัณฑ์ย่อย: </b>
                                            </div>
                                            <!--end col -->
                                            <div class="col-xxl-6 col-md-6 text-left">

                                            </div>
                                            <!--end col -->
                                            <div class="col-xxl-12 col-md-12">

                                                <table id="exp02Table2" class="responsive-table table">
                                                    <tbody id="bodyTableAddFood2" class="tblfood2">
                                                        <?php
                                                        $i = 1;
                                                        foreach ($subsetlist as  $value_subset) {
                                                        ?>
                                                            <tr class='del'>
                                                                <td>
                                                                    <div class='row gy-4'>
                                                                        <h5>รายการที่ [<?php echo $value_subset['AMS_PRODUCTSUBSET_ID']; ?>]</h5>
                                                                        <div class='col-xxl-6 col-md-6'>
                                                                            <input type='hidden' name='idpdcchk2[]' value='<?php echo $value_subset['AMS_PRODUCTSUBSET_ID']; ?>'>
                                                                            <div><label for='txtproductsubno<?php echo $i; ?>' class='form-label'><b>เลขทะเบียนครุภัณฑ์ย่อย</b></label><input type='text' class='required form-control' value="<?php echo $value_subset['AMS_PRODUCTSUBSET_NO']; ?>" id='txtproductsubno<?php echo $i; ?>' name='txtproductsubno[]' required='required' maxlength='30' disabled='disabled'></div>
                                                                        </div>
                                                                        <div class='col-xxl-6 col-md-6'>
                                                                            <div><label for='txtproductsubname<?php echo $i; ?>' class='form-label'><b>ชื่อครุภัณฑ์ย่อย</b></label><input type='text' class='required form-control' value="<?php echo $value_subset['AMS_PRODUCTSUBSET_NM']; ?>" name='txtproductsubname[]' required='required' maxlength='200' disabled='disabled' ></div>
                                                                        </div>
                                                                        <hr />
                                                                </td>
                                                                <td>
                                                                   
                                                                </td>
                                                            </tr>
                                                        <?php $i++;
                                                        } ?>

                                                    </tbody>
                                                </table>

                                            </div>
                                            <!--end col -->
                                        </div>
                                        <!--end row-->
                                        <br>
                                        <div class="border-top">
                                            <div class="card-body text-right">
                                                <button type="button" class="btn btn-danger2" onclick="window.location.href='?Page=product-manage';"><i class="mdi mdi-arrow-left-circle"></i> กลับ</button>
                                                <button type="submit" class="btn btn-info2"><i class="mdi mdi-content-save"></i> บันทึกข้อมูล</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- //แก้ไขรายการ -->
                                </div>
                                <div class="tab-pane" id="border-navs-profile" role="tabpanel">
                                    <!-- แก้ไขชุด -->
                                    <form class="form-horizontal" id="f_productseted" name="f_productseted" action="?Page=pdc-resultkrp" method="post" autocomplete="off">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header align-items-center d-flex">
                                                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-plus-box"></i> <?php echo $idSet == "" ? 'เพิ่ม' : 'แก้ไข'; ?>ข้อมูลชุดครุภัณฑ์ <?php echo $idSet; ?></h4>
                                                        <div class="text-right">
                                                            <button type="button" class="btn btn-danger2" onclick="window.location.href='?Page=product-manage';"><i class="mdi mdi-arrow-left-circle"></i> กลับ</button>
                                                            <button type="submit" class="btn btn-info2"><i class="mdi mdi-content-save"></i> บันทึกข้อมูล</button>

                                                        </div>
                                                    </div>
                                                    <div class="card-body">

                                                        <div class="row gy-4">
                                                            <div class="col-xxl-6 col-md-6">
                                                                <div>
                                                                    <label for="txtproductsetno" class="form-label"><b>เลขชุดครุภัณฑ์</b></label>
                                                                    <input type="text" class="required form-control" value="<?php echo $ProductSetData['0']['AMS_PRODUCTSET_NO']; ?>" id="txtproductsetno" name="txtproductsetno" required="required" maxlength="30" disabled="disabled">
                                                                    <input type="hidden" class="required form-control" value="<?php echo $ProductSetData['0']['AMS_PRODUCTSET_NO']; ?>" id="txtproductsetnochk" name="txtproductsetno" required="required" maxlength="30">

                                                                </div>
                                                            </div>
                                                            <!--end col เช็คครุภัณฑ์ไม่ให้ซ้ำ-->
                                                            <div class="col-xxl-6 col-md-6">
                                                                <div>
                                                                    <label for="txtproductsetname" class="form-label"><b>ชื่อชุดครุภัณฑ์</b></label>
                                                                    <input type="text" class="required form-control" value="<?php echo $ProductSetData['0']['AMS_PRODUCTSET_NM']; ?>" name="txtproductsetname" required="required" maxlength="200" disabled="disabled" >

                                                                </div>
                                                            </div>
                                                            <!--end col -->
                                                            <div class="col-xxl-2 col-md-6" style="display: block;">
                                                                <div>
                                                                    <label for="txtsetunit" class="form-label"><b>จำนวน</b></label>
                                                                    <input type="number" class="required form-control" id="txtsetunit" name="txtsetunit" maxlength="10" value="<?php echo $ProductSetData['0']['AMS_PRODUCTSET_QTY']; ?>" readonly>
                                                                    <input type="hidden" class="required form-control" id="txtsetunitchk" name="txtsetunitchk" value="<?php echo $ProductSetData['0']['AMS_PRODUCTSET_QTY']; ?>">

                                                                </div>
                                                            </div>
                                                            <!--end col -->
                                                            <div class="col-xxl-2 col-md-6">
                                                                <div>
                                                                    <label for="txtsetprice" class="form-label"><b>ราคาชุดครุภัณฑ์ต่อหน่วย</b></label>
                                                                    <input type="text" class="required form-control" value="<?php echo $ProductSetData['0']['AMS_PRODUCTSET_PRICE']; ?>" required="required" name="txtsetprice" id="txtsetprice" data-type="currency" disabled="disabled">
                                                                    <input type="hidden" class="required form-control" value="<?php echo $ProductSetData['0']['AMS_PRODUCTSET_PRICE']; ?>" name="txtsetpricechk" id="txtsetpricechk">

                                                                </div>
                                                            </div>
                                                            <!--end col -->
                                                            <div class="col-xxl-4 col-md-6" style="display: none;">
                                                                <div>
                                                                    <label for="txtsetpriceall" class="form-label"><b>ราคารวม</b></label>
                                                                    <input type="text" class="required form-control" name="txtsetpriceall" id="txtsetpriceall" data-type="currency">

                                                                </div>
                                                            </div>
                                                            <!--end col -->
                                                            <div class="col-xxl-2 col-md-6">
                                                                <div>
                                                                    <label for="txtsdate2" class="form-label"><b>วันที่ส่งมอบ</b></label>
                                                                    <input type="text" class="required form-control" value="<?php echo $ProductEdit->dateToThai($ProductEditResult['0']['AMS_PRODUCT_SDATE']); ?>" id="txtsdate2" name="txtsdate2" required="required" disabled="disabled">

                                                                </div>
                                                            </div>
                                                            <!--end col -->
                                                            <div class="col-xxl-2 col-md-6">
                                                                <div>
                                                                    <label for="txtexpdate2" class="form-label"><b>วันสิ้นสุดประกัน</b></label>
                                                                    <input type="text" class="required form-control" id="txtexpdate2" value="<?php echo $ProductEdit->dateToThai($ProductEditResult['0']['AMS_PRODUCT_EXPDATE']); ?>" name="txtexpdate2" required="required" disabled="disabled" >

                                                                </div>
                                                            </div>
                                                            <!--end col -->

                                                            <div class="col-xxl-4 col-md-6">
                                                                <div>
                                                                    <label for="txtlctpdcset" class="form-label"><b>หน่วยงานรับผิดชอบ</b></label>
                                                                    <select class="required form-select js-example-basic-single" id="txtlctpdcset" name="txtlctpdcset" style="width: 100%; height:36px;" required>
                                                                        <option value="">เลือกหน่วยงานรับผิดชอบ</option>
                                                                        <?php foreach ($lctList as $key_lct => $value_lct) { ?>
                                                                            <option value="<?php echo $value_lct["AMS_LCT_ID"]; ?>" <?php if ($ProductSetData['0']['AMS_PRODUCTSET_LCT'] == $value_lct['AMS_LCT_ID']) {
                                                                                                                                        echo 'selected';
                                                                                                                                    } else {
                                                                                                                                    } ?>><?php echo $value_lct["AMS_LCT_NM"]; ?></option>
                                                                        <?php } ?>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <!--end col -->

                                                            <div class="col-xxl-4 col-md-6" style="display: none;">

                                                            </div>
                                                            <!--end col -->
                                                            <div class="col-xxl-2 col-md-6">
                                                                <div>
                                                                    <label for="txtyearatc2" class="form-label"><b>ปีงบประมาณ</b></label>
                                                                    <select class="required form-select" id="txtyearatc2" name="txtyearatc2" style="width: 100%; height:36px;" disabled="disabled" >
                                                                        <option value="<?php echo $ProductSetData['0']["AMS_PRODUCTSET_YEAR"]; ?>"><?php echo $ProductSetData['0']["AMS_PRODUCTSET_YEAR"] + 543; ?></option>
                                                                        <?php foreach ($YearbudgetAll as $key_bgyear => $value_bdyear) { ?>
                                                                            <option value="<?php echo $value_bdyear["BGYEAR"]; ?>"><?php echo $value_bdyear["BGYEAR"] + 543; ?></option>
                                                                        <?php } ?>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <!--end col -->
                                                            <div class="col-xxl-6 col-md-6">
                                                                <div>
                                                                    <label for="txtsourceatc2" class="form-label"><b>ที่มางบประมาณ</b></label>
                                                                    <select class="required form-select" id="txtsourceatc2" name="txtsourceatc2" style="width: 100%; height:36px;" disabled="disabled" >
                                                                        <option value="<?php echo $ProductSetData['0']["AMS_PRODUCTSET_SOURCE"]; ?>"><?php echo $ProductSetData['0']['AMS_BUDGET_SOURCENM'] . ' ' . $ProductSetData['0']['AMS_BUDGET_CLASSNM'] . ' ' . $ProductSetData['0']['AMS_BUDGET_TYPENM'] . '[' . number_format($ProductSetData['0']['AMS_BUDGET_AMOUNT'], 2) . ']'; ?></option>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <!--end col -->
                                                            <div class="col-xxl-4 col-md-6">
                                                                <div>
                                                                    <label for="txtpdcsetst" class="form-label"><b>สถานะของข้อมูล</b></label>
                                                                    <select class="required form-select" id="txtpdcsetst" name="txtpdcsetst" style="width: 100%; height:36px;" disabled="disabled">
                                                                        <option value="10" <?php if ($ProductSetData['0']["AMS_PRODUCTSET_ST"] == '10') {
                                                                                                echo 'selected';
                                                                                            } else {
                                                                                            } ?>>ใช้งาน</option>
                                                                        <option value="20" <?php if ($ProductSetData['0']["AMS_PRODUCTSET_ST"] == '20') {
                                                                                                echo 'selected';
                                                                                            } else {
                                                                                            } ?>>แบบร่าง</option>
                                                                    </select>
                                                                    <input type="hidden" class="form-control" id="fdate" name="fdate" value="<?= date('Y-m-d H:i:s'); ?>">
                                                                    <input type="hidden" class="form-control" id="fstf" name="fstf" value="<?php echo $_SESSION['id']; ?>">
                                                                    <input type="hidden" class="form-control" id="ActionProduct" name="ActionProduct" value="EditListSet">
                                                                    <input type="hidden" class="form-control" id="IdsetProduct" name="IdsetProduct" value="<?php echo $idSet; ?>">

                                                                </div>
                                                            </div>
                                                            <!--end col -->
                                                            <div class="col-xxl-4 col-md-6">
                                                                <div>
                                                                    <label for="txtrubpid" class="form-label"><b>ผู้รับผิดชอบ</b></label>
                                                                    <select class="form-select js-example-basic-single" id="txtrubpid" name="txtrubpid" style="width: 100%; height:36px;" disabled="disabled">
                                                                        <option value="">เลือกผู้รับผิดชอบ</option>
                                                                        <?php foreach ($result_listAllUser as $key_user => $value_user) { ?>
                                                                            <option value="<?php echo $value_user['AMS_USER_ID']; ?>" <?php if ($ProductSetData['0']["AMS_PRODUCTSET_RUB"] == $value_user['AMS_USER_ID']) {
                                                                                                                                            echo 'selected';
                                                                                                                                        } else {
                                                                                                                                        } ?>><?php echo $value_user['AMS_USER_PNAME'] . $value_user['AMS_USER_FNAME'] . ' ' . $value_user['AMS_USER_LNAME']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-xxl-4 col-md-6 text-center">

                                                            </div>
                                                            <div class="col-xxl-4 col-md-6 text-right">
                                                                <div>
                                                                    <hr />

                                                                    

                                                                </div>
                                                            </div>
                                                            <!--end col -->
                                                        </div>
                                                        <!--end row-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">

                                                <div class="card">
                                                    <div class="card-header align-items-center d-flex">
                                                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-plus-box"></i> <?php echo $idSet == "" ? 'เพิ่ม' : 'แก้ไข'; ?>รายการครุภัณฑ์ <?php echo $idSet; ?></h4>
                                                    </div><!-- end card header -->
                                                    <div class="card-body">
                                                        <table id="exp02Table" class="responsive-table table">
                                                            <tbody id="bodyTableAddFood" class="tblfood">
                                                                <?php
                                                                $i = 1;
                                                                foreach ($ListSetdata as $key_lset => $value_lset) { ?>
                                                                    <tr class='del'>
                                                                        <td>
                                                                            <div class='row gy-4'>
                                                                                <h5>รายการที่ [<?php echo $value_lset['AMS_PRODUCT_ID']; ?>]</h5>
                                                                                <div class='col-xxl-6 col-md-6'>
                                                                                    <input type='hidden' name='idpdcchk[]' value='<?php echo $value_lset['AMS_PRODUCT_ID']; ?>'>
                                                                                    <div><label for='txtproductno<?php echo $i; ?>' class='form-label'><b>เลขทะเบียนครุภัณฑ์</b></label><input type='text' class='required form-control' value='<?php echo $value_lset['AMS_PRODUCT_NO']; ?>' id='txtproductno<?php echo $i; ?>' name='txtproductno[]' required='required' maxlength='30' disabled='disabled'></div>
                                                                                </div>
                                                                                <div class='col-xxl-6 col-md-6'>
                                                                                    <div><label for='txtproductname<?php echo $i; ?>' class='form-label'><b>ชื่อครุภัณฑ์</b></label><input type='text' class='required form-control' value='<?php echo $value_lset['AMS_PRODUCT_NM']; ?>' name='txtproductname[]' required='required' maxlength='200' disabled='disabled'></div>
                                                                                </div>
                                                                                <div class='col-xxl-3 col-md-6'>
                                                                                    <div><label for='txtunit<?php echo $i; ?>' class='form-label'><b>หน่วยนับ</b></label><input type='text' class='required form-control' value='<?php echo $value_lset['AMS_PRODUCT_QTY']; ?>' name='txtunit[]' required='required' maxlength='10' disabled='disabled'></div>
                                                                                </div>
                                                                                <div class='col-xxl-3 col-md-6'>
                                                                                    <div id="pcddiv<?php echo $i; ?>"><label for='txtprice[]' class='form-label'><b>ราคา</b></label><input type='text' class='required form-control price' required='required' value='<?php echo $value_lset['AMS_PRODUCT_PRICE']; ?>' name='txtprice[]' id='txtprice[]' data-type='currency2' disabled='disabled'></div>
                                                                                </div>
                                                                                <div class='col-xxl-3 col-md-6'>
                                                                                    <div><label for='txtproductype<?php echo $i; ?>' class='form-label'><b>ประเภทของครุภัณฑ์</b></label><select class='required form-select js-example-basic-single' id='txtproductype<?php echo $i; ?>' name='txtproductype[]' style='width: 100%; height:36px;' disabled='disabled'>
                                                                                            <option value=''>เลือกประเภทของครุภัณฑ์</option>
                                                                                            <?php foreach ($DeprList as $key_depr => $value_depr) { ?>
                                                                                                <option value='<?php echo $value_depr['AMS_DEPRECIATION_ID']; ?>' <?php if ($value_lset['AMS_PRODUCT_TYPE'] == $value_depr['AMS_DEPRECIATION_ID']) {
                                                                                                                                                                        echo 'selected';
                                                                                                                                                                    } else {
                                                                                                                                                                    } ?>>
                                                                                                    <?php echo $value_depr['AMS_DEPRECIATION_TYPE']; ?>
                                                                                                </option><?php } ?>

                                                                                        </select></div>
                                                                                </div>
                                                                                <div class='col-xxl-3 col-md-6'>
                                                                                    <div><label for='txtlocation<?php echo $i; ?>' class='form-label'><b>สถานที่จัดเก็บ</b></label><input type='text' class='required form-control' value='<?php echo $value_lset['AMS_PRODUCT_LOC']; ?>' name='txtlocation[]' required='required' maxlength='100'></div>
                                                                                </div>

                                                                                <div class='col-xxl-3 col-md-6'>
                                                                                    <div>
                                                                                        <label for='txtstatusproductset<?php echo $i; ?>' class='form-label'><b>สถานะครุภัณฑ์</b></label>
                                                                                        <select class='required form-select' id='txtstatusproductset<?php echo $i; ?>' name='txtstatusproductset[]' style='width: 100%; height:36px;' disabled='disabled'>
                                                                                            <option value=''>เลือกสถานะครุภัณฑ์</option>
                                                                                            <option value='10' <?php if ($value_lset["AMS_PRODUCT_ST"] == '10') {
                                                                                                                    echo 'selected';
                                                                                                                } else {
                                                                                                                } ?>>ปกติ</option>
                                                                                            <option value='20' <?php if ($value_lset["AMS_PRODUCT_ST"] == '20') {
                                                                                                                    echo 'selected';
                                                                                                                } else {
                                                                                                                } ?>>เสีย</option>
                                                                                            <option value='30' <?php if ($value_lset["AMS_PRODUCT_ST"] == '30') {
                                                                                                                    echo 'selected';
                                                                                                                } else {
                                                                                                                } ?>>รอแทงจำหน่าย</option>
                                                                                            <option value='40' <?php if ($value_lset["AMS_PRODUCT_ST"] == '40') {
                                                                                                                    echo 'selected';
                                                                                                                } else {
                                                                                                                } ?>>แทงจำหน่าย/ตัดออกจากบัญชี</option>
                                                                                        </select>

                                                                                    </div>
                                                                                </div>
                                                                                <div class='col-xxl-2 col-md-6'>
                                                                                    <div>
                                                                                        <label for='txtpdcsetstlist<?php echo $i; ?>' class='form-label'><b>สถานะของข้อมูล</b></label>
                                                                                        <select class='required form-select' id='txtpdcsetstlist<?php echo $i; ?>' name='txtpdcsetstlist[]' style='width: 100%; height:36px;' disabled='disabled'>
                                                                                            <option value='10' <?php if ($value_lset["AMS_PRODUCT_DELST"] == '10') {
                                                                                                                    echo 'selected';
                                                                                                                } else {
                                                                                                                } ?>>ใช้งาน</option>
                                                                                            <option value='20' <?php if ($value_lset["AMS_PRODUCT_DELST"] == '20') {
                                                                                                                    echo 'selected';
                                                                                                                } else {
                                                                                                                } ?>>แบบร่าง</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <hr />
                                                                        </td>
                                                                        <td>

                                                                        </td>
                                                                    </tr>
                                                                <?php $i++;
                                                                } ?>

                                                            </tbody>
                                                        </table>

                                                        <!-- </form> -->
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </form>

                                    <!-- //แก้ไขชุด -->
                                </div>

                            </div>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->

    </div>
</div>