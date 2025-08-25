<?php
$_SESSION['chkDup'] = '0';
include 'article_function.php';
$ArticleList = new ArticleResult();
$Atcname = isset($_POST['txtnameatc']) ? $_POST['txtnameatc'] : '';
$Atctype = isset($_POST['txttypeatc']) ? $_POST['txttypeatc'] : '';
$Atcyear = isset($_POST['txtyearatc']) ? $_POST['txtyearatc'] : '';
$Atcsource = isset($_POST['txtsourceatc']) ? $_POST['txtsourceatc'] : '';
$Atcfdate = isset($_POST['txtexpdate']) ? $ArticleList->dateTosave($_POST['txtexpdate']) : '';
$Atcldate = isset($_POST['txtbalancedate']) ? $ArticleList->dateTosave($_POST['txtbalancedate']) : '';
$Atcstatus = isset($_POST['txtatcst']) ? $_POST['txtatcst'] : '';
$AllArticel = $ArticleList->ArticleList($Atcname, $Atctype, $Atcyear, $Atcsource, $Atcfdate, $Atcldate, $Atcstatus, $db);
$YearbudgetAll = $ArticleList->YearBudgets($db);

$ACTDisplay = $ArticleList->CountATCToDisplay(100);
$ACTDisplay10 = $ArticleList->CountATCToDisplay(10);
$ACTDisplay20 = $ArticleList->CountATCToDisplay(20);
$CNTDisplayAll = isset($ACTDisplay['0']['CNTATC']) ? $ACTDisplay['0']['CNTATC'] : '0';
$CNTDisplay10 = isset($ACTDisplay10['0']['CNTATC']) ? $ACTDisplay10['0']['CNTATC'] : '0';
$CNTDisplay20 = isset($ACTDisplay20['0']['CNTATC']) ? $ACTDisplay20['0']['CNTATC'] : '0';
?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-treasure-chest"></i> จัดการวัสดุ </h4>

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

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-database-search"></i> ค้นหาข้อมูลวัสดุ</h4>
                    </div><!-- end card header -->
                    <div class="card-body">

                        <form class="form-horizontal" id="f_satc" name="f_satc" action="?Page=atc-manage" method="post" autocomplete="off">
                            <div class="row gy-4">
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                        <label for="txtnameatc" class="form-label"><b>ชื่อวัสดุ</b></label>
                                        <input type="text" class="form-control" name="txtnameatc">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-md-6">
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
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="txtexpdate" class="form-label"><b>วันสิ้นสุดรับประกันตั้งแต่</b></label>
                                        <input type="text" class="form-control" id="txtexpdate" name="txtexpdate">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="txtbalancedate" class="form-label"><b>ถึง</b></label>
                                        <input type="text" class="form-control" id="txtbalancedate" name="txtbalancedate">
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
                                    <button type="button" class="btn btn-warning2 text-light" onClick="window.location.href = '?Page=atc-manage'"><i class="mdi mdi-backup-restore"></i> Reset</button>
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
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-format-list-bulleted"></i> รายการวัสดุ</h4>
                        <?php if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202') { ?>
                            <div class="text-right"><button class="btn btn-md btn-success3" onClick="location.href='?Page=atc-add'"><i class="mdi mdi-cash-plus"></i> เพิ่มรายการวัสดุ</button></div>
                        <?php } else {
                        } ?>
                    </div><!-- end card header -->
                    <div class="card-body">

                        <table id="articlemanage" class="table table-bordered dt-responsive  table-striped align-middle text-wrap table-hover" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th hidden>รหัสวัสดุ</th>
                                    <th>ชื่อวัสดุ</th>
                                    <th>ประเภทวัสดุ</th>
                                    <th>จำนวน</th>
                                    <th>ราคาต่อหน่วย</th>
                                    <th>วันสิ้นสุดรับประกัน</th>
                                    <th>ปีงบประมาณ แหล่งที่มา</th>
                                    <!-- <th>สถานะข้อมูล</th> -->
                                    <th width="3%"></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($AllArticel as $key_atc => $value_atc) {
                                    $Yearsource = $value_atc["AMS_BUDGET_YEAR"] + 543;
                                ?>
                                    <tr class="text-center">
                                        <td hidden><?php echo $value_atc["AMS_ARTICLE_ID"]; ?></td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $value_atc["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $value_atc["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM'] . ' ' . $value_atc['AMS_BUDGET_CLASSNM'] . ' ' . $value_atc['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $value_atc["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $value_atc["AMS_ARTICLE_FDATE"]; ?>">
                                            <?php echo $value_atc["AMS_ARTICLE_NM"]; ?>
                                        </td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $value_atc["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $value_atc["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM'] . ' ' . $value_atc['AMS_BUDGET_CLASSNM'] . ' ' . $value_atc['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $value_atc["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $value_atc["AMS_ARTICLE_FDATE"]; ?>">
                                            <?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>
                                        </td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $value_atc["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $value_atc["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM'] . ' ' . $value_atc['AMS_BUDGET_CLASSNM'] . ' ' . $value_atc['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $value_atc["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $value_atc["AMS_ARTICLE_FDATE"]; ?>">
                                            <?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>
                                        </td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $value_atc["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $value_atc["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM'] . ' ' . $value_atc['AMS_BUDGET_CLASSNM'] . ' ' . $value_atc['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $value_atc["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $value_atc["AMS_ARTICLE_FDATE"]; ?>">
                                            <?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>
                                        </td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $value_atc["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $value_atc["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM'] . ' ' . $value_atc['AMS_BUDGET_CLASSNM'] . ' ' . $value_atc['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $value_atc["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $value_atc["AMS_ARTICLE_FDATE"]; ?>">
                                            <?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>
                                        </td>
                                        <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $value_atc["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $value_atc["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM'] . ' ' . $value_atc['AMS_BUDGET_CLASSNM'] . ' ' . $value_atc['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $value_atc["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $value_atc["AMS_ARTICLE_FDATE"]; ?>">
                                            <h5><span class="badge rounded-pill bg-light text-dark"><?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM']; ?></span><span class="badge rounded-pill bg-light text-dark"><?php echo $value_atc['AMS_BUDGET_CLASSNM']; ?></span><span class="badge rounded-pill bg-<?php echo $value_atc['AMS_BUDGET_TYPE'] == '301' ? 'success' : 'warning'; ?> text-dark"><?php echo $value_atc['AMS_BUDGET_TYPENM']; ?></span></h5>
                                        </td>
                                        <!-- <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#ArticlecontentModal" data-bs-id="<?php echo $value_atc["AMS_ARTICLE_ID"]; ?>" data-bs-atcnm="<?php echo $value_atc["AMS_ARTICLE_NM"]; ?>" data-bs-type="<?php echo $value_atc["AMS_ARTICLE_TYPENM"]; ?>" data-bs-cnt="<?php echo $value_atc["AMS_ARTICLE_QTY"]; ?>" data-bs-price="<?php echo number_format($value_atc["AMS_ARTICLE_PRICE"], 2); ?>" data-bs-expdate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_EXPDATE"]); ?>" data-bs-year="<?php echo $Yearsource . ' ' . $value_atc['AMS_BUDGET_SOURCENM'] . ' ' . $value_atc['AMS_BUDGET_CLASSNM'] . ' ' . $value_atc['AMS_BUDGET_TYPENM']; ?>" data-bs-lct="<?php echo $value_atc["AMS_LCT_NM"]; ?>" data-bs-bl="<?php echo $value_atc["AMS_ARTICLE_BALANCE"]; ?>" data-bs-bldate="<?php echo $ArticleList->dateToThai($value_atc["AMS_ARTICLE_DBL"]); ?>" data-bs-status="<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-unit="<?php echo $value_atc["AMS_ARTICLE_UNIT"]; ?>" data-bs-fdate="<?php echo $value_atc["AMS_ARTICLE_FDATE"]; ?>">
                                            <h5><span class="badge rounded-pill bg-<?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'info' : 'danger'; ?> text-dark"><i class="mdi mdi-tag"></i> <?php echo $value_atc['AMS_ARTICLE_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?></h5></span>
                                        </td> -->
                                        <td>
                                            <?php if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202' || $_SESSION["grp"] == '203') {
                                                if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202') {
                                            ?>
                                                    <form action="?Page=atc-add" method="POST">
                                                        <input type="hidden" value="<?php echo $value_atc['AMS_ARTICLE_ID']; ?>" name="editIdValue">
                                                        <button class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</button>
                                                    </form>
                                                <?php } else { ?>
                                                    <form action="?Page=atc-addkrp" method="POST">
                                                        <input type="hidden" value="<?php echo $value_atc['AMS_ARTICLE_ID']; ?>" name="editIdValue">
                                                        <button type="submit" class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</button>
                                                    </form>
                                                <?php } ?>
                                                <?php if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202') { ?>
                                                    <button class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 remove-item-btn" data-bs-toggle="modal" data-bs-target="#DeletebudgetModal" data-bs-idbd="<?php echo $value_atc['AMS_ARTICLE_ID']; ?>" data-bs-delnm="<?php echo $value_atc["AMS_ARTICLE_NM"]; ?>">
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
                <form action="?Page=atc-result" method="POST">
                    <div class="iddel"><input type="hidden" name="txtiddel" class="form-control"></div>
                    <input type="hidden" name="Actionarticle" value="Del" class="form-control">
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
<!--end modal -->