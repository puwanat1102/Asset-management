<?php
$_SESSION['chkDup'] = '0';
include 'report_funtion.php';
$ReportResult = new ReportResult();

$DeprList = $ReportResult->Deprlist($db);
$YearbudgetAll = $ReportResult->YearBudgets($db);
$PDC10Display = $ReportResult->CountPDCToDisplay(10);
$PDC20Display = $ReportResult->CountPDCToDisplay(20);
$PDC30Display = $ReportResult->CountPDCToDisplay(30);
$PDC40Display = $ReportResult->CountPDCToDisplay(40);
$PDCAllDisplay = $ReportResult->CountPDCToDisplay(100);
$CNT10Display = isset($PDC10Display['0']['CNTPDC']) ? $PDC10Display['0']['CNTPDC'] : '0';
$CNT20Display = isset($PDC20Display['0']['CNTPDC']) ? $PDC20Display['0']['CNTPDC'] : '0';
$CNT30Display = isset($PDC30Display['0']['CNTPDC']) ? $PDC30Display['0']['CNTPDC'] : '0';
$CNT40Display = isset($PDC40Display['0']['CNTPDC']) ? $PDC40Display['0']['CNTPDC'] : '0';
$CNTAllDisplay = isset($PDCAllDisplay['0']['CNTPDC']) ? $PDCAllDisplay['0']['CNTPDC'] : '0';
$ActionDisplay = isset($_POST['ActionDisplay']) ? $_POST['ActionDisplay'] : 'Nodata';
$ProductNo = '';
$ProductName = '';
$ProductType = isset($_POST['txttypes']) ? $_POST['txttypes'] : '';
$ProductStatus = isset($_POST['txtprdst']) ? $_POST['txtprdst'] : '';
$ProductYear = isset($_POST['txtyearatc']) ? $_POST['txtyearatc'] : '';
$ProductSource = isset($_POST['txtsourceatc']) ? $_POST['txtsourceatc'] : '';
$ProductDatast = isset($_POST['txtexpdate']) ? $_POST['txtexpdate'] : '';
$ProductSet = '';
$rpedcob = isset($_POST['txtlctpdc']) ? $_POST['txtlctpdc'] : '';
$chkfocus = isset($_POST['chkfocus']) ? $_POST['chkfocus'] : '';
$AmountToYear = $ReportResult->Amountbudget($ProductSource, $db);

$ListAllProduct = $ReportResult->ListProduct($ProductNo, $ProductName, $ProductType, $ProductStatus, $ProductYear, $ProductSource, $ProductDatast, $rpedcob, $db);
$ListAllProductDisKH = $ReportResult->ListProductDisplayToKH($ProductNo, $ProductName, $ProductType, $ProductStatus, $ProductYear, $ProductSource, $ProductDatast, $rpedcob);
$lctList = $ReportResult->Lctlist();
?>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-file-chart-outline"></i> รายงานครุภัณฑ์ </h4>

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
            </div>
            <!-- S -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0 flex-grow-1"> ค้นหาข้อมูลรายงานครุภัณฑ์ </h4>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" id="f_reportpdc" name="f_reportpdc" action="?Page=report-pdc" method="post" autocomplete="off">
                        <div class="row gy-4">

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
                            <div class="col-xxl-6 col-md-6">
                                <div>
                                    <label for="txtsourceatc" class="form-label"><b>ที่มางบประมาณ</b></label>
                                    <select class="required form-select" id="txtsourceatc" name="txtsourceatc" style="width: 100%; height:36px;">

                                        <option value="">ทั้งหมด</option>
                                    </select>

                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="txtlctpdc" class="form-label"><b>หน่วยงานรับผิดชอบ</b></label>
                                    <select class="required form-select js-example-basic-single" id="txtlctpdc" name="txtlctpdc" style="width: 100%; height:36px;">
                                        <option name="txtlctpdc" value="">ทั้งหมด</option>
                                        <?php foreach ($lctList as $key_lct => $value_lct) { ?>
                                            <option value="<?php echo $value_lct["AMS_LCT_ID"]; ?>"><?php echo $value_lct["AMS_LCT_NM"]; ?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>
                            <!--end col -->

                            <div class="col-xxl-4 col-md-6">
                                <div>
                                    <label for="txttypes" class="form-label"><b>ประเภทครุภัณฑ์</b></label>
                                    <select class="form-select js-example-basic-single" id="txttypes" name="txttypes" <?php echo $chkfocus == 'focus' ? 'autofocus' : ''; ?>>
                                        <option value="">ทั้งหมด</option>
                                        <?php foreach ($DeprList as $key_depr => $value_depr) { ?>
                                            <option value="<?php echo $value_depr["AMS_DEPRECIATION_ID"]; ?>"><?php echo $value_depr["AMS_DEPRECIATION_TYPE"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-4 col-md-6">
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
                                    <label for="txtexpdate" class="form-label"><b>สถานะการรับประกัน</b></label>
                                    <select class="form-select" id="txtexpdate" name="txtexpdate">
                                        <option value="3">ทั้งหมด</option>
                                        <option value="0">ยังอยู่ในประกัน</option>
                                        <option value="1">ประกันหมดอายุ</option>
                                    </select>
                                    <input type="hidden" value="Display" name="ActionDisplay">
                                </div>
                            </div>
                            <!--end col-->

                        </div>
                        <!--end row-->
                        <br>
                        <div class="border-top">
                            <div class="card-body text-right">
                                <input type="hidden" value="focus" name="chkfocus">
                                <button type="submit" class="btn btn-info2 text-light"><i class="mdi mdi-database-search"></i> ค้นหา</button>
                                <button type="button" class="btn btn-warning2 text-light" onClick="window.location.href = '?Page=report-pdc'"><i class="mdi mdi-backup-restore"></i> Reset</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /S -->
            <!--  -->
            <div class="card" style="display: <?php if ($ActionDisplay == 'Display') {
                                                    echo 'block';
                                                } else {
                                                    echo 'none';
                                                } ?> ;">
                <div class="card-header">
                    <h4 class="card-title mb-0 flex-grow-1"> จำนวนครุภัณฑ์ปีงบประมาณ
                        <?php echo $ProductYear != "" ? ": <span class='badge bg-light text-dark'>" . ($ProductYear + 543) . "</span>" : ""; ?>
                        <?php echo $ProductSource != "" ? " <span class='badge bg-light text-dark'>" . $AmountToYear['0']['AMS_BUDGET_SOURCENM'] . ' ' . $AmountToYear['0']['AMS_BUDGET_CLASSNM'] . ' ' . $AmountToYear['0']['AMS_BUDGET_TYPENM'] . "</span>" : ""; ?>
                        <?php echo $rpedcob != "" ? "หน่วยงานที่รับผิดชอบ: <span class='badge bg-light text-dark'>" . $ReportResult->DisplayHeader($rpedcob, 2) . "</span>" : ""; ?>
                        <?php echo $ProductType != "" ? "ประเภทครุภัณฑ์: <span class='badge bg-light text-dark'>" . $ReportResult->DisplayHeader($ProductType, 1) . "</span>" : ""; ?>
                        <?php if ($ProductStatus == "10") {
                            $disStasus = "ปกติ";
                        } elseif ($ProductStatus == "20") {
                            $disStasus = "เสีย";
                        } elseif ($ProductStatus == "30") {
                            $disStasus = "รอแทงจำหน่าย";
                        } elseif ($ProductStatus == "40") {
                            $disStasus = "แทงจำหน่าย/ตัดออกจากบัญชี";
                        } else {
                            $disStasus = "";
                        } ?>
                        <?php echo $ProductStatus != "" ? "สถานะครุภัณฑ์: <span class='badge bg-light text-dark'>" . $disStasus . "</span>" : ""; ?>
                        <?php if ($ProductDatast == "0") {
                            $disSt = "ยังอยู่ในประกัน";
                        } elseif ($ProductDatast == "1") {
                            $disSt = "ประกันหมดอายุ";
                        } else {
                            $disSt = "";
                        } ?>
                        <?php echo $ProductDatast != "3" ? "สถานะการรับประกัน: <span class='badge bg-light text-dark'>" . $disSt . "</span>" : ""; ?>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    foreach ($ListAllProductDisKH as $value_kh) {
                        if ($value_kh['AMS_PRODUCT_ST'] == '10') {
                            $DisTOKH10 = $value_kh['CNT'];
                        } elseif ($value_kh['AMS_PRODUCT_ST'] == '20') {
                            $DisTOKH20 = $value_kh['CNT'];
                        } elseif ($value_kh['AMS_PRODUCT_ST'] == '30') {
                            $DisTOKH30 = $value_kh['CNT'];
                        } elseif ($value_kh['AMS_PRODUCT_ST'] == '40') {
                            $DisTOKH40 = $value_kh['CNT'];
                        } else {
                            $DisTOKH10 = 0;
                            $DisTOKH20 = 0;
                            $DisTOKH30 = 0;
                            $DisTOKH40 = 0;
                        }
                    }

                    $DisTOKH10Y = isset($DisTOKH10) ? $DisTOKH10 : 0;
                    $DisTOKH20Y = isset($DisTOKH20) ? $DisTOKH20 : 0;
                    $DisTOKH30Y = isset($DisTOKH30) ? $DisTOKH30 : 0;
                    $DisTOKH40Y = isset($DisTOKH40) ? $DisTOKH40 : 0;
                    $DisTOKHAll = $DisTOKH10Y + $DisTOKH20Y + $DisTOKH30Y + $DisTOKH40Y;
                    ?>
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
                                        <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $DisTOKHAll; ?>">0</span> รายการ</h4>
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
                                        <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $DisTOKH10Y; ?>">0</span> รายการ</h4>
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
                                        <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $DisTOKH20Y; ?>">0</span> รายการ</h4>
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
                                        <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $DisTOKH30Y; ?>">0</span> รายการ</h4>
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
                                        <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $DisTOKH40Y; ?>">0</span> รายการ</h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--  -->
            <!-- Table -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-format-list-checks"></i> รายละเอียด
                    </h4>
                </div>
                <div class="card-body">
                    <!-- 1$ProductNo, 2$ProductName, 3$ProductType, 4$ProductStatus, 5$ProductYear, 6$ProductSource, 7$ProductDatast, 8$rpedcob, -->
                <?php if ($ActionDisplay == 'Display') { ?>
                    <div class="mt-3">
                        <button class="btn btn-sm btn-success2" onclick="window.open('./pages/reports/excel/Ex_product.php?p1=<?php echo $ProductNo; ?>&p2=<?php echo $ProductName; ?>&p3=<?php echo $ProductType; ?>&p4=<?php echo $ProductStatus; ?>&p5=<?php echo $ProductYear; ?>&p6=<?php echo $ProductSource; ?>&p7=<?php echo $ProductDatast; ?>&p8=<?php echo $rpedcob; ?>','pwin')"><i class="mdi mdi-file-excel"></i> รายงานรูปแบบ Excel</button>
                        <button class="btn btn-sm btn-danger2" onclick="window.open('./pages/reports/pdf/Pdf_product.php?p1=<?php echo $ProductNo; ?>&p2=<?php echo $ProductName; ?>&p3=<?php echo $ProductType; ?>&p4=<?php echo $ProductStatus; ?>&p5=<?php echo $ProductYear; ?>&p6=<?php echo $ProductSource; ?>&p7=<?php echo $ProductDatast; ?>&p8=<?php echo $rpedcob; ?>','pwin')"><i class="mdi mdi-file-pdf-box"></i> รายงานรูปแบบ PDF</button>
                    </div>

                    <div class="mt-3"></div>
                    <?php }else{ } ?>
                    <table id="producrmanagereport" class="table table-bordered dt-responsive  table-striped align-middle text-wrap table-hover" style="width:100%">

                        <thead>
                            <tr class="text-center">
                                <th hidden>ปี</th>
                                <th hidden>ที่มา</th>
                                <th hidden>ชุด</th>
                                <th hidden>รหัสครุภัณฑ์</th>
                                <th>เลขทะเบียนครุภัณฑ์</th>
                                <th>ชื่อครุภัณฑ์</th>
                                <th>ราคา</th>
                                <th>สถานะครุภัณฑ์</th>
                                <th>อายุการใช้งาน</th>
                                <th>ชุดครุภัณฑ์</th>
                                <th>ปีงบประมาณและที่มา</th>
                                <th hidden>วันที่หมดประกัน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($ActionDisplay == 'Display') {
                                foreach ($ListAllProduct as $key => $value) {
                            ?>
                                    <tr>
                                        <td hidden><?php echo $value['AMS_PRODUCT_YEAR']; ?></td>
                                        <td hidden><?php echo $value['AMS_BUDGET_SOURCENM']; ?></td>
                                        <td hidden><?php echo $value['AMS_PRODUCTSET_NO']; ?></td>
                                        <td hidden><?php echo $value['AMS_PRODUCT_ID']; ?></td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($value["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value["AMS_PRODUCTSET_NO"] . ' | ' . $value["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value['AMS_BUDGET_SOURCENM'] . ' ' . $value['AMS_BUDGET_CLASSNM'] . ' ' . $value['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value['AMS_PRODUCTSET_PRICE'], 2); ?>"><?php echo $value['AMS_PRODUCT_NO']; ?></td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($value["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value["AMS_PRODUCTSET_NO"] . ' | ' . $value["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value['AMS_BUDGET_SOURCENM'] . ' ' . $value['AMS_BUDGET_CLASSNM'] . ' ' . $value['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value['AMS_PRODUCTSET_PRICE'], 2); ?>"><?php echo $value['AMS_PRODUCT_NM']; ?></td>
                                        <td><?php echo number_format($value['AMS_PRODUCT_PRICE'], 2); ?></td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($value["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value["AMS_PRODUCTSET_NO"] . ' | ' . $value["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value['AMS_BUDGET_SOURCENM'] . ' ' . $value['AMS_BUDGET_CLASSNM'] . ' ' . $value['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <h5><span class="badge rounded-pill bg-light text-dark"><?php echo $value['AMS_PRODUCT_STNM']; ?></span></h5>
                                        </td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($value["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value["AMS_PRODUCTSET_NO"] . ' | ' . $value["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value['AMS_BUDGET_SOURCENM'] . ' ' . $value['AMS_BUDGET_CLASSNM'] . ' ' . $value['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value['AMS_PRODUCTSET_PRICE'], 2); ?>"> <?php echo $ReportResult->AgeProduct($value['AMS_PRODUCT_SDATE']); ?></td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($value["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value["AMS_PRODUCTSET_NO"] . ' | ' . $value["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value['AMS_BUDGET_SOURCENM'] . ' ' . $value['AMS_BUDGET_CLASSNM'] . ' ' . $value['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value['AMS_PRODUCTSET_PRICE'], 2); ?>"><?php echo $value['AMS_PRODUCTSET_NO']; ?></td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($value["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value["AMS_PRODUCTSET_NO"] . ' | ' . $value["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value['AMS_BUDGET_SOURCENM'] . ' ' . $value['AMS_BUDGET_CLASSNM'] . ' ' . $value['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <h5><span class="badge rounded-pill bg-light text-dark"><?php echo $value['AMS_PRODUCT_YEAR'] + 543 . ' ' . $value['AMS_BUDGET_SOURCENM']; ?></span><span class="badge rounded-pill bg-light text-dark"><?php echo $value['AMS_BUDGET_CLASSNM']; ?></span><span class="badge rounded-pill bg-<?php echo $value['AMS_BUDGET_TYPE'] == '301' ? 'success' : 'warning'; ?> text-dark"><?php echo $value['AMS_BUDGET_TYPENM']; ?></span></h5>
                                        </td>
                                        <td hidden><?php echo $value['AMS_PRODUCT_EXPDATE']; ?></td>
                                    </tr>
                                <?php  }
                            } else { ?>
                                <!-- ไม่พบข้อมูล -->
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- /Table -->
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

                        <!-- <div class="col-md-12  rssubset" id="rssubset">
                            <label for="txtpfdatemodal" class="col-form-label"><b>รายการครุภัณย่อย:</b></label>
                        </div> -->

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