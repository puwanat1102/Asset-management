<?php
$_SESSION['chkDup'] = '0';
include 'product_function.php';
$ProductList = new ProductResult();

$ProductNo = isset($_POST['txtproductno']) ? $_POST['txtproductno'] : '';
$ProductName = isset($_POST['txtproductnm']) ? $_POST['txtproductnm'] : '';
$ProductType = isset($_POST['txttypes']) ? $_POST['txttypes'] : '';
$ProductStatus = isset($_POST['txtprdst']) ? $_POST['txtprdst'] : '';
$ProductYear = isset($_POST['txtyearatc']) ? $_POST['txtyearatc'] : '';
$ProductSource = isset($_POST['txtsourceatc']) ? $_POST['txtsourceatc'] : '';
$ProductDatast = isset($_POST['txtpdcstdata']) ? $_POST['txtpdcstdata'] : '';
$ProductSet = isset($_POST['txtproductset']) ? $_POST['txtproductset'] : '';

$ListAllProduct = $ProductList->ListProduct($ProductNo, $ProductName, $ProductType, $ProductStatus, $ProductYear, $ProductSource, $ProductDatast, $ProductSet, $db);
$YearbudgetAll = $ProductList->YearBudgets($db);
$DeprList = $ProductList->Deprlist($db);
$SetAll = $ProductList->ProductSetAllList($db);

$PDC10Display = $ProductList->CountPDCToDisplay(10);
$PDC20Display = $ProductList->CountPDCToDisplay(20);
$PDC30Display = $ProductList->CountPDCToDisplay(30);
$PDC40Display = $ProductList->CountPDCToDisplay(40);
$PDCAllDisplay = $ProductList->CountPDCToDisplay(100);
$CNT10Display = isset($PDC10Display['0']['CNTPDC']) ? $PDC10Display['0']['CNTPDC'] : '0';
$CNT20Display = isset($PDC20Display['0']['CNTPDC']) ? $PDC20Display['0']['CNTPDC'] : '0';
$CNT30Display = isset($PDC30Display['0']['CNTPDC']) ? $PDC30Display['0']['CNTPDC'] : '0';
$CNT40Display = isset($PDC40Display['0']['CNTPDC']) ? $PDC40Display['0']['CNTPDC'] : '0';
$CNTAllDisplay = isset($PDCAllDisplay['0']['CNTPDC']) ? $PDCAllDisplay['0']['CNTPDC'] : '0';
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
                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1"> จำนวนครุภัณฑ์ทั้งหมด </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <div class="d-flex align-items-center bg-info mt-2">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info rounded-2 fs-2">
                                            <i data-feather="database"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <h5 class="text-uppercase fw-medium text-light text-truncate mt-3">
                                            ครุภัณฑ์ทั้งหมด</h5>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $CNTAllDisplay; ?>">0</span> รายการ</h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-9 col-md-9"></div>
                            <div class="col-lg-3 col-md-3">
                                <div class="d-flex align-items-center bg-success mt-2">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success rounded-2 fs-2">
                                            <i data-feather="printer"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <h5 class="text-uppercase fw-medium text-light text-truncate mt-3">
                                            ครุภัณฑ์ปกติ</h5>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $CNT10Display; ?>">0</span> รายการ</h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="d-flex align-items-center bg-danger mt-2">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-danger rounded-2 fs-2">
                                            <i data-feather="alert-triangle"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <h5 class="text-uppercase fw-medium text-light text-truncate mt-3">
                                            ครุภัณฑ์เสีย</h5>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $CNT20Display; ?>">0</span> รายการ</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="d-flex align-items-center bg-warning mt-2">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-warning rounded-2 fs-2">
                                            <i data-feather="clock"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <h5 class="text-uppercase fw-medium text-light text-truncate mt-3">
                                            ครุภัณฑ์รอแทงจำหน่าย</h5>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $CNT30Display; ?>">0</span> รายการ</h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="d-flex align-items-center bg-primarycus mt-2">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primarycus rounded-2 fs-2">
                                            <i data-feather="stop-circle"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <h5 class="text-uppercase fw-medium text-light text-truncate mt-3">
                                            ครุภัณฑ์แทงจำหน่าย/ตัดออกจากบัญชี</h5>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $CNT40Display; ?>">0</span> รายการ</h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-database-search"></i> ค้นหาข้อมูลครุภัณฑ์</h4>
                    </div><!-- end card header -->
                    <div class="card-body">

                        <form class="form-horizontal" id="f_productsr" name="f_productsr" action="?Page=product-manage" method="post" autocomplete="off">
                            <div class="row gy-4">
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="txtproductno" class="form-label"><b>เลขทะเบียนครุภัณฑ์</b></label>
                                        <input type="text" class="form-control" name="txtproductno">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                        <label for="txtproductnm" class="form-label"><b>ชื่อครุภัณฑ์</b></label>
                                        <input type="text" class="form-control" name="txtproductnm">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="txttypes" class="form-label"><b>ประเภทครุภัณฑ์</b></label>
                                        <select class="form-select js-example-basic-single" id="txttypes" name="txttypes">
                                            <option value="">ทั้งหมด</option>
                                            <?php foreach ($DeprList as $key_depr => $value_depr) { ?>
                                                <option value="<?php echo $value_depr["AMS_DEPRECIATION_ID"]; ?>"><?php echo $value_depr["AMS_DEPRECIATION_TYPE"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="txtprdst" class="form-label"><b>สถานะครุภัณฑ์</b></label>
                                        <select class="form-select" id="txtprdst" name="txtprdst">
                                            <option value="">ทั้งหมด</option>
                                            <option value="10">ปกติ</option>
                                            <option value="20">เสีย</option>
                                            <option value="30">รอแทงจำหน่าย</option>
                                            <option value="40">แทงจำหน่าย/ตัดออกจากบัญชี</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                        <label for="txtproductset" class="form-label"><b>ชุดครุภัณฑ์</b></label>
                                        <select class="form-select js-example-basic-single" id="txtproductset" name="txtproductset">
                                            <option value="">ทั้งหมด</option>
                                            <?php foreach ($SetAll as $key_set => $value_set) { ?>
                                                <option value="<?php echo $value_set['AMS_PRODUCTSET_ID']; ?>"><?php echo  $value_set['AMS_PRODUCTSET_NO'] . ' | ' . $value_set['AMS_PRODUCTSET_NM']; ?></option>
                                            <?php  } ?>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="txtyearatc" class="form-label"><b>ปีงบประมาณ</b></label>
                                        <select class="required form-select" id="txtyearatc" name="txtyearatc" style="width: 100%; height:36px;">
                                            <option value="">ทั้งหมด</option>
                                            <?php foreach ($YearbudgetAll as $key_bgyear => $value_bdyear) { ?>
                                                <option value="<?php echo $value_bdyear["BGYEAR"]; ?>"><?php echo $value_bdyear["BGYEAR"] + 543; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                        <label for="txtsourceatc" class="form-label"><b>ที่มางบประมาณ</b></label>
                                        <select class="required form-select" id="txtsourceatc" name="txtsourceatc" style="width: 100%; height:36px;">
                                            <option value="">ทั้งหมด</option>
                                        </select>

                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="txtpdcstdata" class="form-label"><b>สถานะข้อมูล</b></label>
                                        <select class="form-select" id="txtpdcstdata" name="txtpdcstdata">
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
                                    <button type="button" class="btn btn-warning2 text-light" onClick="window.location.href = '?Page=product-manage'"><i class="mdi mdi-backup-restore"></i> Reset</button>
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
                        <?php if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202') { ?>
                            <div class="text-right"><button class="btn btn-md btn-success3" onClick="location.href='?Page=pdc-add'"><i class="mdi mdi-folder-plus"></i> เพิ่มรายการครุภัณฑ์</button></div>&nbsp;
                            <div class="text-right"><button class="btn btn-md btn-success2" onClick="location.href='?Page=pdc-addsetpre'"><i class="mdi mdi-folder-star-multiple"></i> เพิ่มพร้อมชุดครุภัณฑ์</button></div>
                        <?php } else {
                        } ?>
                    </div><!-- end card header -->
                    <div class="card-body">

                        <table id="producrmanage" class="table table-bordered dt-responsive  table-striped align-middle text-wrap table-hover" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th hidden>รหัสครุภัณฑ์</th>
                                    <th>เลขทะเบียนครุภัณฑ์</th>
                                    <th>ชื่อครุภัณฑ์</th>
                                    <th>ราคา</th>
                                    <th>ชุดครุภัณฑ์</th>
                                    <th>ที่มางบประมาณ</th>
                                    <th>อายุ</th>
                                    <th>สถานะครุภัณฑ์</th>
                                    <!-- <th>สถานะข้อมูล</th> -->
                                    <th width="3%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($ListAllProduct as $key_pro => $value_pro) {
                                ?>
                                    <tr class="text-center">
                                        <td hidden><?php echo $value_pro['AMS_PRODUCT_ID']; ?></td>
                                        <td class="cursor-pointer subset" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value_pro["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value_pro["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pro["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value_pro["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pro['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ProductList->dateToThai($value_pro["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ProductList->dateToThai($value_pro["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pro["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pro["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pro["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pro["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pro["AMS_PRODUCTSET_NO"] . ' | ' . $value_pro["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pro["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pro['AMS_BUDGET_SOURCENM'] . ' ' . $value_pro['AMS_BUDGET_CLASSNM'] . ' ' . $value_pro['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value_pro['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pro["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value_pro['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pro['AMS_PRODUCTSET_PRICE'], 2); ?>"><?php echo $value_pro['AMS_PRODUCT_NO']; ?></td>
                                        <td class="cursor-pointer subset" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value_pro["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value_pro["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pro["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value_pro["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pro['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ProductList->dateToThai($value_pro["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ProductList->dateToThai($value_pro["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pro["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pro["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pro["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pro["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pro["AMS_PRODUCTSET_NO"] . ' | ' . $value_pro["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pro["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pro['AMS_BUDGET_SOURCENM'] . ' ' . $value_pro['AMS_BUDGET_CLASSNM'] . ' ' . $value_pro['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value_pro['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pro["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value_pro['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pro['AMS_PRODUCTSET_PRICE'], 2); ?>"><?php echo $value_pro['AMS_PRODUCT_NM']; ?></td>
                                        <td class="cursor-pointer subset" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value_pro["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value_pro["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pro["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value_pro["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pro['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ProductList->dateToThai($value_pro["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ProductList->dateToThai($value_pro["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pro["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pro["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pro["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pro["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pro["AMS_PRODUCTSET_NO"] . ' | ' . $value_pro["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pro["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pro['AMS_BUDGET_SOURCENM'] . ' ' . $value_pro['AMS_BUDGET_CLASSNM'] . ' ' . $value_pro['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value_pro['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pro["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value_pro['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pro['AMS_PRODUCTSET_PRICE'], 2); ?>"><?php echo number_format($value_pro['AMS_PRODUCT_PRICE'], 2); ?></td>
                                        <td class="cursor-pointer subset" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value_pro["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value_pro["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pro["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value_pro["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pro['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ProductList->dateToThai($value_pro["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ProductList->dateToThai($value_pro["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pro["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pro["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pro["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pro["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pro["AMS_PRODUCTSET_NO"] . ' | ' . $value_pro["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pro["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pro['AMS_BUDGET_SOURCENM'] . ' ' . $value_pro['AMS_BUDGET_CLASSNM'] . ' ' . $value_pro['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value_pro['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pro["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value_pro['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pro['AMS_PRODUCTSET_PRICE'], 2); ?>"><?php echo $value_pro['AMS_PRODUCTSET_NO']; ?></td>
                                        <td class="cursor-pointer subset" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value_pro["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value_pro["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pro["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value_pro["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pro['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ProductList->dateToThai($value_pro["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ProductList->dateToThai($value_pro["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pro["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pro["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pro["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pro["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pro["AMS_PRODUCTSET_NO"] . ' | ' . $value_pro["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pro["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pro['AMS_BUDGET_SOURCENM'] . ' ' . $value_pro['AMS_BUDGET_CLASSNM'] . ' ' . $value_pro['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value_pro['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pro["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value_pro['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pro['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <h5><span class="badge rounded-pill bg-light text-dark"><?php echo $value_pro['AMS_PRODUCT_YEAR'] + 543 . ' ' . $value_pro['AMS_BUDGET_SOURCENM']; ?></span><span class="badge rounded-pill bg-light text-dark"><?php echo $value_pro['AMS_BUDGET_CLASSNM']; ?></span><span class="badge rounded-pill bg-<?php echo $value_pro['AMS_BUDGET_TYPE'] == '301' ? 'success' : 'warning'; ?> text-dark"><?php echo $value_pro['AMS_BUDGET_TYPENM']; ?></span></h5>
                                        </td>
                                        <!-- <td class="cursor-pointer subset" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value_pro["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value_pro["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pro["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value_pro["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pro['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ProductList->dateToThai($value_pro["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ProductList->dateToThai($value_pro["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pro["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pro["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pro["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pro["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pro["AMS_PRODUCTSET_NO"] . ' | ' . $value_pro["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pro["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pro['AMS_BUDGET_SOURCENM'] . ' ' . $value_pro['AMS_BUDGET_CLASSNM'] . ' ' . $value_pro['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value_pro['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pro["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value_pro['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pro['AMS_PRODUCTSET_PRICE'], 2); ?>"  >
                                            <h5><span class="badge rounded-pill bg-<?php echo $value_pro['AMS_PRODUCT_DELST'] == '10' ? 'info' : 'danger'; ?> text-dark"><i class="mdi mdi-tag"></i> <?php echo $value_pro['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?></h5></span>
                                        </td> -->
                                        <td class="cursor-pointer subset" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value_pro["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value_pro["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pro["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value_pro["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pro['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ProductList->dateToThai($value_pro["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ProductList->dateToThai($value_pro["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pro["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pro["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pro["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pro["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pro["AMS_PRODUCTSET_NO"] . ' | ' . $value_pro["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pro["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pro['AMS_BUDGET_SOURCENM'] . ' ' . $value_pro['AMS_BUDGET_CLASSNM'] . ' ' . $value_pro['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value_pro['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pro["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value_pro['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pro['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <?php echo $ProductList->AgeProduct($value_pro['AMS_PRODUCT_SDATE']); ?>
                                        </td>
                                        <td class="cursor-pointer subset" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value_pro["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value_pro["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pro["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value_pro["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pro['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ProductList->dateToThai($value_pro["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ProductList->dateToThai($value_pro["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pro["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pro["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pro["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pro["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pro["AMS_PRODUCTSET_NO"] . ' | ' . $value_pro["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pro["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pro['AMS_BUDGET_SOURCENM'] . ' ' . $value_pro['AMS_BUDGET_CLASSNM'] . ' ' . $value_pro['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value_pro['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pro["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value_pro['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pro['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <h5><span class="badge rounded-pill bg-light text-dark"><?php echo $value_pro['AMS_PRODUCT_STNM']; ?></span></h5>
                                        </td>
                                        <td>
                                            <?php if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202' || $_SESSION["grp"] == '203') {

                                                if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202') {
                                            ?>

                                                    <form action="?Page=pdc-<?php if ($value_pro['AMS_PRODUCT_SET'] == "") {
                                                                                echo 'add';
                                                                            } else {
                                                                                echo 'addseted';
                                                                            } ?>" method="POST">
                                                        <input type="hidden" value="<?php echo $value_pro['AMS_PRODUCT_ID']; ?>" name="editIdValue">
                                                        <button class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</button>
                                                    </form>
                                                <?php } else { ?>
                                                    <form action="?Page=pdc-addkrp" method="POST">
                                                        <input type="hidden" value="<?php echo $value_pro['AMS_PRODUCT_ID']; ?>" name="editIdValue">
                                                        <button type="submit" class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</button>
                                                    </form>
                                                <?php } ?>
                                                <?php if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202') { ?>
                                                    <button class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 remove-item-btn" data-bs-toggle="modal" data-bs-target="#DeletebudgetModal" data-bs-idbd="<?php echo $value_pro['AMS_PRODUCT_ID']; ?>" data-bs-delnm="<?php echo $value_pro["AMS_PRODUCT_NO"]; ?>">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                    </button>
                                            <?php } else {
                                                }
                                            } else {
                                            } ?>
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
<div class="modal fade zoomIn" id="DeletebudgetModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="?Page=pdc-result" method="POST">
                    <div class="iddel"><input type="hidden" name="txtiddel" class="form-control"></div>
                    <input type="hidden" name="ActionProduct" value="Del" class="form-control">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5 delname">
                            <h4>คุณต้องการลบข้อมูล</h4>
                            <b></b>
                            <h4>หรือไม่ ?</h4>
                            <p class="text-muted mx-4 mb-0">ถ้าต้องการลบกรุณากดปุ่มยืนยัน ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn w-sm btn-danger2 " id="delete-record">ยืนยันลบข้อมูล</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end modal -->


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