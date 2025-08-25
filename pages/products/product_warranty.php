<?php
$_SESSION['chkDup'] = '0';
include 'product_function.php';
$ProductList = new ProductResult();
$Atcfdate =  isset($_POST['txtexpdatewar']) ? $ProductList->dateTosave($_POST['txtexpdatewar']) : '';
$Atcldate =  isset($_POST['txtexpdatewar2']) ? $ProductList->dateTosave($_POST['txtexpdatewar2']) : '';
$Atcstatus =  isset($_POST['txtatcst']) ? $_POST['txtatcst'] : '';
$AtcexpdateST =  isset($_POST['warrantycheck']) ? $_POST['warrantycheck'] : '0';

$ListAllProductWar = $ProductList->ListProductAllWarranty($AtcexpdateST, $Atcfdate, $Atcldate, $Atcstatus, $db);
$dateNowWar = date('Y-m-d');
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
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-database-search"></i> ค้นหาข้อมูลครุภัณฑ์ [ การรับประกัน ]</h4>
                    </div><!-- end card header -->
                    <div class="card-body">

                        <form class="form-horizontal" id="f_spdcwar" name="f_spdcwar" action="?Page=pdc-war" method="post" autocomplete="off">
                            <div class="row gy-4">
                                <div class="col-xxl-6 col-md-6 text-center">
                                    <br>
                                    <div class="form-check form-check-inline">

                                        <input type="radio" class="btn-check" name="warrantycheck" id="curren" onchange='if(this.value != 9) { this.form.submit(); }' value="0" <?php if ($AtcexpdateST == '0') {
                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                } else {
                                                                                                                                                                                } ?> required>
                                        <label class="btn btn-outline-success shadow-none" for="curren"><i class="mdi mdi-calendar-check-outline"></i> ยังอยู่ในประกัน</label>

                                        <input type="radio" class="btn-check" name="warrantycheck" id="exp" onchange='if(this.value != 9) { this.form.submit(); }' value="1" <?php if ($AtcexpdateST == '1') {
                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                } else {
                                                                                                                                                                                } ?> required>
                                        <label class="btn btn-outline-danger2 shadow-none" for="exp"><i class="mdi mdi-calendar-clock-outline"></i> ประกันหมดอายุ</label>

                                        <input type="radio" class="btn-check" name="warrantycheck" id="Nowexp" onchange='if(this.value != 9) { this.form.submit(); }' value="2" <?php if ($AtcexpdateST == '2') {
                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                } else {
                                                                                                                                                                                } ?> required>
                                        <label class="btn btn-outline-secondary shadow-none" for="Nowexp"><i class="mdi mdi-calendar-cursor"></i>หมดอายุเดือนนี้</label>

                                        <input type="radio" class="btn-check" name="warrantycheck" id="allexp" onchange='if(this.value != 9) { this.form.submit(); }' value="3" <?php if ($AtcexpdateST == '3') {
                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                } else {
                                                                                                                                                                                } ?> required>
                                        <label class="btn btn-outline-primary2 shadow-none" for="allexp"><i class="mdi mdi-calendar-multiple"></i> ทั้งหมด</label>

                                    </div>

                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="txtexpdatewar" class="form-label"><b>วันสิ้นสุดรับประกันตั้งแต่</b></label>
                                        <input type="text" class="form-control" id="txtexpdatewar" name="txtexpdatewar">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="txtexpdatewar2" class="form-label"><b>ถึง</b></label>
                                        <input type="text" class="form-control" id="txtexpdatewar2" name="txtexpdatewar2">
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="txtatcst" class="form-label"><b>สถานะข้อมูล</b></label>
                                        <select class="form-select" id="txtatcst" name="txtatcst">
                                            <option value="">ทั้งหมด</option>
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
                                    <button type="submit" class="btn btn-info2 text-light"><i class="mdi mdi-database-search"></i> ค้นหา</button>
                                    <button type="button" class="btn btn-warning2 text-light" onClick="window.location.href = '?Page=pdc-war'"><i class="mdi mdi-backup-restore"></i> Reset</button>
                                </div>
                            </div>
                        </form>



                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-format-list-bulleted"></i> รายการครุภัณฑ์</h4>

                    </div><!-- end card header -->
                    <div class="card-body">

                        <table id="producrmanagewar" class="table table-bordered dt-responsive  table-striped align-middle text-wrap table-hover" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th hidden></th>
                                    <th>วันสิ้นสุดรับประกัน</th>
                                    <th>เลขทะเบียนครุภัณฑ์</th>
                                    <th>ชื่อครุภัณฑ์</th>
                                    <th>ราคา</th>
                                    <th>ชุดครุภัณฑ์</th>
                                    <th>อายุ</th>
                                    <th>สถานะครุภัณฑ์</th>
                                    <!-- <th>สถานะข้อมูล</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ListAllProductWar as $key_pdc => $value_pdc) {
                                    $Yearsource = $value_pdc["AMS_PRODUCT_YEAR"] + 543;
                                ?>
                                    <tr class="text-center">
                                        <td hidden><?php echo $value_pdc["AMS_PRODUCT_EXPDATE"]; ?></td>
                                        <td  class="cursor-pointer subset" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value_pdc["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value_pdc["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pdc["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value_pdc["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pdc['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ProductList->dateToThai($value_pdc["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ProductList->dateToThai($value_pdc["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pdc["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pdc["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pdc["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pdc["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pdc["AMS_PRODUCTSET_NO"].' | '.$value_pdc["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pdc["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pdc['AMS_BUDGET_SOURCENM'] . ' ' . $value_pdc['AMS_BUDGET_CLASSNM'] . ' ' . $value_pdc['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value_pdc['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pdc["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value_pdc['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pdc['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <h5><span class="badge rounded-pill bg-<?php echo $value_pdc['AMS_PRODUCT_EXPDATE'] < $dateNowWar ? 'danger' : 'success'; ?> text-dark"><i class="mdi mdi-sort-calendar-ascending"></i> <?php echo $ProductList->dateToThai($value_pdc["AMS_PRODUCT_EXPDATE"]); ?></span></h5>
                                        </td>
                                        <td class="cursor-pointer subset" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value_pdc["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value_pdc["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pdc["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value_pdc["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pdc['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ProductList->dateToThai($value_pdc["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ProductList->dateToThai($value_pdc["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pdc["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pdc["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pdc["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pdc["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pdc["AMS_PRODUCTSET_NO"].' | '.$value_pdc["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pdc["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pdc['AMS_BUDGET_SOURCENM'] . ' ' . $value_pdc['AMS_BUDGET_CLASSNM'] . ' ' . $value_pdc['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value_pdc['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pdc["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value_pdc['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pdc['AMS_PRODUCTSET_PRICE'], 2); ?>"><?php echo $value_pdc["AMS_PRODUCT_NO"]; ?></td>
                                        <td  class="cursor-pointer subset" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value_pdc["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value_pdc["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pdc["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value_pdc["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pdc['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ProductList->dateToThai($value_pdc["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ProductList->dateToThai($value_pdc["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pdc["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pdc["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pdc["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pdc["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pdc["AMS_PRODUCTSET_NO"].' | '.$value_pdc["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pdc["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pdc['AMS_BUDGET_SOURCENM'] . ' ' . $value_pdc['AMS_BUDGET_CLASSNM'] . ' ' . $value_pdc['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value_pdc['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pdc["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value_pdc['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pdc['AMS_PRODUCTSET_PRICE'], 2); ?>"><?php echo $value_pdc["AMS_PRODUCT_NM"]; ?></td>
                                        <td  class="cursor-pointer subset" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value_pdc["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value_pdc["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pdc["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value_pdc["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pdc['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ProductList->dateToThai($value_pdc["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ProductList->dateToThai($value_pdc["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pdc["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pdc["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pdc["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pdc["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pdc["AMS_PRODUCTSET_NO"].' | '.$value_pdc["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pdc["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pdc['AMS_BUDGET_SOURCENM'] . ' ' . $value_pdc['AMS_BUDGET_CLASSNM'] . ' ' . $value_pdc['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value_pdc['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pdc["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value_pdc['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pdc['AMS_PRODUCTSET_PRICE'], 2); ?>"><?php echo number_format($value_pdc['AMS_PRODUCT_PRICE'], 2); ?></td>
                                        <td class="cursor-pointer subset" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value_pdc["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value_pdc["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pdc["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value_pdc["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pdc['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ProductList->dateToThai($value_pdc["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ProductList->dateToThai($value_pdc["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pdc["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pdc["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pdc["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pdc["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pdc["AMS_PRODUCTSET_NO"].' | '.$value_pdc["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pdc["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pdc['AMS_BUDGET_SOURCENM'] . ' ' . $value_pdc['AMS_BUDGET_CLASSNM'] . ' ' . $value_pdc['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value_pdc['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pdc["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value_pdc['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pdc['AMS_PRODUCTSET_PRICE'], 2); ?>"><?php echo $value_pdc["AMS_PRODUCTSET_NM"]; ?></td>
                                        <td class="cursor-pointer subset" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value_pdc["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value_pdc["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pdc["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value_pdc["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pdc['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ProductList->dateToThai($value_pdc["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ProductList->dateToThai($value_pdc["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pdc["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pdc["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pdc["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pdc["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pdc["AMS_PRODUCTSET_NO"].' | '.$value_pdc["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pdc["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pdc['AMS_BUDGET_SOURCENM'] . ' ' . $value_pdc['AMS_BUDGET_CLASSNM'] . ' ' . $value_pdc['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value_pdc['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pdc["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value_pdc['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pdc['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <?php echo $ProductList->AgeProduct($value_pdc['AMS_PRODUCT_SDATE']); ?>
                                        </td>
                                        <!-- <td class="cursor-pointer subset" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value_pdc["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value_pdc["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pdc["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value_pdc["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pdc['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ProductList->dateToThai($value_pdc["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ProductList->dateToThai($value_pdc["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pdc["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pdc["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pdc["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pdc["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pdc["AMS_PRODUCTSET_NO"].' | '.$value_pdc["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pdc["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pdc['AMS_BUDGET_SOURCENM'] . ' ' . $value_pdc['AMS_BUDGET_CLASSNM'] . ' ' . $value_pdc['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value_pdc['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pdc["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value_pdc['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pdc['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <h5><span class="badge rounded-pill bg-<?php echo $value_pdc['AMS_PRODUCT_DELST'] == '10' ? 'info' : 'danger'; ?> text-dark"><i class="mdi mdi-tag"></i> <?php echo $value_pdc['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?></h5></span>
                                        </td> -->
                                        <td  class="cursor-pointer subset" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value_pdc["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value_pdc["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pdc["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value_pdc["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pdc['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ProductList->dateToThai($value_pdc["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ProductList->dateToThai($value_pdc["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pdc["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pdc["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pdc["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pdc["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pdc["AMS_PRODUCTSET_NO"].' | '.$value_pdc["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pdc["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pdc['AMS_BUDGET_SOURCENM'] . ' ' . $value_pdc['AMS_BUDGET_CLASSNM'] . ' ' . $value_pdc['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value_pdc['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pdc["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value_pdc['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pdc['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <h5><span class="badge rounded-pill bg-light text-dark"><?php echo $value_pdc["AMS_PRODUCT_STNM"]; ?></span></h5>
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


<div class="modal fade" id="ProductcontentModal" tabindex="-1" aria-labelledby="ProductcontentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ProductcontentModalLabel">รายละเอียดข้อมูล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-5  pno">
                            <label for="txtpno" class="col-form-label"><b>เลขทะเบียนครุภัณฑ์:</b></label>
                            <input type="text" class="form-control" id="txtpno" disabled="disabled">
                        </div>
                        <div class="col-md-7  pname">
                            <label for="txtpnamemodal" class="col-form-label"><b>ชื่อครุภัณฑ์:</b></label>
                            <input type="text" class="form-control" id="txtpnamemodal" disabled="disabled">
                        </div>
                        <div class="col-md-2  unit">
                            <label for="txtunitmodal" class="col-form-label"><b>หน่วยนับ:</b></label>
                            <input type="text" class="form-control" id="txtunitmodal" disabled="disabled">
                        </div>
                        <div class="col-md-4  price">
                            <label for="txtpricemodal" class="col-form-label"><b>ราคา:</b></label>
                            <input type="text" class="form-control" id="txtpricemodal" disabled="disabled">
                        </div>
                        <div class="col-md-3  sdate">
                            <label for="txtsdatemodal" class="col-form-label"><b>วันที่ส่งมอบ:</b></label>
                            <input type="text" class="form-control" id="txtsdatemodal" disabled="disabled">
                        </div>
                        <div class="col-md-3  expdate">
                            <label for="txtexpdatemodal" class="col-form-label"><b>วันสิ้นสุดประกัน:</b></label>
                            <input type="text" class="form-control" id="txtexpdatemodal" disabled="disabled">
                        </div>
                        <div class="col-md-4  ptype">
                            <label for="txtptypemodal" class="col-form-label"><b>ประเภทของครุภัณฑ์:</b></label>
                            <input type="text" class="form-control" id="txtptypemodal" disabled="disabled">
                        </div>
                        <div class="col-md-4  plct">
                            <label for="txtplctmodal" class="col-form-label"><b>หน่วยงานรับผิดชอบ:</b></label>
                            <input type="text" class="form-control" id="txtplctmodal" disabled="disabled">
                        </div>
                        <div class="col-md-4  ploc">
                            <label for="txtplocmodal" class="col-form-label"><b>สถานที่จัดเก็บ:</b></label>
                            <input type="text" class="form-control" id="txtplocmodal" disabled="disabled">
                        </div>
                        <div class="col-md-4 pstatus">
                            <label for="txtpstatusmodal" class="col-form-label"><b>สถานะครุภัณฑ์:</b></label>
                            <input type="text" class="form-control" id="txtpstatusmodal" disabled="disabled">
                        </div>
                        <div class="col-md-8  pset">
                            <label for="txtpsetmodal" class="col-form-label"><b>ชื่อชุดครุภัณฑ์:</b></label>
                            <input type="text" class="form-control" id="txtpsetmodal" disabled="disabled">
                        </div>
                        <div class="col-md-4 pcntset">
                            <label for="txtpcntsemodal" class="col-form-label"><b>จำนวนรายการต่อชุด:</b></label>
                            <input type="text" class="form-control" id="txtpcntsemodal" disabled="disabled">
                        </div>
                        <div class="col-md-8 ppriceunit">
                            <label for="txtppriceunitmodal" class="col-form-label"><b>ราคาชุดครุภัณฑ์ต่อหน่วย:</b></label>
                            <input type="text" class="form-control" id="txtppriceunitmodal" disabled="disabled">
                        </div>
                        <!-- <div class="col-md-4 ppricetotal">
                            <label for="txtppricetotalmodal" class="col-form-label"><b>ราคารวม:</b></label>
                            <input type="text" class="form-control" id="txtppricetotalmodal" disabled="disabled">
                        </div> -->
                        <div class="col-md-4 pyear">
                            <label for="txtpyearmodal" class="col-form-label"><b>ปีงบประมาณ:</b></label>
                            <input type="text" class="form-control" id="txtpyearmodal" disabled="disabled">
                        </div>
                        <div class="col-md-8  psource">
                            <label for="txtpsourcemodal" class="col-form-label"><b>ที่มางบประมาณ:</b></label>
                            <input type="text" class="form-control" id="txtpsourcemodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  pdatast">
                            <label for="txtpdatastmodal" class="col-form-label"><b>สถานะของข้อมูล:</b></label>
                            <input type="text" class="form-control" id="txtpdatastmodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  pfdate">
                            <label for="txtpfdatemodal" class="col-form-label"><b>วันที่บันทึก:</b></label>
                            <input type="text" class="form-control" id="txtpfdatemodal" disabled="disabled">
                        </div>

                        <div class="col-md-12  rssubset" id="rssubset">
                            <label for="txtpfdatemodal" class="col-form-label"><b>รายการครุภัณย่อย:</b></label>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">ปิด</button>
                <!-- <button type="button" class="btn btn-primary">Send message</button> -->
            </div>
        </div>
    </div>
</div>
<!--end modal -->
