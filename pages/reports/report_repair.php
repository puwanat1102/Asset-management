<?php
$_SESSION['chkDup'] = '0';
include 'report_funtion.php';
$ReportResult = new ReportResult();
$ProcessRepair = $ReportResult->ReportRepairProcessing($db);
$TotalProcess = count($ProcessRepair);
$UsersaveRepair = $ReportResult->ListRepairForUser($db);

$rpfdate = isset($_POST['txtfdate']) ? $ReportResult->dateTosave($_POST['txtfdate']) : '';
$rpldate = isset($_POST['txtldate']) ? $ReportResult->dateTosave($_POST['txtldate']) : '';
$rpfdate2 = isset($_POST['txtfdate']) ? $_POST['txtfdate'] : '';
$rpldate2 = isset($_POST['txtldate']) ? $_POST['txtldate'] : '';
$rppcdno = isset($_POST['txtproductno']) ? $_POST['txtproductno'] : '';
$rppcdnm = isset($_POST['txtproductnm']) ? $_POST['txtproductnm'] : '';
$rpsdate = isset($_POST['txtsucessdate']) ? $ReportResult->dateTosave($_POST['txtsucessdate']) : '';
$rpcpn = isset($_POST['txtrpcpn']) ? $_POST['txtrpcpn'] : '';
$rpfsave = isset($_POST['txtfsave']) ? $_POST['txtfsave'] : '';
$rpst = isset($_POST['textstrp']) ? $_POST['textstrp'] : '';
$rpdst = isset($_POST['txtrpstdata']) ? $_POST['txtrpstdata'] : '';
$rpaped = isset($_POST['txttypes']) ? $_POST['txttypes'] : '';
$rpedcob = isset($_POST['txtlctpdc']) ? $_POST['txtlctpdc'] : '';
$chkfocus = isset($_POST['chkfocus']) ? $_POST['chkfocus'] : '';

$lctList = $ReportResult->Lctlist();
$DeprList = $ReportResult->Deprlist($db);
$TabAllRP = $ReportResult->RepairAllTabResult($rpfdate, $rpldate, $rppcdno, $rppcdnm, $rpsdate, $rpcpn, $rpfsave, $rpst, $rpdst, $rpaped, $rpedcob, $db);
$DataNowTh = date('Y') + 543;
$YearRepairAll = $ReportResult->RepairAllYear(1);
$DisplayYearAllRp = isset($YearRepairAll['0']['CNTRPYEAR']) ? $YearRepairAll['0']['CNTRPYEAR'] : '';
$YearRepairAllBudget = $ReportResult->RepairAllYear(2);
$DisplayYearAllRpBd = isset($YearRepairAllBudget['0']['SUMRPYEAR']) ? $YearRepairAllBudget['0']['SUMRPYEAR'] : '';
?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-file-chart-outline"></i> รายงานการซ่อมบำรุง </h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="d-flex align-items-center bg-yellowcus mt-2">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-yellowcus rounded-2 fs-2">
                                            <i data-feather="clock"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <h5 class="text-uppercase fw-medium text-light text-truncate mt-3">
                                            รายการอยู่ระหว่างการซ่อม</h5>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $TotalProcess; ?>">0</span> รายการ</h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="d-flex align-items-center bg-primarycus mt-2">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title text-warp  bg-primarycus rounded-2 fs-2">
                                            <i data-feather="bar-chart"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <h5 class="text-uppercase text-warp fw-medium text-light text-truncate mt-3">
                                            ปริมาณการส่งซ่อมประจำปีงบประมาณ <?php echo $DataNowTh; ?></h5>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $DisplayYearAllRp; ?>">0</span> รายการ</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="d-flex align-items-center bg-success mt-2">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success rounded-2 fs-2">
                                            <i data-feather="briefcase"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <h5 class="text-uppercase text-warp  fw-medium text-light text-truncate mt-3">
                                            ค่าใช้จ่ายในการซ่อมรวม ประจำปีงบประมาณ <?php echo $DataNowTh; ?></h5>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $DisplayYearAllRpBd; ?>">0</span> บาท</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card-body">
                        <table id="repairmanage" class="table table-bordered dt-responsive nowrap align-middle mdl-data-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th hidden>asx</th>
                                    <th>วันที่ส่งซ่อม</th>
                                    <th>วันที่กำหนดแล้วเสร็จ</th>
                                    <th>เลขทะเบียนครุภัณฑ์</th>
                                    <th>ชื่อครุภัณฑ์</th>
                                    <th>ผู้บันทึกข้อมูลการซ่อม</th>
                                    <th>สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ProcessRepair as $key_pc => $value_pc) { ?>
                                    <tr>
                                        <td hidden><?php echo $value_pc["AMS_REPAIR_SDATE"]; ?></td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepairReportModal" data-bs-id="<?php echo $value_pc["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_pc["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pc["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_pc["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $ReportResult->dateToThai($value_pc['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $ReportResult->dateToThai($value_pc['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_pc["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_pc["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_pc["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_pc['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pc["AMS_REPAIR_FDATE"]; ?>" data-bs-unit="<?php echo $value_pc["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pc['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($value_pc["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value_pc["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pc["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pc["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pc["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pc["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pc["AMS_PRODUCTSET_NO"] . ' | ' . $value_pc["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pc["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pc['AMS_BUDGET_SOURCENM'] . ' ' . $value_pc['AMS_BUDGET_CLASSNM'] . ' ' . $value_pc['AMS_BUDGET_TYPENM']; ?>"  data-bs-pcntset="<?php echo $value_pc['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pc['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <?php echo $ReportResult->dateToThai($value_pc["AMS_REPAIR_DATE"]); ?>
                                        </td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepairReportModal" data-bs-id="<?php echo $value_pc["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_pc["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pc["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_pc["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $ReportResult->dateToThai($value_pc['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $ReportResult->dateToThai($value_pc['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_pc["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_pc["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_pc["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_pc['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pc["AMS_REPAIR_FDATE"]; ?>" data-bs-unit="<?php echo $value_pc["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pc['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($value_pc["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value_pc["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pc["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pc["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pc["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pc["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pc["AMS_PRODUCTSET_NO"] . ' | ' . $value_pc["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pc["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pc['AMS_BUDGET_SOURCENM'] . ' ' . $value_pc['AMS_BUDGET_CLASSNM'] . ' ' . $value_pc['AMS_BUDGET_TYPENM']; ?>"  data-bs-pcntset="<?php echo $value_pc['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pc['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <?php echo $ReportResult->dateToThai($value_pc["AMS_REPAIR_SDATE"]); ?>
                                        </td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepairReportModal" data-bs-id="<?php echo $value_pc["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_pc["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pc["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_pc["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $ReportResult->dateToThai($value_pc['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $ReportResult->dateToThai($value_pc['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_pc["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_pc["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_pc["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_pc['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pc["AMS_REPAIR_FDATE"]; ?>" data-bs-unit="<?php echo $value_pc["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pc['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($value_pc["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value_pc["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pc["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pc["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pc["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pc["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pc["AMS_PRODUCTSET_NO"] . ' | ' . $value_pc["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pc["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pc['AMS_BUDGET_SOURCENM'] . ' ' . $value_pc['AMS_BUDGET_CLASSNM'] . ' ' . $value_pc['AMS_BUDGET_TYPENM']; ?>"  data-bs-pcntset="<?php echo $value_pc['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pc['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <?php echo $value_pc["AMS_PRODUCT_NO"]; ?>
                                        </td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepairReportModal" data-bs-id="<?php echo $value_pc["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_pc["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pc["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_pc["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $ReportResult->dateToThai($value_pc['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $ReportResult->dateToThai($value_pc['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_pc["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_pc["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_pc["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_pc['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pc["AMS_REPAIR_FDATE"]; ?>" data-bs-unit="<?php echo $value_pc["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pc['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($value_pc["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value_pc["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pc["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pc["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pc["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pc["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pc["AMS_PRODUCTSET_NO"] . ' | ' . $value_pc["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pc["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pc['AMS_BUDGET_SOURCENM'] . ' ' . $value_pc['AMS_BUDGET_CLASSNM'] . ' ' . $value_pc['AMS_BUDGET_TYPENM']; ?>"  data-bs-pcntset="<?php echo $value_pc['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pc['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <?php echo $value_pc["AMS_PRODUCT_NM"]; ?>
                                        </td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepairReportModal" data-bs-id="<?php echo $value_pc["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_pc["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pc["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_pc["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $ReportResult->dateToThai($value_pc['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $ReportResult->dateToThai($value_pc['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_pc["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_pc["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_pc["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_pc['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pc["AMS_REPAIR_FDATE"]; ?>" data-bs-unit="<?php echo $value_pc["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pc['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($value_pc["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value_pc["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pc["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pc["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pc["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pc["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pc["AMS_PRODUCTSET_NO"] . ' | ' . $value_pc["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pc["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pc['AMS_BUDGET_SOURCENM'] . ' ' . $value_pc['AMS_BUDGET_CLASSNM'] . ' ' . $value_pc['AMS_BUDGET_TYPENM']; ?>"  data-bs-pcntset="<?php echo $value_pc['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pc['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <span class="badge badge-soft-info"><?php echo $value_pc['AMS_USER_FNAME'] . ' ' . $value_pc['AMS_USER_LNAME']; ?></span>
                                        </td>
                                        <td>
                                    <h5><span class="badge rounded-pill bg-<?php echo $value_pc['AMS_REPAIR_RST'] == '1' ? 'success' : 'warning'; ?> text-dark"><i class="mdi mdi-tag"></i> <?php echo $value_pc['AMS_REPAIR_RSTNM']; ?></h5></span>
                                    </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-wrench"></i> ค้นหารายงานการซ่อม </h4>
                    </div>
                    <div class="card-body">

                        <form class="form-horizontal" id="f_reprotrp" name="f_reprotrp" action="?Page=report-rp" method="post" autocomplete="off">
                            <div class="row gy-4">
                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="txtfdate" class="form-label text-dark"><b>วันที่ส่งซ่อม</b></label>
                                        <input type="text" class="form-control" name="txtfdate" id="txtfdate">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="txtldate" class="form-label text-dark"><b>ถึงวันที่</b></label>
                                        <input type="text" class="form-control" name="txtldate" id="txtldate">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-md-6">
                                    <!-- <div>
                                        <label for="txtsucessdate" class="form-label text-dark"><b>วันที่กำหนดแล้วเสร็จ</b></label>
                                        <input type="text" class="form-control" name="txtsucessdate" id="txtsucessdate">
                                    </div> -->
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
                                <div class="col-xxl-2 col-md-6">
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
                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="txtfsave" class="form-label text-dark"><b>ผู้บันทึกข้อมูลการซ่อม</b></label>
                                        <select class="form-select js-example-basic-single" id="txtfsave" name="txtfsave">
                                            <option value="">ทั้งหมด</option>
                                            <?php foreach ($UsersaveRepair as $key_us => $value_us) { ?>
                                                <option value="<?php echo $value_us['AMS_USER_ID']; ?>"><?php echo $value_us['AMS_USER_FNAME'] . ' ' . $value_us['AMS_USER_LNAME']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <!--end col-->
                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="textstrp" class="form-label text-dark"><b>สถานะการส่งซ่อม</b></label>
                                        <select class="form-select" id="textstrp" name="textstrp">
                                            <option value="">ทั้งหมด</option>
                                            <option value="0">อยู่ระหว่างการซ่อม</option>
                                            <option value="1">ซ่อมแล้ว</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                            <br>
                            <div class="border-top">
                                <div class="card-body text-right">
                                    <input type="hidden" value="focus" name="chkfocus">
                                    <button type="submit" id="sreport" class="btn btn-info2 text-light"><i class="mdi mdi-database-search"></i> ค้นหา</button>
                                    <button type="button" class="btn btn-warning2 text-light" onClick="window.location.href = '?Page=report-rp'"><i class="mdi mdi-backup-restore"></i> Reset</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- result -->
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <h4 class="card-title mb-0 flex-grow-1">
                                <i class="mdi mdi-format-list-checks"></i>
                                รายละเอียด
                                <?php echo $rpfdate != "" ? "วันที่ส่งซ่อม: <span class='badge bg-light text-dark'>" . $ReportResult->dateToThai($rpfdate) . "</span>" : ""; ?>
                                <?php echo $rpldate != "" ? "ถึงวันที่: <span class='badge bg-light text-dark'>" . $ReportResult->dateToThai($rpldate) . "</span>" : ""; ?>
                                <?php echo $rpaped != "" ? "ประเภทครุภัณฑ์: <span class='badge bg-light text-dark'>" . $ReportResult->DisplayHeader($rpaped, 1) . "</span>" : ""; ?>
                                <?php echo $rpedcob != "" ? "หน่วยงานที่รับผิดชอบ: <span class='badge bg-light text-dark'>" . $ReportResult->DisplayHeader($rpedcob, 2) . "</span>" : ""; ?>
                                <?php echo $rpfsave != "" ? "ผู้บันทึกข้อมูลการซ่อม: <span class='badge bg-light text-dark'>" . $ReportResult->DisplayHeader($rpfsave, 3) . "</span>" : ""; ?>
                                <?php if ($rpst == '0') {
                                    $disrpst = "อยู่ระหว่างการซ่อม";
                                } elseif ($rpst == '1') {
                                    $disrpst = "ซ่อมแล้ว";
                                } else {
                                    $disrpst = "";
                                } ?>
                                <?php echo $rpst != "" ? "สถานะการส่งซ่อม: <span class='badge bg-light text-dark'>" . $disrpst . "</span>" : ""; ?>
                            </h4>
                        </div>
                       
                        <div class="mt-3">
                            <button class="btn btn-sm btn-success2" onclick="window.open('./pages/reports/excel/Ex_repair.php?r1=<?php echo $rpfdate; ?>&r2=<?php echo $rpldate; ?>&r3=<?php echo $rppcdno; ?>&r4=<?php echo $rppcdnm; ?>&r5=<?php echo $rpsdate; ?>&r6=<?php echo $rpcpn; ?>&r7=<?php echo $rpfsave; ?>&r8=<?php echo $rpst; ?>&r9=<?php echo $rpdst; ?>&r10=<?php echo $rpaped; ?>&r11=<?php echo $rpedcob; ?>','pwin')"><i class="mdi mdi-file-excel"></i> รายงานรูปแบบ Excel</button>
                            <button class="btn btn-sm btn-danger2" onclick="window.open('./pages/reports/pdf/Pdf_repair.php?r1=<?php echo $rpfdate; ?>&r2=<?php echo $rpldate; ?>&r3=<?php echo $rppcdno; ?>&r4=<?php echo $rppcdnm; ?>&r5=<?php echo $rpsdate; ?>&r6=<?php echo $rpcpn; ?>&r7=<?php echo $rpfsave; ?>&r8=<?php echo $rpst; ?>&r9=<?php echo $rpdst; ?>&r10=<?php echo $rpaped; ?>&r11=<?php echo $rpedcob; ?>','pwin')"><i class="mdi mdi-file-pdf-box"></i> รายงานรูปแบบ PDF</button>
                        </div>

                        <div class="mt-3"></div>
                        <table id="repairmanageallreport" class="table table-bordered dt-responsive  table-striped align-middle text-wrap table-hover" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th hidden></th>
                                    <!-- <th>รหัสส่งซ่อม</th> -->
                                    <th>วันที่ส่งซ่อม</th>
                                    <th>วันที่กำหนดแล้วเสร็จ</th>
                                    <th>เลขทะเบียนครุภัณฑ์</th>
                                    <th>ชื่อครุภัณฑ์</th>
                                    <th>ผู้บันทึกข้อมูลการซ่อม</th>
                                    <th>สถานะการส่งซ่อม</th>
                                    <!-- <th>สถานะข้อมูล</th> -->
                                    <th hidden>อาการเสีย</th>
                                    <th hidden>ค่าใช้จ่ายในการซ่อม</th>
                                    <th hidden>บริษัทที่ส่งซ่อม</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($TabAllRP as $key_allrp => $value_allrp) { ?>
                                    <tr class="text-center">
                                        <td hidden><?php echo $value_allrp['AMS_REPAIR_DATE']; ?></td>
                                        <!-- <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepairReportModal" data-bs-id="<?php echo $value_allrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_allrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_allrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_allrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $ReportResult->dateToThai($value_allrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $ReportResult->dateToThai($value_allrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_allrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_allrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_allrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_allrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'ไม่ใช้งาน'; ?>" data-bs-pfdate="<?php echo $value_allrp["AMS_REPAIR_FDATE"]; ?>">
                                            <?php echo $value_allrp['AMS_REPAIR_ID']; ?>
                                        </td> -->
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepairReportModal" data-bs-id="<?php echo $value_allrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_allrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_allrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_allrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $ReportResult->dateToThai($value_allrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $ReportResult->dateToThai($value_allrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_allrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_allrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_allrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_allrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'ไม่ใช้งาน'; ?>" data-bs-pfdate="<?php echo $value_allrp["AMS_REPAIR_FDATE"]; ?>" data-bs-unit="<?php echo $value_allrp["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_allrp['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($value_allrp["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value_allrp["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_allrp["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_allrp["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_allrp["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_allrp["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_allrp["AMS_PRODUCTSET_NO"] . ' | ' . $value_allrp["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_allrp["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_allrp['AMS_BUDGET_SOURCENM'] . ' ' . $value_allrp['AMS_BUDGET_CLASSNM'] . ' ' . $value_allrp['AMS_BUDGET_TYPENM']; ?>" data-bs-pcntset="<?php echo $value_allrp['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_allrp['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <?php echo $ReportResult->dateToThai($value_allrp['AMS_REPAIR_DATE']); ?>
                                        </td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepairReportModal" data-bs-id="<?php echo $value_allrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_allrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_allrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_allrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $ReportResult->dateToThai($value_allrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $ReportResult->dateToThai($value_allrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_allrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_allrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_allrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_allrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'ไม่ใช้งาน'; ?>" data-bs-pfdate="<?php echo $value_allrp["AMS_REPAIR_FDATE"]; ?>" data-bs-unit="<?php echo $value_allrp["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_allrp['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($value_allrp["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value_allrp["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_allrp["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_allrp["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_allrp["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_allrp["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_allrp["AMS_PRODUCTSET_NO"] . ' | ' . $value_allrp["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_allrp["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_allrp['AMS_BUDGET_SOURCENM'] . ' ' . $value_allrp['AMS_BUDGET_CLASSNM'] . ' ' . $value_allrp['AMS_BUDGET_TYPENM']; ?>" data-bs-pcntset="<?php echo $value_allrp['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_allrp['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <?php echo $ReportResult->dateToThai($value_allrp['AMS_REPAIR_SDATE']); ?>
                                        </td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepairReportModal" data-bs-id="<?php echo $value_allrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_allrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_allrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_allrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $ReportResult->dateToThai($value_allrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $ReportResult->dateToThai($value_allrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_allrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_allrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_allrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_allrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'ไม่ใช้งาน'; ?>" data-bs-pfdate="<?php echo $value_allrp["AMS_REPAIR_FDATE"]; ?>" data-bs-unit="<?php echo $value_allrp["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_allrp['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($value_allrp["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value_allrp["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_allrp["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_allrp["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_allrp["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_allrp["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_allrp["AMS_PRODUCTSET_NO"] . ' | ' . $value_allrp["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_allrp["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_allrp['AMS_BUDGET_SOURCENM'] . ' ' . $value_allrp['AMS_BUDGET_CLASSNM'] . ' ' . $value_allrp['AMS_BUDGET_TYPENM']; ?>" data-bs-pcntset="<?php echo $value_allrp['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_allrp['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <?php echo $value_allrp['AMS_PRODUCT_NO']; ?>
                                        </td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepairReportModal" data-bs-id="<?php echo $value_allrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_allrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_allrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_allrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $ReportResult->dateToThai($value_allrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $ReportResult->dateToThai($value_allrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_allrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_allrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_allrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_allrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'ไม่ใช้งาน'; ?>" data-bs-pfdate="<?php echo $value_allrp["AMS_REPAIR_FDATE"]; ?>" data-bs-unit="<?php echo $value_allrp["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_allrp['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($value_allrp["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value_allrp["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_allrp["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_allrp["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_allrp["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_allrp["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_allrp["AMS_PRODUCTSET_NO"] . ' | ' . $value_allrp["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_allrp["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_allrp['AMS_BUDGET_SOURCENM'] . ' ' . $value_allrp['AMS_BUDGET_CLASSNM'] . ' ' . $value_allrp['AMS_BUDGET_TYPENM']; ?>" data-bs-pcntset="<?php echo $value_allrp['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_allrp['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <?php echo $value_allrp['AMS_PRODUCT_NM']; ?>
                                        </td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepairReportModal" data-bs-id="<?php echo $value_allrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_allrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_allrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_allrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $ReportResult->dateToThai($value_allrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $ReportResult->dateToThai($value_allrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_allrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_allrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_allrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_allrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'ไม่ใช้งาน'; ?>" data-bs-pfdate="<?php echo $value_allrp["AMS_REPAIR_FDATE"]; ?>" data-bs-unit="<?php echo $value_allrp["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_allrp['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($value_allrp["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value_allrp["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_allrp["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_allrp["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_allrp["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_allrp["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_allrp["AMS_PRODUCTSET_NO"] . ' | ' . $value_allrp["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_allrp["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_allrp['AMS_BUDGET_SOURCENM'] . ' ' . $value_allrp['AMS_BUDGET_CLASSNM'] . ' ' . $value_allrp['AMS_BUDGET_TYPENM']; ?>" data-bs-pcntset="<?php echo $value_allrp['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_allrp['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <?php echo $value_allrp['AMS_USER_FNAME'] . ' ' . $value_allrp['AMS_USER_LNAME']; ?>
                                        </td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepairReportModal" data-bs-id="<?php echo $value_allrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_allrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_allrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_allrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $ReportResult->dateToThai($value_allrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $ReportResult->dateToThai($value_allrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_allrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_allrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_allrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_allrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'ไม่ใช้งาน'; ?>" data-bs-pfdate="<?php echo $value_allrp["AMS_REPAIR_FDATE"]; ?>" data-bs-unit="<?php echo $value_allrp["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_allrp['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($value_allrp["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value_allrp["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_allrp["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_allrp["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_allrp["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_allrp["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_allrp["AMS_PRODUCTSET_NO"] . ' | ' . $value_allrp["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_allrp["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_allrp['AMS_BUDGET_SOURCENM'] . ' ' . $value_allrp['AMS_BUDGET_CLASSNM'] . ' ' . $value_allrp['AMS_BUDGET_TYPENM']; ?>" data-bs-pcntset="<?php echo $value_allrp['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_allrp['AMS_PRODUCTSET_PRICE'], 2); ?>">

                                            <h5><span class="badge rounded-pill bg-<?php echo $value_allrp['AMS_REPAIR_RST'] == '1' ? 'success' : 'warning'; ?> text-dark"><i class="mdi mdi-tag"></i> <?php echo $value_allrp['AMS_REPAIR_RSTNM']; ?></h5></span>
                                        </td>
                                        <!-- <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepairReportModal" data-bs-id="<?php echo $value_allrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_allrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_allrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_allrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $ReportResult->dateToThai($value_allrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $ReportResult->dateToThai($value_allrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_allrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_allrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_allrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_allrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'ไม่ใช้งาน'; ?>" data-bs-pfdate="<?php echo $value_allrp["AMS_REPAIR_FDATE"]; ?>">
                                                                    <h5><span class="badge rounded-pill bg-<?php echo $value_allrp['AMS_REPAIR_ST'] == '10' ? 'info' : 'danger'; ?> text-dark"><i class="mdi mdi-tag"></i> <?php echo $value_allrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'ไม่ใช้งาน'; ?></h5></span>
                                                                </td> -->
                                        <td hidden><?php echo $value_allrp['AMS_REPAIR_CAUSE']; ?></td>
                                        <td hidden><?php echo number_format($value_allrp['AMS_REPAIR_EXPEN'], 2); ?></td>
                                        <td hidden><?php echo $value_allrp['AMS_REPAIR_CPN']; ?></td>

                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- //result -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="RepairReportModal" tabindex="-1" aria-labelledby="RepairReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="RepairReportModalLabel">รายละเอียดข้อมูล</h5>
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
                        <div class="col-md-12  rpcase">
                            <label for="txtcasemodal" class="col-form-label"><b>อาการเสีย:</b></label>
                            <textarea class="form-control" id="txtcasemodal" disabled="disabled"></textarea>
                        </div>
                        <div class="col-md-4  rpdate">
                            <label for="txtrpdatemodal" class="col-form-label"><b>วันที่ส่งซ่อม:</b></label>
                            <input type="text" class="form-control" id="txtrpdatemodal" disabled="disabled">
                        </div>
                        <div class="col-md-4  rpdates">
                            <label for="txtrpdatesmodal" class="col-form-label"><b>วันที่กำหนดแล้วเสร็จ:</b></label>
                            <input type="text" class="form-control" id="txtrpdatesmodal" disabled="disabled">
                        </div>
                        <div class="col-md-4  rpprice">
                            <label for="txtrppricemodal" class="col-form-label"><b>ค่าใช้จ่ายในการซ่อม:</b></label>
                            <input type="text" class="form-control" id="txtrppricemodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  rpcom">
                            <label for="txtcompamnymodal" class="col-form-label"><b>บริษัทที่ส่งซ่อม:</b></label>
                            <input type="text" class="form-control" id="txtcompamnymodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  rpstatus">
                            <label for="txtstatusmodal" class="col-form-label"><b>สถานะรายการซ่อม:</b></label>
                            <input type="text" class="form-control" id="txtstatusmodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  pdatast">
                            <label for="txtpdatastmodal" class="col-form-label"><b>สถานะของข้อมูล:</b></label>
                            <input type="text" class="form-control" id="txtpdatastmodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  pfdate">
                            <label for="txtpfdatemodal" class="col-form-label"><b>วันที่บันทึก:</b></label>
                            <input type="text" class="form-control" id="txtpfdatemodal" disabled="disabled">
                        </div>
                        <div class="col-md-12">
                            <hr />
                        </div>
                        <div class="col-md-12"><b>ข้อมูลครุภัณฑ์</b></div>
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
                        <div class="col-md-4 pyear">
                            <label for="txtpyearmodal" class="col-form-label"><b>ปีงบประมาณ:</b></label>
                            <input type="text" class="form-control" id="txtpyearmodal" disabled="disabled">
                        </div>
                        <div class="col-md-8  psource">
                            <label for="txtpsourcemodal" class="col-form-label"><b>ที่มางบประมาณ:</b></label>
                            <input type="text" class="form-control" id="txtpsourcemodal" disabled="disabled">
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