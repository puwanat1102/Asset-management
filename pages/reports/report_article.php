<?php
$_SESSION['chkDup'] = '0';
include 'report_funtion.php';
$ReportResult = new ReportResult();
$YearbudgetAll = $ReportResult->YearBudgets($db);
$Atcname = '';
$Atctype = isset($_POST['txttypeatc']) ? $_POST['txttypeatc'] : '';
$Atcyear = isset($_POST['txtyearatc']) ? $_POST['txtyearatc'] : '';
$Atcsource = isset($_POST['txtsourceatc']) ? $_POST['txtsourceatc'] : '';
$Atcfdate = '';
$Atcldate = '';
$Atcstatus = isset($_POST['txtexpdate']) ? $_POST['txtexpdate'] : '';
$ActionDisplay = isset($_POST['ActionDisplay']) ? $_POST['ActionDisplay'] : 'Nodata';
$rpedcob = isset($_POST['txtlctpdc']) ? $_POST['txtlctpdc'] : '';

$AllArticel = $ReportResult->ArticleList($Atcname, $Atctype, $Atcyear, $Atcsource, $Atcfdate, $rpedcob, $Atcstatus, $db);
$AllArticelDis = $ReportResult->ArticleListDisplayToKH($Atcname, $Atctype, $Atcyear, $Atcsource, $Atcfdate, $rpedcob, $Atcstatus);
$ACTDisplay = $ReportResult->CountATCToDisplay(100);
$ACTDisplay10 = $ReportResult->CountATCToDisplay(10);
$ACTDisplay20 = $ReportResult->CountATCToDisplay(20);
$CNTDisplayAll = isset($ACTDisplay['0']['CNTATC']) ? $ACTDisplay['0']['CNTATC'] : '0';
$CNTDisplay10 = isset($ACTDisplay10['0']['CNTATC']) ? $ACTDisplay10['0']['CNTATC'] : '0';
$CNTDisplay20 = isset($ACTDisplay20['0']['CNTATC']) ? $ACTDisplay20['0']['CNTATC'] : '0';
$lctList = $ReportResult->Lctlist();
$AmountToYear = $ReportResult->Amountbudget($Atcsource, $db);
?>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-file-chart-outline"></i> รายงานวัสดุ </h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1"> จำนวนวัสดุทั้งหมด </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="d-flex align-items-center bg-info mt-2">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info rounded-2 fs-2">
                                            <i data-feather="database"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <h5 class="text-uppercase fw-medium text-light text-truncate mt-3">
                                            วัสดุทั้งหมด</h5>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $CNTDisplayAll; ?>">0</span> รายการ</h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="d-flex align-items-center bg-success mt-2">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success rounded-2 fs-2">
                                            <i data-feather="aperture"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <h5 class="text-uppercase fw-medium text-light text-truncate mt-3">
                                            วัสดุสิ้นเปลือง</h5>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $CNTDisplay10; ?>">0</span> รายการ</h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="d-flex align-items-center bg-warning mt-2">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-warning rounded-2 fs-2">
                                            <i data-feather="layers"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <h5 class="text-uppercase fw-medium text-light text-truncate mt-3">
                                            วัสดุคงทน</h5>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $CNTDisplay20; ?>">0</span> รายการ</h4>
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
                        <form class="form-horizontal" id="f_reportatc" name="f_reportatc" action="?Page=report-atc" method="post" autocomplete="off">
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
                                        <label for="txttypeatc" class="form-label"><b>ประเภทของวัสดุ</b></label>
                                        <select class="required form-select" id="txttypeatc" name="txttypeatc" style="width: 100%; height:36px;">
                                            <option value="">ทั้งหมด</option>
                                            <option value="10">วัสดุสิ้นเปลือง</option>
                                            <option value="20">วัสดุคงทน</option>
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
                                    <button type="submit" class="btn btn-info2 text-light"><i class="mdi mdi-database-search"></i> ค้นหา</button>
                                    <button type="button" class="btn btn-warning2 text-light" onClick="window.location.href = '?Page=report-atc'"><i class="mdi mdi-backup-restore"></i> Reset</button>
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
                                                    } ?>;">
                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1"> จำนวนวัสดุปีงบประมาณ
                            <?php echo $Atcyear != "" ? ": <span class='badge bg-light text-dark'>" . ($Atcyear + 543) . "</span>" : ""; ?>
                            <?php echo $Atcsource != "" ? " <span class='badge bg-light text-dark'>" . $AmountToYear['0']['AMS_BUDGET_SOURCENM'] . ' ' . $AmountToYear['0']['AMS_BUDGET_CLASSNM'] . ' ' . $AmountToYear['0']['AMS_BUDGET_TYPENM'] . "</span>" : ""; ?>
                            <?php echo $rpedcob != "" ? "หน่วยงานที่รับผิดชอบ: <span class='badge bg-light text-dark'>" . $ReportResult->DisplayHeader($rpedcob, 2) . "</span>" : ""; ?>
                            <?php if ($Atctype == "10") {
                                $distypeatc = "วัสดุสิ้นเปลือง";
                            } elseif ($Atctype == "20") {
                                $distypeatc = "วัสดุคงทน";
                            } else {
                                $distypeatc = "";
                            } ?>
                            <?php echo $Atctype != "" ? "ประเภทของวัสดุ: <span class='badge bg-light text-dark'>" . $distypeatc . "</span>" : ""; ?>
                            <?php if ($Atcstatus == "0") {
                                $disSt = "ยังอยู่ในประกัน";
                            } elseif ($Atcstatus == "1") {
                                $disSt = "ประกันหมดอายุ";
                            } else {
                                $disSt = "";
                            } ?>
                            <?php echo $Atcstatus != "3" ? "สถานะการรับประกัน: <span class='badge bg-light text-dark'>" . $disSt . "</span>" : ""; ?>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        foreach ($AllArticelDis as $value_kh) {
                            if ($value_kh['TYPE'] == '10') {
                                $DisTOKH10 = $value_kh['CNT'];
                            } elseif ($value_kh['TYPE'] == '20') {
                                $DisTOKH20 = $value_kh['CNT'];
                            } else {
                                $DisTOKH10 = 0;
                                $DisTOKH20 = 0;
                            }
                        }
                        $DisTOKH10Y = isset($DisTOKH10) ? $DisTOKH10 : 0;
                        $DisTOKH20Y = isset($DisTOKH20) ? $DisTOKH20 : 0;
                        ?>
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="d-flex align-items-center bg-info mt-2">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info rounded-2 fs-2">
                                            <i data-feather="database"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <h5 class="text-uppercase fw-medium text-light text-truncate mt-3">
                                            วัสดุทั้งหมด</h5>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $DisTOKH10Y + $DisTOKH20Y; ?>">0</span> รายการ</h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="d-flex align-items-center bg-success mt-2">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success rounded-2 fs-2">
                                            <i data-feather="aperture"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <h5 class="text-uppercase fw-medium text-light text-truncate mt-3">
                                            วัสดุสิ้นเปลือง</h5>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $DisTOKH10Y; ?>">0</span> รายการ</h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="d-flex align-items-center bg-warning mt-2">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-warning rounded-2 fs-2">
                                            <i data-feather="layers"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <h5 class="text-uppercase fw-medium text-light text-truncate mt-3">
                                            วัสดุคงทน</h5>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $DisTOKH20Y; ?>">0</span> รายการ</h4>
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
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-format-list-checks"></i> รายละเอียด</h4>

                    </div>
                    <div class="card-body">
                        <?php if ($ActionDisplay == 'Display') { ?>
                        <div class="mt-3">
                            
                            <button class="btn btn-sm btn-success2" onclick="window.open('./pages/reports/excel/Ex_article.php?a1=<?php echo $Atcname; ?>&a2=<?php echo $Atctype; ?>&a3=<?php echo $Atcyear; ?>&a4=<?php echo $Atcsource; ?>&a5=<?php echo $Atcfdate; ?>&a6=<?php echo $rpedcob; ?>&a7=<?php echo $Atcstatus; ?>','pwin')"><i class="mdi mdi-file-excel"></i> รายงานรูปแบบ Excel</button>
                            <button class="btn btn-sm btn-danger2" onclick="window.open('./pages/reports/pdf/Pdf_article.php?a1=<?php echo $Atcname; ?>&a2=<?php echo $Atctype; ?>&a3=<?php echo $Atcyear; ?>&a4=<?php echo $Atcsource; ?>&a5=<?php echo $Atcfdate; ?>&a6=<?php echo $rpedcob; ?>&a7=<?php echo $Atcstatus; ?>','pwin')"><i class="mdi mdi-file-pdf-box"></i> รายงานรูปแบบ PDF</button>
                        </div>
                        <div class="mt-3"></div>
                        <?php } ?>
                        <table id="articlemanagereport" class="table table-bordered dt-responsive  table-striped align-middle text-wrap table-hover" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th hidden>ปี</th>
                                    <th hidden>ที่มา</th>
                                    <th hidden>ชื่อ</th>
                                    <th hidden>รหัสวัสดุ</th>
                                    <th>ชื่อวัสดุ</th>
                                    <th>ประเภทวัสดุ</th>
                                    <th>จำนวน</th>
                                    <th>ราคาต่อหน่วย</th>
                                    <th hidden>วันหมดประกัน</th>
                                    <th>ปีงบประมาณ แหล่งที่มา</th>
                                    <!-- <th>สถานะข้อมูล</th> -->
                                    <th hidden>หน่วยนับ</th>
                                    <th hidden>วันสิ้นสุดประกัน</th>
                                    <th hidden>หน่วยงานรับผิดชอบ</th>
                                    <th>จำนวนคงเหลือ</th>
                                    <th>วันที่ตรวจสอบยอด</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                if ($ActionDisplay == 'Display') {
                                    foreach ($AllArticel as $key_atc => $value_atc) {
                                        $Yearsource = $value_atc["AMS_BUDGET_YEAR"] + 543;
                                ?>
                                        <tr class="text-center">
                                            <td hidden><?php echo $value_atc["AMS_BUDGET_YEAR"]; ?></td>
                                            <td hidden><?php echo $value_atc["AMS_BUDGET_SOURCENM"]; ?></td>
                                            <td hidden><?php echo $value_atc["AMS_ARTICLE_NM"]; ?></td>
                                            <td hidden><?php echo $value_atc["AMS_ARTICLE_ID"]; ?></td>
                                            <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $value_atc["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $value_atc["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM'] . ' ' . $value_atc['AMS_BUDGET_CLASSNM'] . ' ' . $value_atc['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $value_atc["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ReportResult->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $value_atc["AMS_ARTICLE_FDATE"]; ?>">
                                                <?php echo $value_atc["AMS_ARTICLE_NM"]; ?>
                                            </td>
                                            <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $value_atc["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $value_atc["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM'] . ' ' . $value_atc['AMS_BUDGET_CLASSNM'] . ' ' . $value_atc['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $value_atc["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ReportResult->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $value_atc["AMS_ARTICLE_FDATE"]; ?>">
                                                <?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>
                                            </td>
                                            <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $value_atc["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $value_atc["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM'] . ' ' . $value_atc['AMS_BUDGET_CLASSNM'] . ' ' . $value_atc['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $value_atc["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ReportResult->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $value_atc["AMS_ARTICLE_FDATE"]; ?>">
                                                <?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>
                                            </td>
                                            <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $value_atc["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $value_atc["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM'] . ' ' . $value_atc['AMS_BUDGET_CLASSNM'] . ' ' . $value_atc['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $value_atc["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ReportResult->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $value_atc["AMS_ARTICLE_FDATE"]; ?>">
                                                <?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>
                                            </td>
                                            <td hidden>
                                                <?php echo $ReportResult->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>
                                            </td>
                                            <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $value_atc["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $value_atc["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM'] . ' ' . $value_atc['AMS_BUDGET_CLASSNM'] . ' ' . $value_atc['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $value_atc["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ReportResult->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $value_atc["AMS_ARTICLE_FDATE"]; ?>">
                                                <h5><span class="badge rounded-pill bg-light text-dark"><?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM']; ?></span><span class="badge rounded-pill bg-light text-dark"><?php echo $value_atc['AMS_BUDGET_CLASSNM']; ?></span><span class="badge rounded-pill bg-<?php echo $value_atc['AMS_BUDGET_TYPE'] == '301' ? 'success' : 'warning'; ?> text-dark"><?php echo $value_atc['AMS_BUDGET_TYPENM']; ?></span></h5>
                                            </td>
                                            <!-- <td>
                                            <h5><span class="badge rounded-pill bg-<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'info' : 'danger'; ?> text-dark"><i class="mdi mdi-tag"></i> <?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'ไม่ใช้งาน'; ?></h5></span>
                                        </td> -->
                                            <td hidden><?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?></td>
                                            <td hidden><?php echo $ReportResult->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?></td>
                                            <td hidden><?php echo $value_atc["AMS_LCT_NM"]; ?></td>
                                            <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $value_atc["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $value_atc["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM'] . ' ' . $value_atc['AMS_BUDGET_CLASSNM'] . ' ' . $value_atc['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $value_atc["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ReportResult->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $value_atc["AMS_ARTICLE_FDATE"]; ?>"><?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?></td>
                                            <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $value_atc["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $value_atc["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM'] . ' ' . $value_atc['AMS_BUDGET_CLASSNM'] . ' ' . $value_atc['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $value_atc["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ReportResult->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $value_atc["AMS_ARTICLE_FDATE"]; ?>"><?php echo $ReportResult->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?></td>
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

<div class="modal fade" id="ArticlecontentModal" tabindex="-1" aria-labelledby="ArticlecontentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ArticlecontentModalLabel">รายละเอียดข้อมูล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6  atcname">
                            <label for="txtdatcnamemodal" class="col-form-label"><b>ชื่อวัสดุ:</b></label>
                            <input type="text" class="form-control" id="txtatcnamemodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  type">
                            <label for="txttypemodal" class="col-form-label"><b>ประเภท:</b></label>
                            <input type="text" class="form-control" id="txttypemodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  cnt">
                            <label for="txtcntmodal" class="col-form-label"><b>จำนวน:</b></label>
                            <input type="text" class="form-control" id="txtcntmodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  price">
                            <label for="txtpricemodal" class="col-form-label"><b>ราคาต่อหน่วย:</b></label>
                            <input type="text" class="form-control" id="txtpricemodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  unit">
                            <label for="txtunitmodal" class="col-form-label"><b>หน่วยนับ:</b></label>
                            <input type="text" class="form-control" id="txtunitmodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  expdate">
                            <label for="txtexpdatemodal" class="col-form-label"><b>วันสิ้นสุดการรับประกัน:</b></label>
                            <input type="text" class="form-control" id="txtexpdatemodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  year">
                            <label for="txtyearmodal" class="col-form-label"><b>ปีงบประมาณและแหล่งที่มา:</b></label>
                            <input type="text" class="form-control" id="txtyearmodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  lct">
                            <label for="txtlctmodal" class="col-form-label"><b>หน่วยงานรับผิดชอบ:</b></label>
                            <input type="text" class="form-control" id="txtlctmodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  bl">
                            <label for="txtblmodal" class="col-form-label"><b>จำนวนคงเหลือ:</b></label>
                            <input type="text" class="form-control" id="txtblmodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  bldate">
                            <label for="txtbldatemodal" class="col-form-label"><b>วันที่ตรวจสอบยอด:</b></label>
                            <input type="text" class="form-control" id="txtbldatemodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  status">
                            <label for="txtstatusmodal" class="col-form-label"><b>สถานะข้อมูล:</b></label>
                            <input type="text" class="form-control" id="txtstatusmodal" disabled="disabled">
                        </div>
                        <div class="col-md-6  fdate">
                            <label for="txtfdatemodal" class="col-form-label"><b>วันที่บันทึก:</b></label>
                            <input type="text" class="form-control" id="txtfdatemodal" disabled="disabled">
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