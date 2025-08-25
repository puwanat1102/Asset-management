<?php
$_SESSION['chkDup'] = '0';
include 'report_funtion.php';
$ReportResult = new ReportResult();

$YearbudgetAll = $ReportResult->YearBudgets($db);
$yearResult = isset($_POST['txtyearatc']) ? $_POST['txtyearatc'] : '';
$idSource = isset($_POST['txtsourceatc']) ? $_POST['txtsourceatc'] : '';
$AmountToYear = $ReportResult->Amountbudget($idSource, $db);
$YearToBudgetSelect = isset($AmountToYear['0']['AMS_BUDGET_YEAR']) ? $AmountToYear['0']['AMS_BUDGET_YEAR'] + 543 : '';
$SumProduct = $ReportResult->SumpriceToBudget($idSource, 1, $db);
$SumArticle = $ReportResult->SumpriceToBudget($idSource, 2, $db);
$AllAmount =  isset($AmountToYear['0']['AMS_BUDGET_AMOUNT']) ? $AmountToYear['0']['AMS_BUDGET_AMOUNT'] : '0';
$SumPricePDC = isset($SumProduct['0']['SUMPRICEPDC']) ? $SumProduct['0']['SUMPRICEPDC'] : '0';
$SumPriceATC = isset($SumArticle['0']['SUMPRICEATC']) ? $SumArticle['0']['SUMPRICEATC'] : '0';
$BalanceBudget = $AllAmount - ($SumPricePDC + $SumPriceATC);
$HistoryAll = $ReportResult->ProductAndATCBudgetAll($idSource, $db);
?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-file-chart-outline"></i> รายงานงบประมาณ </h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-bank"></i> ค้นหารายงานงบประมาณ </h4>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" id="f_reportbd" name="f_reportbd" action="?Page=report-bd" method="post" autocomplete="off">
                            <div class="row gy-4">

                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="txtyearatc" class="form-label"><b>ปีงบประมาณ</b></label>
                                        <select class="required form-select" id="txtyearatc" name="txtyearatc" style="width: 100%; height:36px;" required>
                                            <option value="">ทั้งหมด</option>
                                            <?php foreach ($YearbudgetAll as $key_bgyear => $value_bdyear) { ?>
                                                <option value="<?php echo $value_bdyear["BGYEAR"]; ?>"><?php echo $value_bdyear["BGYEAR"] + 543; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-8 col-md-6">
                                    <div>
                                        <label for="txtsourceatc" class="form-label"><b>ที่มางบประมาณ</b></label>
                                        <select class="required form-select" id="txtsourceatc" name="txtsourceatc" style="width: 100%; height:36px;" required>
                                            <option value="">ทั้งหมด</option>
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
                                    <button type="button" class="btn btn-warning2 text-light" onClick="window.location.href = '?Page=report-bd'"><i class="mdi mdi-backup-restore"></i> Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- result -->
                <?php if ($yearResult != "") { ?>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-bookmark"></i> งบประมาณปี <?php echo $YearToBudgetSelect . ' ' . $AmountToYear['0']['AMS_BUDGET_SOURCENM'] . ' ' . $AmountToYear['0']['AMS_BUDGET_CLASSNM'] . ' ' . $AmountToYear['0']['AMS_BUDGET_TYPENM']; ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <div class="d-flex align-items-center bg-primarycus mt-2">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primarycus rounded-2 fs-2">
                                                <i data-feather="bar-chart"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <h5 class="text-uppercase fw-medium text-light text-truncate mt-3">
                                                งบประมาณทั้งหมด</h5>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $AllAmount; ?>">0</span> บาท</h4>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="d-flex align-items-center bg-warning mt-2">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-warning rounded-2 fs-2">
                                                <i data-feather="printer"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <h5 class="text-uppercase fw-medium text-light text-truncate mt-3">
                                                ค่าใช้จ่ายครุภัณฑ์</h5>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $SumPricePDC; ?>">0</span> บาท</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="d-flex align-items-center bg-info mt-2">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-info rounded-2 fs-2">
                                                <i data-feather="cpu"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <h5 class="text-uppercase fw-medium text-light text-truncate mt-3">
                                                ค่าใช้จ่ายวัสดุ</h5>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $SumPriceATC; ?>">0</span> บาท</h4>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="d-flex align-items-center bg-success mt-2">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-success rounded-2 fs-2">
                                                <i data-feather="star"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <h5 class="text-uppercase fw-medium text-light text-truncate mt-3">
                                                งบคงเหลือ</h5>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0 text-light"><span class="counter-value" data-target="<?php echo $BalanceBudget; ?>">0</span> บาท</h4>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-format-list-checks"></i> รายละเอียด</h4>
                        </div>
                        <div class="card-body">
                            <div class="mt-3">
                                <button class="btn btn-sm btn-success2" onclick="window.open('./pages/reports/excel/Ex_budget.php?b1=<?php echo $idSource; ?>','pwin')"><i class="mdi mdi-file-excel"></i> รายงานรูปแบบ Excel</button>
                                <button class="btn btn-sm btn-danger2" onclick="window.open('./pages/reports/pdf/Pdf_budget.php?b1=<?php echo $idSource; ?>','pwin')"><i class="mdi mdi-file-pdf-box"></i> รายงานรูปแบบ PDF</button>
                            </div>

                            <div class="mt-3"></div>
                            <table id="budgetmanageallreport" class="table table-bordered dt-responsive nowrap table-striped align-middle table-hover" style="width:100%">

                                <thead>
                                    <tr class="text-center">
                                        <th hidden></th>
                                        <th hidden>ปีงบประมาณ</th>
                                        <th>ประเภท</th>
                                        <th>ชื่อวัสดุ/ครุภัณฑ์</th>
                                        <th>เลขครุภัณฑ์/ประเภทวัสดุ</th>
                                        <th>ราคา</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sum = '0';
                                    foreach ($HistoryAll as $key_hisbd => $value_hisbd) {
                                        $modalARC = $ReportResult->ArticleListToModal($value_hisbd['IDBD'], $value_hisbd['TYPEBD']);
                                        $Yearsource = isset($modalARC["0"]["AMS_BUDGET_YEAR"]) ? $modalARC["0"]["AMS_BUDGET_YEAR"] + 543 : "";
                                    ?>
                                        <tr class="text-center">
                                            <td hidden><?php echo $value_hisbd['TYPEBD']; ?></td>
                                            <td hidden><?php echo $YearToBudgetSelect . ' ' . $AmountToYear['0']['AMS_BUDGET_SOURCENM'] . ' ' . $AmountToYear['0']['AMS_BUDGET_CLASSNM'] . ' ' . $AmountToYear['0']['AMS_BUDGET_TYPENM']; ?></td>
                                            <td class="cursor-pointer" <?php if ($value_hisbd['TYPEBD'] == 'ATC') { ?> class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $modalARC["0"]["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $modalARC["0"]["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $modalARC["0"]["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $modalARC["0"]["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($modalARC["0"]["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($modalARC["0"]["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $modalARC["0"]['AMS_BUDGET_SOURCENM'] . ' ' . $modalARC["0"]['AMS_BUDGET_CLASSNM'] . ' ' . $modalARC["0"]['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $modalARC["0"]["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $modalARC["0"]["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ReportResult->dateToThai($modalARC["0"]["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $modalARC["0"]['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $modalARC["0"]["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $modalARC["0"]["AMS_ARTICLE_FDATE"]; ?>" <?php } else { ?> data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $modalARC["0"]["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $modalARC["0"]["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $modalARC["0"]["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $modalARC["0"]["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($modalARC["0"]['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($modalARC["0"]["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($modalARC["0"]["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $modalARC["0"]["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $modalARC["0"]["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $modalARC["0"]["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $modalARC["0"]["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $modalARC["0"]["AMS_PRODUCTSET_NO"] . ' | ' . $modalARC["0"]["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $modalARC["0"]["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $modalARC["0"]['AMS_BUDGET_SOURCENM'] . ' ' . $modalARC["0"]['AMS_BUDGET_CLASSNM'] . ' ' . $modalARC["0"]['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $modalARC["0"]['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $modalARC["0"]["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $modalARC["0"]['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($modalARC["0"]['AMS_PRODUCTSET_PRICE'], 2); ?>" <?php } ?>>
                                                <?php echo $value_hisbd['TYPEBD'] == 'ATC' ? 'วัสดุ' : 'ครุภัณฑ์'; ?>
                                            </td>
                                            <td class="cursor-pointer" <?php if ($value_hisbd['TYPEBD'] == 'ATC') { ?> class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $modalARC["0"]["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $modalARC["0"]["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $modalARC["0"]["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $modalARC["0"]["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($modalARC["0"]["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($modalARC["0"]["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $modalARC["0"]['AMS_BUDGET_SOURCENM'] . ' ' . $modalARC["0"]['AMS_BUDGET_CLASSNM'] . ' ' . $modalARC["0"]['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $modalARC["0"]["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $modalARC["0"]["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ReportResult->dateToThai($modalARC["0"]["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $modalARC["0"]['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $modalARC["0"]["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $modalARC["0"]["AMS_ARTICLE_FDATE"]; ?>" <?php } else { ?> data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $modalARC["0"]["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $modalARC["0"]["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $modalARC["0"]["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $modalARC["0"]["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($modalARC["0"]['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($modalARC["0"]["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($modalARC["0"]["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $modalARC["0"]["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $modalARC["0"]["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $modalARC["0"]["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $modalARC["0"]["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $modalARC["0"]["AMS_PRODUCTSET_NO"] . ' | ' . $modalARC["0"]["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $modalARC["0"]["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $modalARC["0"]['AMS_BUDGET_SOURCENM'] . ' ' . $modalARC["0"]['AMS_BUDGET_CLASSNM'] . ' ' . $modalARC["0"]['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $modalARC["0"]['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $modalARC["0"]["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $modalARC["0"]['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($modalARC["0"]['AMS_PRODUCTSET_PRICE'], 2); ?>" <?php } ?>><?php echo $value_hisbd['BDNM']; ?></td>
                                            <td class="cursor-pointer" <?php if ($value_hisbd['TYPEBD'] == 'ATC') { ?> class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $modalARC["0"]["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $modalARC["0"]["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $modalARC["0"]["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $modalARC["0"]["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($modalARC["0"]["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($modalARC["0"]["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $modalARC["0"]['AMS_BUDGET_SOURCENM'] . ' ' . $modalARC["0"]['AMS_BUDGET_CLASSNM'] . ' ' . $modalARC["0"]['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $modalARC["0"]["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $modalARC["0"]["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ReportResult->dateToThai($modalARC["0"]["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $modalARC["0"]['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $modalARC["0"]["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $modalARC["0"]["AMS_ARTICLE_FDATE"]; ?>" <?php } else { ?> data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $modalARC["0"]["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $modalARC["0"]["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $modalARC["0"]["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $modalARC["0"]["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($modalARC["0"]['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($modalARC["0"]["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($modalARC["0"]["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $modalARC["0"]["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $modalARC["0"]["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $modalARC["0"]["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $modalARC["0"]["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $modalARC["0"]["AMS_PRODUCTSET_NO"] . ' | ' . $modalARC["0"]["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $modalARC["0"]["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $modalARC["0"]['AMS_BUDGET_SOURCENM'] . ' ' . $modalARC["0"]['AMS_BUDGET_CLASSNM'] . ' ' . $modalARC["0"]['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $modalARC["0"]['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $modalARC["0"]["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $modalARC["0"]['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($modalARC["0"]['AMS_PRODUCTSET_PRICE'], 2); ?>" <?php } ?>><?php if ($value_hisbd['TYPEBD'] == 'ATC') {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo $value_hisbd['BDNO'] == '10' ? 'วัสดุสิ้นเปลือง' : 'วัสดุคงทน';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo $value_hisbd['BDNO'];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?></td>
                                            <td class="cursor-pointer" <?php if ($value_hisbd['TYPEBD'] == 'ATC') { ?> class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $modalARC["0"]["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $modalARC["0"]["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $modalARC["0"]["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $modalARC["0"]["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($modalARC["0"]["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($modalARC["0"]["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $modalARC["0"]['AMS_BUDGET_SOURCENM'] . ' ' . $modalARC["0"]['AMS_BUDGET_CLASSNM'] . ' ' . $modalARC["0"]['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $modalARC["0"]["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $modalARC["0"]["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ReportResult->dateToThai($modalARC["0"]["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $modalARC["0"]['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $modalARC["0"]["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $modalARC["0"]["AMS_ARTICLE_FDATE"]; ?>" <?php } else { ?> data-bs-toggle="modal" data-bs-target="#ProductcontentModal" data-bs-id="<?php echo $modalARC["0"]["AMS_PRODUCT_ID"]; ?>" data-bs-pno="<?php echo $modalARC["0"]["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $modalARC["0"]["AMS_PRODUCT_NM"]; ?>" data-bs-unit="<?php echo $modalARC["0"]["AMS_PRODUCT_QTY"]; ?>" data-bs-price="<?php echo number_format($modalARC["0"]['AMS_PRODUCT_PRICE'], 2); ?>" data-bs-sdate="<?php echo $ReportResult->dateToThai($modalARC["0"]["AMS_PRODUCT_SDATE"]); ?>" data-bs-expdate="<?php echo $ReportResult->dateToThai($modalARC["0"]["AMS_PRODUCT_EXPDATE"]); ?>" data-bs-ptype="<?php echo $modalARC["0"]["AMS_DEPRECIATION_TYPE"]; ?>" data-bs-plct="<?php echo $modalARC["0"]["AMS_LCT_NM"]; ?>" data-bs-ploc="<?php echo $modalARC["0"]["AMS_PRODUCT_LOC"]; ?>" data-bs-pstatus="<?php echo $modalARC["0"]["AMS_PRODUCT_STNM"]; ?>" data-bs-pset="<?php echo $modalARC["0"]["AMS_PRODUCTSET_NO"] . ' | ' . $modalARC["0"]["AMS_PRODUCTSET_NM"]; ?>" data-bs-pyear="<?php echo $modalARC["0"]["AMS_PRODUCT_YEAR"] + 543; ?>" data-bs-psource="<?php echo $modalARC["0"]['AMS_BUDGET_SOURCENM'] . ' ' . $modalARC["0"]['AMS_BUDGET_CLASSNM'] . ' ' . $modalARC["0"]['AMS_BUDGET_TYPENM']; ?>" data-bs-pdatast="<?php echo $modalARC["0"]['AMS_PRODUCT_DELST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $modalARC["0"]["AMS_PRODUCT_FDATE"]; ?>" data-bs-pcntset="<?php echo $modalARC["0"]['AMS_PRODUCTSET_QTY']; ?>" data-bs-ppriceunit="<?php echo number_format($modalARC["0"]['AMS_PRODUCTSET_PRICE'], 2); ?>" <?php } ?>><?php echo number_format($value_hisbd['BDPRICE'], 2); ?></td>
                                        </tr>

                                    <?php
                                        $sum += $value_hisbd['BDPRICE'];
                                    } ?>
                                </tbody>
                                <tfoot>
                                    <tr class="text-center">
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td colspan="2"></td>
                                        <td><b>รวม</b></td>
                                        <td><b><?php echo number_format($sum, 2); ?></b></td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                <?php } else {
                } ?>
                <!-- result -->
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
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
<!--end modal -->