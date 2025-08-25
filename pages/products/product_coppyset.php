<?php
$_SESSION['chkDup'] = '0';
include 'product_function.php';
$ProductEdit = new ProductResult();
$lctList = $ProductEdit->Lctlist($db);
$DeprList = $ProductEdit->Deprlist($db);
$YearbudgetAll = $ProductEdit->YearBudgets($db);
$idSet = isset($_POST['txtproductset']) ? $_POST['txtproductset'] : '';
$ProductSetData = $ProductEdit->ProductSetEditAll($idSet, $db);
$ListSetdata = $ProductEdit->ListProductToSetEdit($idSet, $db);
$editId = $ListSetdata['0']['AMS_PRODUCT_ID'];
$StatusId = $ListSetdata['0']['AMS_PRODUCT_ST'];
$ProductEditResult = $ProductEdit->ListProductEdit($editId, $db);
$result_listAllUser = $ProductEdit->ListUserAMS($db);
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
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills nav-customs nav-danger mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#border-navs-profile" role="tab"><i class="mdi mdi-data-matrix-edit"></i> เพิ่มชุดครุภัณฑ์</a>
                            </li>

                        </ul><!-- Tab panes -->
                        <div class="tab-content text-muted">
                            <div class="tab-pane active" id="border-navs-profile" role="tabpanel">
                                <!-- แก้ไขชุด -->
                                <form class="form-horizontal" id="f_productset" name="f_productset" action="?Page=pdc-result" method="post" autocomplete="off">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header align-items-center d-flex">
                                                    <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-plus-box"></i> <?php echo $idSet == "" ? 'เพิ่ม' : 'เพิ่ม'; ?>ข้อมูลชุดครุภัณฑ์จากชุด <?php echo $ProductSetData['0']['AMS_PRODUCTSET_NM']; ?></h4>
                                                    <div class="text-right">
                                                        <button type="button" class="btn btn-danger2" onclick="window.location.href='?Page=pdc-addsetpre';"><i class="mdi mdi-arrow-left-circle"></i> กลับ</button>

                                                        <button type="submit" class="btn btn-info2"><i class="mdi mdi-content-save"></i> บันทึกข้อมูล</button>

                                                    </div>
                                                </div>
                                                <div class="card-body">

                                                    <div class="row gy-4">
                                                        <div class="col-xxl-6 col-md-6">
                                                            <div>
                                                                <label for="txtproductsetno" class="form-label"><b>เลขชุดครุภัณฑ์</b></label>
                                                                <input type="text" class="required form-control" id="txtproductsetno" name="txtproductsetno" required="required" maxlength="30">


                                                            </div>
                                                        </div>
                                                        <!--end col เช็คครุภัณฑ์ไม่ให้ซ้ำ-->
                                                        <div class="col-xxl-6 col-md-6">
                                                            <div>
                                                                <label for="txtproductsetname" class="form-label"><b>ชื่อชุดครุภัณฑ์</b></label>
                                                                <input type="text" class="required form-control" name="txtproductsetname" value="<?php echo $ProductSetData['0']['AMS_PRODUCTSET_NM']; ?>" required="required" maxlength="200">

                                                            </div>
                                                        </div>
                                                        <!--end col -->
                                                        <div class="col-xxl-2 col-md-6" style="display: block;">
                                                            <div>
                                                                <label for="txtsetunit" class="form-label"><b>จำนวนรายการครุภัณฑ์</b></label>
                                                                <input type="number" class="required form-control" id="txtsetunit" name="txtsetunit" maxlength="10" value="<?php echo $ProductSetData['0']['AMS_PRODUCTSET_QTY']; ?>" readonly>

                                                            </div>
                                                        </div>
                                                        <!--end col -->
                                                        <div class="col-xxl-2 col-md-6">
                                                            <div>
                                                                <label for="txtsetprice" class="form-label"><b>ราคาชุดครุภัณฑ์ต่อหน่วย</b></label>
                                                                <input type="text" class="required form-control" value="<?php echo $ProductSetData['0']['AMS_PRODUCTSET_PRICE']; ?>" required="required" name="txtsetprice" id="txtsetprice" data-type="currency">

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
                                                                <label for="txtsdate" class="form-label"><b>วันที่ส่งมอบ</b></label>
                                                                <input type="text" class="required form-control" value="<?php echo $ProductEdit->dateToThai($ProductEditResult['0']['AMS_PRODUCT_SDATE']); ?>" id="txtsdate" name="txtsdate" required="required">

                                                            </div>
                                                        </div>
                                                        <!--end col -->
                                                        <div class="col-xxl-2 col-md-6">
                                                            <div>
                                                                <label for="txtexpdate" class="form-label"><b>วันสิ้นสุดประกัน</b></label>
                                                                <input type="text" class="required form-control" id="txtexpdate" value="<?php echo $ProductEdit->dateToThai($ProductEditResult['0']['AMS_PRODUCT_EXPDATE']); ?>" name="txtexpdate" required="required">

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

                                                        <div class="col-xxl-2 col-md-6" style="display: block;">
                                                            <div>
                                                                <label for="txtstatusproductset" class="form-label"><b>สถานะครุภัณฑ์</b></label>
                                                                <select class="required form-select" id="txtstatusproductset" name="txtstatusproductset" style="width: 100%; height:36px;">
                                                                    <option value="">เลือกสถานะครุภัณฑ์</option>
                                                                    <option value="10" <?php if ($StatusId == '10') {
                                                                                            echo 'selected';
                                                                                        } else {
                                                                                        } ?>>ปกติ</option>
                                                                    <option value="20" <?php if ($StatusId == '20') {
                                                                                            echo 'selected';
                                                                                        } else {
                                                                                        } ?>>เสีย</option>
                                                                    <option value="30" <?php if ($StatusId == '30') {
                                                                                            echo 'selected';
                                                                                        } else {
                                                                                        } ?>>รอแทงจำหน่าย</option>
                                                                    <option value="40" <?php if ($StatusId == '40') {
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
                                                                <select class="required form-select" id="txtyearatc" name="txtyearatc" style="width: 100%; height:36px;">
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
                                                                <label for="txtsourceatc" class="form-label"><b>ที่มางบประมาณ</b></label>
                                                                <select class="required form-select" id="txtsourceatc" name="txtsourceatc" style="width: 100%; height:36px;">
                                                                    <option value="<?php echo $ProductSetData['0']["AMS_PRODUCTSET_SOURCE"]; ?>"><?php echo $ProductSetData['0']['AMS_BUDGET_SOURCENM'] . ' ' . $ProductSetData['0']['AMS_BUDGET_CLASSNM'] . ' ' . $ProductSetData['0']['AMS_BUDGET_TYPENM'] . '[' . number_format($ProductSetData['0']['AMS_BUDGET_AMOUNT'], 2) . ']'; ?></option>
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <!--end col -->
                                                        <div class="col-xxl-2 col-md-6">
                                                            <div>
                                                                <label for="txtpdcsetst" class="form-label"><b>สถานะของข้อมูล</b></label>
                                                                <select class="required form-select" id="txtpdcsetst" name="txtpdcsetst" style="width: 100%; height:36px;" required>
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
                                                                <input type="hidden" class="form-control" id="ActionProduct" name="ActionProduct" value="AddListSet">
                                                                <input type="hidden" class="form-control" id="IdsetProduct" name="IdsetProduct" value="<?php echo $idSet; ?>">

                                                            </div>
                                                        </div>
                                                        <!--end col -->
                                                        <div class="col-xxl-4 col-md-6">
                                                            <div>
                                                                <label for="txtrubpid" class="form-label"><b>ผู้รับผิดชอบ</b></label>
                                                                <select class="form-select js-example-basic-single" id="txtrubpid" name="txtrubpid" style="width: 100%; height:36px;">
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
                                                            <!-- <h4 class="text-danger">*ใส่ราคาต่อหน่วยแล้วกดที่ปุ่มปรับปรุงข้อมูลราคา</h4> -->
                                                        </div>
                                                        <div class="col-xxl-4 col-md-6 text-right">
                                                            <div>
                                                                <hr />
                                                                <!-- <button type="button" class="btn btn-info text-dark" id="price-buttoned">ปรับปรุงข้อมูลราคา</button> -->
                                                                <!-- <button type="button" class="btn btn-success text-dark" id="row-buttoned">เพิ่มรายการครุภัณฑ์</button>
                                                                <button type="button" class="btn btn-danger2 text-dark" id="remove-button">ลบรายการที่เพิ่ม</button> -->

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
                                                    <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-plus-box"></i> <?php echo $idSet == "" ? 'เพิ่ม' : 'เพิ่ม'; ?>รายการครุภัณฑ์จากชุด <?php echo $ProductSetData['0']['AMS_PRODUCTSET_NM']; ?></h4>
                                                </div><!-- end card header -->
                                                <div class="card-body">
                                                    <table id="exp02Table" class="responsive-table table">
                                                        <tbody id="bodyTableAddFood" class="tblfood">
                                                            <?php
                                                            $i = 1;
                                                            foreach ($ListSetdata as $key_lset => $value_lset) { 
                                                                    $subsetlist = $ProductEdit->productSubsetList2($value_lset['AMS_PRODUCT_ID'], $db);
                                                                ?>
                                                                <tr class='del'>
                                                                    <td>
                                                                        <div class='row gy-4'>
                                                                            <h5>รายการที่ [<?php echo $i; ?>]</h5>
                                                                            <div class='col-xxl-6 col-md-6'>
                                                                                <input type='hidden' name='idpdcchk[]' value='<?php echo $value_lset['AMS_PRODUCT_ID']; ?>'>
                                                                                <div><label for='txtproductno<?php echo $i; ?>' class='form-label'><b>เลขทะเบียนครุภัณฑ์</b></label><input type='text' class='required form-control' id='txtproductno<?php echo $i; ?>' name='txtproductno[]' required='required' maxlength='30'></div>
                                                                            </div>
                                                                            <div class='col-xxl-6 col-md-6'>
                                                                                <div><label for='txtproductname<?php echo $i; ?>' class='form-label'><b>ชื่อครุภัณฑ์</b></label><input type='text' value='<?php echo $value_lset['AMS_PRODUCT_NM']; ?>' class='required form-control' name='txtproductname[]' required='required' maxlength='200'></div>
                                                                            </div>
                                                                            <div class='col-xxl-3 col-md-6'>
                                                                                <div><label for='txtunit<?php echo $i; ?>' class='form-label'><b>หน่วยนับ</b></label><input type='text' class='required form-control' value='<?php echo $value_lset['AMS_PRODUCT_QTY']; ?>' name='txtunit[]' required='required' maxlength='10'></div>
                                                                            </div>
                                                                            <div class='col-xxl-3 col-md-6'>
                                                                                <div id="pcddiv<?php echo $i; ?>"><label for='txtprice[]' class='form-label'><b>ราคา</b></label><input type='text' class='required form-control price' required='required' value='<?php echo $value_lset['AMS_PRODUCT_PRICE']; ?>' name='txtprice[]' id='txtprice[]' data-type='currency2'></div>
                                                                            </div>
                                                                            <div class='col-xxl-3 col-md-6'>
                                                                                <div><label for='txtproductype<?php echo $i; ?>' class='form-label'><b>ประเภทของครุภัณฑ์</b></label><select class='required form-select js-example-basic-single' id='txtproductype<?php echo $i; ?>' name='txtproductype[]' style='width: 100%; height:36px;' required>
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
                                                                            <!-- <div class='col-xxl-3 col-md-6'>
                                                                                <div>
                                                                                    <label for='txtlctpdcset' class='form-label'><b>หน่วยงานรับผิดชอบ</b></label>
                                                                                    <select class='required form-select js-example-basic-single' id='txtlctpdcset' name='txtlctpdcset' style='width: 100%; height:36px;' required>
                                                                                        <option value=''>เลือกหน่วยงานรับผิดชอบ</option>
                                                                                        <?php foreach ($lctList as $key_lct => $value_lct) { ?>
                                                                                            <option value='<?php echo $value_lct['AMS_LCT_ID']; ?>' <?php if ($value_lset['AMS_PRODUCT_LCT'] == $value_lct['AMS_LCT_ID']) {
                                                                                                                                                        echo 'selected';
                                                                                                                                                    } else {
                                                                                                                                                    } ?>><?php echo $value_lct['AMS_LCT_NM']; ?></option>
                                                                                        <?php } ?>
                                                                                    </select>

                                                                                </div>
                                                                            </div> -->

                                                                            <hr />
                                                                    </td>
                                                                    <td>

                                                                        <!-- <input type="checkbox" class="btn-check" name="chkDel[<?php echo $i - 1; ?>]" id="btn-check-2-outlined<?php echo $i; ?>" value="1">
                                                                                <label class="btn btn-outline-danger shadow-none" for="btn-check-2-outlined<?php echo $i; ?>"><i class="mdi mdi-trash-can"></i></label> -->
                                                                        <!-- <button type="button" class="btn btn-danger2 text-dark btnDelete">ลบ</button> -->
                                                                        <!-- <button type="button" class="btn btn-danger2 text-dark btnDelete2" data-bs-toggle="modal" data-bs-target="#DeleteSetProductModal" data-bs-idbd="<?php echo $value_lset['AMS_PRODUCT_ID']; ?>" data-bs-delnm="<?php echo $value_lset["AMS_PRODUCT_NO"]; ?>" data-bs-idset="<?php echo $idSet; ?>">ลบ</button> -->


                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <div class="col-xxl-12 col-md-12">

                                                                        <table id="exp02Table2" class="responsive-table table table-info">
                                                                            <tbody id="bodyTableAddFood2" class="tblfood2">
                                                                                <?php
                                                                                
                                                                                $ii = 1;
                                                                                foreach ($subsetlist as  $value_subset) {
                                                                                ?>
                                                                                    <tr class='del'>
                                                                                        <td>
                                                                                            <div class='row gy-4'>
                                                                                                <h5>รายการที่ [<?php echo $value_subset['AMS_PRODUCTSUBSET_ID']; ?>]</h5>
                                                                                                <div class='col-xxl-6 col-md-6'>
                                                                                                    <input type='hidden' name='idpdcchk2[]' value='<?php echo $value_subset['AMS_PRODUCTSUBSET_ID']; ?>'>
                                                                                                    <div><label for='txtproductsubno<?php echo $ii; ?>' class='form-label'><b>เลขทะเบียนครุภัณฑ์ย่อย</b></label><input type='text' class='required form-control' value="<?php echo $value_subset['AMS_PRODUCTSUBSET_NO']; ?>" id='txtproductsubno<?php echo $ii; ?>' name='txtproductsubno[]' required='required' maxlength='30'></div>
                                                                                                </div>
                                                                                                <div class='col-xxl-6 col-md-6'>
                                                                                                    <div>
                                                                                                        <label for='txtproductsubname<?php echo $ii; ?>' class='form-label'><b>ชื่อครุภัณฑ์ย่อย</b></label><input type='text' class='required form-control' value="<?php echo $value_subset['AMS_PRODUCTSUBSET_NM']; ?>" name='txtproductsubname[]' required='required' maxlength='200'>
                                                                                                        <input type='hidden' class='required form-control' name='txtchksubandpdc[]' value='<?php echo $i; ?>' >
                                                                                                    </div>
                                                                                                </div>
                                                                                                <hr />
                                                                                        </td>
                                                                                        <td>
                                                                                            <!-- <input type="checkbox" class="btn-check" name="chkDel2[<?php echo $ii - 1; ?>]" id="btn-check-2-outlined<?php echo $ii; ?>" value="1">
                                                                                            <label class="btn btn-outline-danger shadow-none" for="btn-check-2-outlined<?php echo $ii; ?>"><i class="mdi mdi-trash-can"></i></label> -->
                                                                                        </td>
                                                                                    </tr>
                                                                                <?php $ii++;
                                                                                } ?>

                                                                            </tbody>
                                                                        </table>

                                                                    </div>
                                                                    <!--end col -->
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
                    </div><!-- end card-body -->
                </div>
            </div>
            <!--end col-->

        </div>

    </div>
</div>