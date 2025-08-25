<?php
include 'dashboard_funtion.php';
$DashboradResult = new DashboradResult();
// d1
$PDC10Display = $DashboradResult->CountPDCToDisplay(10);
$PDC20Display = $DashboradResult->CountPDCToDisplay(20);
$PDC30Display = $DashboradResult->CountPDCToDisplay(30);
$PDC40Display = $DashboradResult->CountPDCToDisplay(40);
$CNT10Display = isset($PDC10Display['0']['CNTPDC']) ? $PDC10Display['0']['CNTPDC'] : '0';
$CNT20Display = isset($PDC20Display['0']['CNTPDC']) ? $PDC20Display['0']['CNTPDC'] : '0';
$CNT30Display = isset($PDC30Display['0']['CNTPDC']) ? $PDC30Display['0']['CNTPDC'] : '0';
$CNT40Display = isset($PDC40Display['0']['CNTPDC']) ? $PDC40Display['0']['CNTPDC'] : '0';
// d1
// d2
$ProdcutLCT = $DashboradResult->LCTToPDashboard();
// d2
// d3
$AtcLCT = $DashboradResult->LCTToPDashboardATC();
// d3
// d4
$ProcessRepair = $DashboradResult->ReportRepairProcessing($db);
// d4
// d5
$Top10Repair = $DashboradResult->Top10RepairDashboard();
// d5
// d6
$Top10Product = $DashboradResult->Top10ProductOld();
// d6
$yearAll = $DashboradResult->YearBudgets();
?>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-view-dashboard"></i> Dashboards </h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-md-12">
                <!-- Dashbords1 -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-monitor"></i> ครุภัณฑ์ทั้งหมด</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h4 class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                    <span class="badge bg-light text-dark">ครุภัณฑ์ปกติ</span>
                                                </h4>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <!-- <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                            +16.24 %
                                        </h5> -->
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?php echo $CNT10Display; ?>">0</span> รายการ</h4>
                                                <form class="form-horizontal" id="f_productsrdas" name="f_productsrdas" action="?Page=product-manage" method="post" autocomplete="off">
                                                    <input type="hidden" name="txtprdst" value="10">
                                                    <button type="submit" class="btn btn-sm btn-light text-dark">ดูข้อมูล</button>
                                                </form>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-success rounded fs-3">
                                                    <i class="mdi mdi-printer"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h4 class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                    <span class="badge bg-light text-dark">อยู่ระหว่างการซ่อม</span>
                                                </h4>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <!-- <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                            -3.57 %
                                        </h5> -->
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?php echo $CNT20Display; ?>">0</span> รายการ</h4>
                                                <form class="form-horizontal" id="f_productsrdas" name="f_productsrdas" action="?Page=product-manage" method="post" autocomplete="off">
                                                    <input type="hidden" name="txtprdst" value="20">
                                                    <button type="submit" class="btn btn-sm btn-light text-dark">ดูข้อมูล</button>
                                                </form>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-info rounded fs-3">
                                                    <i class="mdi mdi-alert"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h4 class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                    <span class="badge bg-light text-dark">รอแทงจำหน่าย</span>
                                                </h4>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <!-- <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                            +29.08 %
                                        </h5> -->
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?php echo $CNT30Display; ?>">0</span> รายการ</h4>
                                                <form class="form-horizontal" id="f_productsrdas" name="f_productsrdas" action="?Page=product-manage" method="post" autocomplete="off">
                                                    <input type="hidden" name="txtprdst" value="30">
                                                    <button type="submit" class="btn btn-sm btn-light text-dark">ดูข้อมูล</button>
                                                </form>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-warning rounded fs-3">
                                                    <i class="mdi mdi-timelapse"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h4 class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                    <span class="badge bg-light text-dark">แทงจำหน่าย/ตัดออกจากบัญชี</span>
                                                </h4>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <!-- <h5 class="text-muted fs-14 mb-0">
                                            +0.00 %
                                        </h5> -->
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?php echo $CNT40Display; ?>">0</span> รายการ</h4>
                                                <form class="form-horizontal" id="f_productsrdas" name="f_productsrdas" action="?Page=product-manage" method="post" autocomplete="off">
                                                    <input type="hidden" name="txtprdst" value="40">
                                                    <button type="submit" class="btn btn-sm btn-light text-dark">ดูข้อมูล</button>
                                                </form>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-danger rounded fs-3">
                                                    <i class="mdi mdi-stop-circle"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div> <!-- end row-->

                    </div>
                </div>
            </div>
            <!-- Dashbords1 -->
            <!-- Dashbords2 -->
            <div class="col-xl-6 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-clock-start"></i> จำนวนครุภัณฑ์ปัจจุบัน / รายการ</h4>
                    </div>
                    <div class="card-body">
                        <div class="px-2 py-2 mt-1">

                            <?php foreach ($ProdcutLCT as $value_lctdas) { ?>

                                <p class="mb-1"><?php echo $value_lctdas['AMS_LCT_NM']; ?> <span class="float-end"><?php echo $value_lctdas['CNTLCT']; ?></span></p>
                                <div class="progress bg-soft-primary mt-2" style="height: 6px;">
                                    <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: <?php echo $value_lctdas['CNTLCT']; ?>%" aria-valuenow="<?php echo $value_lctdas['CNTLCT']; ?>" aria-valuemin="0" aria-valuemax="<?php echo $value_lctdas['CNTLCT']; ?>">
                                    </div>
                                </div>

                            <?php } ?>

                        </div>

                    </div>
                </div>
            </div>
            <!-- Dashbords2 -->

            <!-- Dashbords3 -->
            <div class="col-xl-6 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-clock-start"></i> วัสดุปัจจุบัน / รายการ</h4>
                    </div>
                    <div class="card-body">
                        <div class="px-2 py-2 mt-1">
                            <?php foreach ($AtcLCT as $value_lctatc) { ?>
                                <p class="mb-1"><?php echo $value_lctatc["AMS_LCT_NM"]; ?> <span class="float-end"><?php echo $value_lctatc["CNTATC"]; ?></span></p>
                                <div class="progress bg-soft-success mt-2" style="height: 6px;">
                                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo $value_lctatc["CNTATC"]; ?>%" aria-valuenow="<?php echo $value_lctatc["CNTATC"]; ?>" aria-valuemin="0" aria-valuemax="<?php echo $value_lctatc["CNTATC"]; ?>">
                                    </div>
                                </div>
                            <?php } ?>

                        </div>

                    </div>
                </div>
            </div>
            <!-- Dashbords3 -->
            <!-- Dashbords4 -->
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-timer"></i> รายการอยู่ระหว่างการซ่อม</h4>
                    </div>
                    <div class="card-body">
                        <table id="repairdashboard" class="table table-bordered dt-responsive nowrap align-middle mdl-data-table" style="width:100%">
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
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepairReportModal" data-bs-id="<?php echo $value_pc["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_pc["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pc["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_pc["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $DashboradResult->dateToThai($value_pc['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $DashboradResult->dateToThai($value_pc['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_pc["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_pc["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_pc["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_pc['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pc["AMS_REPAIR_FDATE"]; ?>" data-bs-unit="<?php echo $value_pc["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pc['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $DashboradResult->dateToThai($value_pc["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $DashboradResult->dateToThai($value_pc["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pc["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pc["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pc["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pc["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pc["AMS_PRODUCTSET_NO"] . ' | ' . $value_pc["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pc["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pc['AMS_BUDGET_SOURCENM'] . ' ' . $value_pc['AMS_BUDGET_CLASSNM'] . ' ' . $value_pc['AMS_BUDGET_TYPENM']; ?>" data-bs-pcntset="<?php echo $value_pc['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pc['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <?php echo $DashboradResult->dateToThai($value_pc["AMS_REPAIR_DATE"]); ?>
                                        </td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepairReportModal" data-bs-id="<?php echo $value_pc["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_pc["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pc["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_pc["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $DashboradResult->dateToThai($value_pc['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $DashboradResult->dateToThai($value_pc['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_pc["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_pc["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_pc["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_pc['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pc["AMS_REPAIR_FDATE"]; ?>" data-bs-unit="<?php echo $value_pc["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pc['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $DashboradResult->dateToThai($value_pc["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $DashboradResult->dateToThai($value_pc["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pc["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pc["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pc["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pc["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pc["AMS_PRODUCTSET_NO"] . ' | ' . $value_pc["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pc["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pc['AMS_BUDGET_SOURCENM'] . ' ' . $value_pc['AMS_BUDGET_CLASSNM'] . ' ' . $value_pc['AMS_BUDGET_TYPENM']; ?>" data-bs-pcntset="<?php echo $value_pc['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pc['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <?php echo $DashboradResult->dateToThai($value_pc["AMS_REPAIR_SDATE"]); ?>
                                        </td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepairReportModal" data-bs-id="<?php echo $value_pc["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_pc["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pc["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_pc["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $DashboradResult->dateToThai($value_pc['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $DashboradResult->dateToThai($value_pc['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_pc["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_pc["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_pc["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_pc['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pc["AMS_REPAIR_FDATE"]; ?>" data-bs-unit="<?php echo $value_pc["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pc['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $DashboradResult->dateToThai($value_pc["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $DashboradResult->dateToThai($value_pc["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pc["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pc["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pc["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pc["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pc["AMS_PRODUCTSET_NO"] . ' | ' . $value_pc["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pc["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pc['AMS_BUDGET_SOURCENM'] . ' ' . $value_pc['AMS_BUDGET_CLASSNM'] . ' ' . $value_pc['AMS_BUDGET_TYPENM']; ?>" data-bs-pcntset="<?php echo $value_pc['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pc['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <?php echo $value_pc["AMS_PRODUCT_NO"]; ?>
                                        </td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepairReportModal" data-bs-id="<?php echo $value_pc["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_pc["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pc["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_pc["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $DashboradResult->dateToThai($value_pc['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $DashboradResult->dateToThai($value_pc['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_pc["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_pc["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_pc["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_pc['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pc["AMS_REPAIR_FDATE"]; ?>" data-bs-unit="<?php echo $value_pc["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pc['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $DashboradResult->dateToThai($value_pc["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $DashboradResult->dateToThai($value_pc["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pc["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pc["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pc["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pc["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pc["AMS_PRODUCTSET_NO"] . ' | ' . $value_pc["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pc["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pc['AMS_BUDGET_SOURCENM'] . ' ' . $value_pc['AMS_BUDGET_CLASSNM'] . ' ' . $value_pc['AMS_BUDGET_TYPENM']; ?>" data-bs-pcntset="<?php echo $value_pc['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pc['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <?php echo $value_pc["AMS_PRODUCT_NM"]; ?>
                                        </td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepairReportModal" data-bs-id="<?php echo $value_pc["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_pc["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_pc["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_pc["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $DashboradResult->dateToThai($value_pc['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $DashboradResult->dateToThai($value_pc['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_pc["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_pc["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_pc["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_pc['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_pc["AMS_REPAIR_FDATE"]; ?>" data-bs-unit="<?php echo $value_pc["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_pc['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $DashboradResult->dateToThai($value_pc["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $DashboradResult->dateToThai($value_pc["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_pc["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_pc["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_pc["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_pc["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_pc["AMS_PRODUCTSET_NO"] . ' | ' . $value_pc["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_pc["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_pc['AMS_BUDGET_SOURCENM'] . ' ' . $value_pc['AMS_BUDGET_CLASSNM'] . ' ' . $value_pc['AMS_BUDGET_TYPENM']; ?>" data-bs-pcntset="<?php echo $value_pc['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_pc['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                            <span class="badge badge-soft-info"><?php echo $value_pc['AMS_USER_FNAME'] . ' ' . $value_pc['AMS_USER_LNAME']; ?></span>
                                        </td>
                                        <td>
                                            <h5><span class="badge rounded-pill bg-<?php echo $value_pc['AMS_REPAIR_RST'] == '1' ? 'success' : 'warning'; ?> text-dark"><i class="mdi mdi-tag"></i> <?php echo $value_pc['AMS_REPAIR_RSTNM']; ?></h5></span>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Dashbords4 -->
            <!-- Dashbords5 -->
            <div class="col-xl-6 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-wrench"></i> จัดอันดับการซ่อมครุภัณฑ์</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table align-middle table-borderless table-centered table-wrap mb-0">
                                <thead class="text-muted table-light">
                                    <tr>
                                        <th scope="col" style="width: 62;">ชื่อครุภัณฑ์</th>
                                        <th scope="col">การส่งซ่อม/ครั้ง</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Top10Repair as $key_10 => $value_R10) { ?>
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0);" class="btn-blockdas" data-bs-toggle="modal" data-bs-target="#RepairHistoryModal" data-bs-idbd="<?php echo $value_R10['AMS_PRODUCT_ID']; ?>">
                                                    <?php echo $value_R10["AMS_PRODUCT_NM"]; ?>
                                                </a>
                                            </td>
                                            <td>
                                                <h5><span class="badge bg-light text-dark"><?php echo $value_R10["CNTTOP10"]; ?></span></h5>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <!-- end tbody -->
                            </table>
                            <!-- end table -->
                        </div>
                        <!-- end -->
                    </div>
                </div>
            </div>
            <!-- Dashbords5 -->
            <!-- Dashbords6 -->
            <div class="col-xl-6 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-calendar-clock"></i> จัดอันดับอายุการใช้งานครุภัณฑ์</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table align-middle table-borderless table-centered table-wrap mb-0">
                                <thead class="text-muted table-light">
                                    <tr>
                                        <th scope="col" style="width: 62;">ชื่อครุภัณฑ์</th>
                                        <th scope="col">อายุ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Top10Product as $key_p10 => $value_p10) { ?>
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0);" class="cursor-pointer subset" data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $value_p10["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $value_p10["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_p10["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $value_p10["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($value_p10['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $DashboradResult->dateToThai($value_p10["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $DashboradResult->dateToThai($value_p10["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $value_p10["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $value_p10["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $value_p10["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $value_p10["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $value_p10["AMS_PRODUCTSET_NO"] . ' | ' . $value_p10["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $value_p10["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $value_p10['AMS_BUDGET_SOURCENM'] . ' ' . $value_p10['AMS_BUDGET_CLASSNM'] . ' ' . $value_p10['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $value_p10['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_p10["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $value_p10['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($value_p10['AMS_PRODUCTSET_PRICE'], 2); ?>">
                                                    <?php echo $value_p10['AMS_PRODUCT_NM']; ?>
                                                </a>
                                            </td>
                                            <td>
                                                <h5><span class="badge bg-light text-dark"><?php echo $DashboradResult->AgeProduct($value_p10['AMS_PRODUCT_SDATE']); ?></span></h5>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <!-- end -->
                                </tbody>
                                <!-- end tbody -->
                            </table>
                            <!-- end table -->
                        </div>
                        <!-- end -->
                    </div>
                </div>

            </div>
            <!-- Dashbords6 -->

            <!-- Dashbords7 -->
            <?php
            $txtyear = isset($_POST['txtyear']) ? $_POST['txtyear'] : date('Y');
            $acyear = isset($_POST['acyear']) ? $_POST['acyear'] : "";
            ?>
            <div class="col-xl-12 col-md-12">
                <div class="card card-height-100">
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-bank"></i> งบประมาณประจำปี </h4>
                        <div>
                            <div class="dropdown">
                                <form class="form-horizontal" id="f_year" name="f_year" action="" method="post" autocomplete="off">
                                    <input type="hidden" name="acyear" value="1">
                                    <select name="txtyear" id="txtyear" class="form-control" <?php if ($acyear != "") {
                                                                                                    echo "autofocus";
                                                                                                } else {
                                                                                                } ?> onchange='if(this.value != 0) { this.form.submit(); }'>
                                        <?php foreach ($yearAll as $value_year) { ?>
                                            <option value="<?php echo $value_year["BGYEAR"]; ?>" <?php if ($txtyear == $value_year["BGYEAR"]) {
                                                                                                        echo "selected";
                                                                                                    } else {
                                                                                                    } ?>><?php echo $value_year["BGYEAR"] + 543; ?></option>
                                        <?php } ?>
                                    </select>
                                </form>
                                <!-- <button class="btn btn-soft-primary btn-sm shadow-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-uppercase">Btc<i class="mdi mdi-chevron-down align-middle ms-1"></i></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">BTC</a>
                                    <a class="dropdown-item" href="#">USD</a>
                                    <a class="dropdown-item" href="#">Euro</a>
                                </div> -->
                            </div>
                        </div>
                    </div><!-- end cardheader -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-md-12">
                                <div id="portfolio_donut_charts2" data-colors='["--vz-primary", "--vz-info", "--vz-warning", "--vz-success","--vz-danger", "--vz-secondary", "--vz-pink", "--vz-gray"]' class="apex-charts" dir="ltr"></div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <?php
                                $allBudgetYear = $DashboradResult->EditResultBudget($txtyear);

                                ?>
                                <ul class="list-group list-group-flush border-dashed mb-0 mt-3 pt-2">
                                    <?php
                                    foreach ($allBudgetYear as  $value_bd) {
                                        // echo $value_bd["AMS_BUDGET_AMOUNT"].',';
                                        // echo '"'.$value_bd["AMS_BUDGET_SOURCENM"] . ' ' . $value_bd["AMS_BUDGET_CLASSNM"].' '.$value_bd["AMS_BUDGET_TYPENM"].'",';
                                        $AmountAll =  $value_bd["AMS_BUDGET_AMOUNT"];
                                        $productSumAll = $DashboradResult->SumPriceAllBudget($value_bd["AMS_BUDGET_ID"], 1);
                                        foreach ($productSumAll as $value_sum1) {
                                            $arraysumpdc[$value_bd["AMS_BUDGET_ID"]] = $value_sum1["SUMPRICEPRODUCT"];
                                        }
                                        $atcSumAll = $DashboradResult->SumPriceAllBudget($value_bd["AMS_BUDGET_ID"], 2);
                                        foreach ($atcSumAll as $value_sum2) {
                                            $arraysumatc[$value_bd["AMS_BUDGET_ID"]] = $value_sum2["SUMPRICEATC"];
                                        }

                                        $BalanceAll[$value_bd["AMS_BUDGET_ID"]] = $arraysumpdc[$value_bd["AMS_BUDGET_ID"]] + $arraysumatc[$value_bd["AMS_BUDGET_ID"]];
                                        $BalanceDisplay = $AmountAll - $BalanceAll[$value_bd["AMS_BUDGET_ID"]];
                                    ?>
                                        <li class="list-group-item px-0">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 avatar-xs">
                                                    <span class="avatar-title bg-light p-1 rounded-circle shadow">
                                                        <img src="assets/images/bills.png" class="img-fluid" alt="">
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-2">
                                                    <h6 class="mb-1"><?php echo $value_bd["AMS_BUDGET_SOURCENM"] . ' ' . $value_bd["AMS_BUDGET_CLASSNM"]; ?></h6>
                                                    <p class="fs-12 mb-0 text-muted"><i class="mdi mdi-circle fs-10 align-middle text-primary me-1"></i><?php echo $value_bd["AMS_BUDGET_TYPENM"]; ?>
                                                    </p>
                                                </div>
                                                <div class="flex-shrink-0 text-end">
                                                    <h6 class="mb-1"><?php echo number_format($AmountAll, 2); ?></h6>
                                                    <p class="text-success fs-12 mb-0">คงเหลือ <?php echo number_format($BalanceDisplay, 2); ?></p>
                                                </div>
                                            </div>
                                        </li><!-- end -->
                                    <?php } ?>
                                </ul><!-- end -->

                            </div>
                        </div>

                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <!-- Dashbords7 -->

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
                        <div class="  rpcase">
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
                        <div class="">
                            <hr />
                        </div>
                        <div class=""><b>ข้อมูลครุภัณฑ์</b></div>
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


<div class="modal fade zoomIn" id="RepairHistoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="RepairHistoryModalLabel">รายละเอียดข้อมูล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <div class="modal-body">
                <div class="rphis">

                </div>
                <!-- <form action="" method="POST">
                    <div class="idpro"><input type="hidden" name="txtidpro" class="form-control"></div>
                </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">ปิด</button>
                <!-- <button type="button" class="btn btn-primary">Send message</button> -->
            </div>
        </div>
    </div>
</div>