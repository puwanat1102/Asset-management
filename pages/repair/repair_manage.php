<?php
$_SESSION['chkDup'] = '0';
include 'repair_function.php';
$RepairResult = new RepairResult();
// Data
$Tabchk = isset($_GET['t']) ? $_GET['t'] : '1';
    $rpfdate = isset($_POST['txtfdate']) ? $RepairResult->dateTosave($_POST['txtfdate']) : '';
    $rpldate = isset($_POST['txtldate']) ? $RepairResult->dateTosave($_POST['txtldate']) : '';
    $rppcdno = isset($_POST['txtproductno']) ? $_POST['txtproductno'] : '';
    $rppcdnm = isset($_POST['txtproductnm']) ? $_POST['txtproductnm'] : '';
    $rpsdate = isset($_POST['txtsucessdate']) ? $RepairResult->dateTosave($_POST['txtsucessdate']) : '';
    $rpcpn = isset($_POST['txtrpcpn']) ? $_POST['txtrpcpn'] : '';
    $rpfsave = isset($_POST['txtfsave']) ? $_POST['txtfsave'] : '';
    $rpst = isset($_POST['textstrp']) ? $_POST['textstrp'] : '';
    $rpdst = isset($_POST['txtrpstdata']) ? $_POST['txtrpstdata'] : '';

    $rpfdateper = isset($_POST['txtfdateper']) ? $RepairResult->dateTosave($_POST['txtfdateper']) : '';
    $rpldateper = isset($_POST['txtldateper']) ? $RepairResult->dateTosave($_POST['txtldateper']) : '';
    $rpsdateper = isset($_POST['txtsucessdateper']) ? $RepairResult->dateTosave($_POST['txtsucessdateper']) : '';
// Data
$TabAllRP = $RepairResult->RepairAllTabResult($rpfdate,$rpldate,$rppcdno,$rppcdnm,$rpsdate,$rpcpn,$rpfsave,$rpst,$rpdst,$db);
$TabPersonRP = $RepairResult->RepairPessonTabResult($_SESSION['id'],$rpfdateper,$rpldateper,$rppcdno,$rppcdnm,$rpsdateper,$rpcpn,$rpst,$rpdst, $db);
$UsersaveRepair = $RepairResult->ListRepairForUser($db);

?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-cog-pause"></i> จัดการข้อมูลการซ่อม </h4>

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
                                <a class="nav-link <?php echo $Tabchk == '2' ? '':'active'; ?>" data-bs-toggle="tab" href="#RepairAllTabs" role="tab"><i class="mdi mdi-database-cog"></i> รายการส่งซ่อมทั้งหมด</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $Tabchk == '2' ? 'active':''; ?>" data-bs-toggle="tab" href="#RepairPersonTabs" role="tab"><i class="mdi mdi-account-cog"></i> รายการส่งซ่อมส่วนบุคคล</a>
                            </li>
                        </ul><!-- Tab panes -->
                        <div class="tab-content text-muted">
                            <div class="tab-pane <?php echo $Tabchk == '2' ? '':'active'; ?>" id="RepairAllTabs" role="tabpanel">

                                <div class="row">
                                    <div class="col-12">

                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-database-search"></i> ค้นหาข้อมูลการซ่อมทั้งหมด</h4>
                                            </div><!-- end card header -->
                                            <div class="card-body">

                                                <form class="form-horizontal" id="f_repairsr" name="f_repairsr" action="?Page=rp-manage&t=1" method="post" autocomplete="off">
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
                                                        <div class="col-xxl-3 col-md-6">
                                                            <div>
                                                                <label for="txtproductno" class="form-label text-dark"><b>เลขทะเบียนครุภัณฑ์</b></label>
                                                                <input type="text" class="form-control" name="txtproductno">
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-xxl-5 col-md-6">
                                                            <div>
                                                                <label for="txtproductnm" class="form-label text-dark"><b>ชื่อครุภัณฑ์</b></label>
                                                                <input type="text" class="form-control" name="txtproductnm">
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-xxl-2 col-md-6">
                                                            <div>
                                                                <label for="txtsucessdate" class="form-label text-dark"><b>วันที่กำหนดแล้วเสร็จ</b></label>
                                                                <input type="text" class="form-control" name="txtsucessdate" id="txtsucessdate">
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-xxl-3 col-md-6">
                                                            <div>
                                                                <label for="txtrpcpn" class="form-label text-dark"><b>บริษัทที่ส่งซ่อม</b></label>
                                                                <input type="text" class="form-control" name="txtrpcpn">
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-xxl-3 col-md-6">
                                                            <div>
                                                                <label for="txtfsave" class="form-label text-dark"><b>ผู้บันทึกข้อมูลการซ่อม</b></label>
                                                                <select class="form-select js-example-basic-single" id="txtfsave" name="txtfsave">
                                                                    <option value="">ทั้งหมด</option>
                                                                    <?php foreach ($UsersaveRepair as $key_us => $value_us) { ?>
                                                                        <option value="<?php echo $value_us['AMS_USER_ID']; ?>"><?php echo $value_us['AMS_USER_FNAME'].' '.$value_us['AMS_USER_LNAME']; ?></option>
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

                                                        <div class="col-xxl-2 col-md-6">
                                                            <div>
                                                                <label for="txtrpstdata" class="form-label text-dark"><b>สถานะข้อมูล</b></label>
                                                                <select class="form-select" id="txtrpstdata" name="txtrpstdata">
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
                                                            <button type="button" class="btn btn-warning2 text-light" onClick="window.location.href = '?Page=rp-manage&t=1'"><i class="mdi mdi-backup-restore"></i> Reset</button>
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
                                                <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-format-list-bulleted"></i> รายการส่งซ่อมทั้งหมด</h4>
                                                <?php if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202' || $_SESSION["grp"] == '203') { ?>
                                                <div class="text-right"><button class="btn btn-md btn-success3" onClick="location.href='?Page=rp-add'"><i class="mdi mdi-folder-plus"></i> บันทึกการส่งซ่อม</button></div>&nbsp;
                                                <?php }else{ } ?>
                                            </div><!-- end card header -->
                                            <div class="card-body">
                                                <table id="repairmanageall" class="table table-bordered dt-responsive  table-striped align-middle text-wrap table-hover" style="width:100%">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th hidden></th>
                                                            <th hidden>รหัสส่งซ่อม</th>
                                                            <th>วันที่ส่งซ่อม</th>
                                                            <th>เลขทะเบียนครุภัณฑ์</th>
                                                            <th>ชื่อครุภัณฑ์</th>
                                                            <th>วันที่กำหนดแล้วเสร็จ</th>
                                                            <th>ผู้บันทึกข้อมูลการซ่อม</th>
                                                            <th>สถานะการส่งซ่อม</th>
                                                            <!-- <th>สถานะข้อมูล</th> -->
                                                            <th width="3%"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($TabAllRP as $key_allrp => $value_allrp) { ?>
                                                            <tr class="text-center">
                                                                <td hidden><?php echo $value_allrp['AMS_REPAIR_DATE']; ?></td>
                                                                <td hidden >
                                                                    <?php echo $value_allrp['AMS_REPAIR_ID']; ?>
                                                                </td>
                                                                <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepaircontentModal" data-bs-id="<?php echo $value_allrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_allrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_allrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_allrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $RepairResult->dateToThai($value_allrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $RepairResult->dateToThai($value_allrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_allrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_allrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_allrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_allrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_allrp["AMS_REPAIR_FDATE"]; ?>">
                                                                    <?php echo $RepairResult->dateToThai($value_allrp['AMS_REPAIR_DATE']); ?>
                                                                </td>
                                                                <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepaircontentModal" data-bs-id="<?php echo $value_allrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_allrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_allrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_allrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $RepairResult->dateToThai($value_allrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $RepairResult->dateToThai($value_allrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_allrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_allrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_allrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_allrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_allrp["AMS_REPAIR_FDATE"]; ?>">
                                                                    <?php echo $value_allrp['AMS_PRODUCT_NO']; ?>
                                                                </td>
                                                                <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepaircontentModal" data-bs-id="<?php echo $value_allrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_allrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_allrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_allrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $RepairResult->dateToThai($value_allrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $RepairResult->dateToThai($value_allrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_allrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_allrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_allrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_allrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_allrp["AMS_REPAIR_FDATE"]; ?>">
                                                                    <?php echo $value_allrp['AMS_PRODUCT_NM']; ?>
                                                                </td>
                                                                <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepaircontentModal" data-bs-id="<?php echo $value_allrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_allrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_allrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_allrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $RepairResult->dateToThai($value_allrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $RepairResult->dateToThai($value_allrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_allrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_allrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_allrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_allrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_allrp["AMS_REPAIR_FDATE"]; ?>">
                                                                    <?php echo  $RepairResult->dateToThai($value_allrp['AMS_REPAIR_SDATE']); ?>
                                                                </td>
                                                                <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepaircontentModal" data-bs-id="<?php echo $value_allrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_allrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_allrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_allrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $RepairResult->dateToThai($value_allrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $RepairResult->dateToThai($value_allrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_allrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_allrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_allrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_allrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_allrp["AMS_REPAIR_FDATE"]; ?>">
                                                                    <?php echo $value_allrp['AMS_USER_FNAME'] . ' ' . $value_allrp['AMS_USER_LNAME']; ?>
                                                                </td>
                                                                <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepaircontentModal" data-bs-id="<?php echo $value_allrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_allrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_allrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_allrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $RepairResult->dateToThai($value_allrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $RepairResult->dateToThai($value_allrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_allrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_allrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_allrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_allrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_allrp["AMS_REPAIR_FDATE"]; ?>">

                                                                    <h5><span class="badge rounded-pill bg-<?php echo $value_allrp['AMS_REPAIR_RST'] == '1' ? 'success' : 'warning'; ?> text-dark"><i class="mdi mdi-tag"></i> <?php echo $value_allrp['AMS_REPAIR_RSTNM']; ?></h5></span>
                                                                </td>
                                                                <!-- <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepaircontentModal" data-bs-id="<?php echo $value_allrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_allrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_allrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_allrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $RepairResult->dateToThai($value_allrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $RepairResult->dateToThai($value_allrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_allrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_allrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_allrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_allrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_allrp["AMS_REPAIR_FDATE"]; ?>">
                                                                    <h5><span class="badge rounded-pill bg-<?php echo $value_allrp['AMS_REPAIR_ST'] == '10' ? 'info' : 'danger'; ?> text-dark"><i class="mdi mdi-tag"></i> <?php echo $value_allrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?></h5></span>
                                                                </td> -->
                                                                <td>
                                                                    <?php if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202') { ?>
                                                                        <form action="?Page=rp-edit" method="POST">
                                                                            <input type="hidden" value="<?php echo $value_allrp['AMS_REPAIR_ID']; ?>" name="editIdValue">
                                                                            <button class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</button>
                                                                        </form>
                                                                        <button class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 remove-item-btn" data-bs-toggle="modal" data-bs-target="#DeletebudgetModal" data-bs-idbd="<?php echo $value_allrp['AMS_REPAIR_ID']; ?>" data-bs-delnm="<?php echo $value_allrp["AMS_REPAIR_ID"]; ?>">
                                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                                        </button>
                                                                        <?php } else {
                                                                        if ($value_allrp['AMS_REPAIR_STF'] == $_SESSION['id']) {
                                                                        ?>
                                                                            <form action="?Page=rp-edit" method="POST">
                                                                                <input type="hidden" value="<?php echo $value_allrp['AMS_REPAIR_ID']; ?>" name="editIdValue">
                                                                                <button class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</button>
                                                                            </form>
                                                                            <!-- <button class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 remove-item-btn" data-bs-toggle="modal" data-bs-target="#DeletebudgetModal" data-bs-idbd="<?php echo $value_allrp['AMS_REPAIR_ID']; ?>" data-bs-delnm="<?php echo $value_allrp["AMS_REPAIR_ID"]; ?>">
                                                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                                            </button> -->

                                                                    <?php } else {
                                                                        }
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
                            <div class="tab-pane <?php echo $Tabchk == '2' ? 'active':''; ?>" id="RepairPersonTabs" role="tabpanel">

                                <div class="row">
                                    <div class="col-12">

                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-database-search"></i> ค้นหาข้อมูลการซ่อมส่วนบุคคล</h4>
                                            </div><!-- end card header -->
                                            <div class="card-body">
                                                <form class="form-horizontal" id="f_repairsr" name="f_repairsr" action="?Page=rp-manage&t=2" method="post" autocomplete="off">
                                                    <div class="row gy-4">
                                                        <div class="col-xxl-2 col-md-6">
                                                            <div>
                                                                <label for="txtfdateper" class="form-label text-dark"><b>วันที่ส่งซ่อม</b></label>
                                                                <input type="text" class="form-control" name="txtfdateper" id="txtfdateper">
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-xxl-2 col-md-6">
                                                            <div>
                                                                <label for="txtldateper" class="form-label text-dark"><b>ถึงวันที่</b></label>
                                                                <input type="text" class="form-control" name="txtldateper" id="txtldateper">
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-xxl-3 col-md-6">
                                                            <div>
                                                                <label for="txtproductno" class="form-label text-dark"><b>เลขทะเบียนครุภัณฑ์</b></label>
                                                                <input type="text" class="form-control" name="txtproductno">
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-xxl-5 col-md-6">
                                                            <div>
                                                                <label for="txtproductnm" class="form-label text-dark"><b>ชื่อครุภัณฑ์</b></label>
                                                                <input type="text" class="form-control" name="txtproductnm">
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-xxl-2 col-md-6">
                                                            <div>
                                                                <label for="txtsucessdateper" class="form-label text-dark"><b>วันที่กำหนดแล้วเสร็จ</b></label>
                                                                <input type="text" class="form-control" name="txtsucessdateper" id="txtsucessdateper">
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-xxl-3 col-md-6">
                                                            <div>
                                                                <label for="txtrpcpn" class="form-label text-dark"><b>บริษัทที่ส่งซ่อม</b></label>
                                                                <input type="text" class="form-control" name="txtrpcpn">
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

                                                        <div class="col-xxl-2 col-md-6">
                                                            <div>
                                                                <label for="txtrpstdata" class="form-label text-dark"><b>สถานะข้อมูล</b></label>
                                                                <select class="form-select" id="txtrpstdata" name="txtrpstdata">
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
                                                            <button type="button" class="btn btn-warning2 text-light" onClick="window.location.href = '?Page=rp-manage&t=2'"><i class="mdi mdi-backup-restore"></i> Reset</button>
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
                                                <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-format-list-bulleted"></i> รายการส่งซ่อมส่วนบุคคล</h4>
                                                <?php if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202' || $_SESSION["grp"] == '203') { ?>
                                                <div class="text-right"><button class="btn btn-md btn-success3" onClick="location.href='?Page=rp-add'"><i class="mdi mdi-folder-plus"></i> บันทึกการส่งซ่อม</button></div>&nbsp;
                                                <?php }else{ } ?>
                                            </div><!-- end card header -->
                                            <div class="card-body">
                                                <table id="repairmanage" class="table table-bordered dt-responsive  table-striped align-middle text-wrap table-hover" style="width:100%">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th hidden></th>
                                                            <th hidden>รหัสส่งซ่อม</th>
                                                            <th>วันที่ส่งซ่อม</th>
                                                            <th>เลขทะเบียนครุภัณฑ์</th>
                                                            <th>ชื่อครุภัณฑ์</th>
                                                            <th>วันที่กำหนดแล้วเสร็จ</th>
                                                            <th>ผู้บันทึกข้อมูลการซ่อม</th>
                                                            <th>สถานะการส่งซ่อม</th>
                                                            <!-- <th>สถานะข้อมูล</th> -->
                                                            <th width="3%"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($TabPersonRP as $key_perrp => $value_perrp) { ?>
                                                            <tr class="text-center">
                                                                <td hidden><?php echo $value_perrp['AMS_REPAIR_DATE']; ?></td>
                                                                <td hidden >
                                                                    <?php echo $value_perrp['AMS_REPAIR_ID']; ?>
                                                                </td>
                                                                <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepaircontentModal" data-bs-id="<?php echo $value_perrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_perrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_perrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_perrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $RepairResult->dateToThai($value_perrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $RepairResult->dateToThai($value_perrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_perrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_perrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_perrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_perrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_perrp["AMS_REPAIR_FDATE"]; ?>">
                                                                    <?php echo $RepairResult->dateToThai($value_perrp['AMS_REPAIR_DATE']); ?>
                                                                </td>
                                                                <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepaircontentModal" data-bs-id="<?php echo $value_perrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_perrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_perrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_perrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $RepairResult->dateToThai($value_perrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $RepairResult->dateToThai($value_perrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_perrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_perrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_perrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_perrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_perrp["AMS_REPAIR_FDATE"]; ?>">
                                                                    <?php echo $value_perrp['AMS_PRODUCT_NO']; ?>
                                                                </td>
                                                                <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepaircontentModal" data-bs-id="<?php echo $value_perrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_perrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_perrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_perrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $RepairResult->dateToThai($value_perrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $RepairResult->dateToThai($value_perrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_perrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_perrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_perrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_perrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_perrp["AMS_REPAIR_FDATE"]; ?>">
                                                                    <?php echo $value_perrp['AMS_PRODUCT_NM']; ?>
                                                                </td>
                                                                <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepaircontentModal" data-bs-id="<?php echo $value_perrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_perrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_perrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_perrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $RepairResult->dateToThai($value_perrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $RepairResult->dateToThai($value_perrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_perrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_perrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_perrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_perrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_perrp["AMS_REPAIR_FDATE"]; ?>">
                                                                    <?php echo $RepairResult->dateToThai($value_perrp['AMS_REPAIR_SDATE']); ?>
                                                                </td>
                                                                <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepaircontentModal" data-bs-id="<?php echo $value_perrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_perrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_perrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_perrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $RepairResult->dateToThai($value_perrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $RepairResult->dateToThai($value_perrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_perrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_perrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_perrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_perrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_perrp["AMS_REPAIR_FDATE"]; ?>">
                                                                    <?php echo $value_perrp['AMS_USER_FNAME'] . ' ' . $value_perrp['AMS_USER_LNAME']; ?>
                                                                </td>
                                                                <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepaircontentModal" data-bs-id="<?php echo $value_perrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_perrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_perrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_perrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $RepairResult->dateToThai($value_perrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $RepairResult->dateToThai($value_perrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_perrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_perrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_perrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_perrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_perrp["AMS_REPAIR_FDATE"]; ?>">
                                                                    <h5><span class="badge rounded-pill bg-<?php echo $value_perrp['AMS_REPAIR_RST'] == '1' ? 'success' : 'warning'; ?> text-dark"><i class="mdi mdi-tag"></i> <?php echo $value_perrp['AMS_REPAIR_RSTNM']; ?></h5></span>
                                                                </td>
                                                                <!-- <td class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RepaircontentModal" data-bs-id="<?php echo $value_perrp["AMS_REPAIR_ID"]; ?>" data-bs-pno="<?php echo $value_perrp["AMS_PRODUCT_NO"]; ?>" data-bs-pname="<?php echo $value_perrp["AMS_PRODUCT_NM"]; ?>" data-bs-rpcase="<?php echo $value_perrp["AMS_REPAIR_CAUSE"]; ?>" data-bs-rpdate="<?php echo $RepairResult->dateToThai($value_perrp['AMS_REPAIR_DATE']); ?>" data-bs-rpdates="<?php echo $RepairResult->dateToThai($value_perrp['AMS_REPAIR_SDATE']); ?>" data-bs-rpprice="<?php echo number_format($value_perrp["AMS_REPAIR_EXPEN"], 2); ?>" data-bs-rpcom="<?php echo $value_perrp["AMS_REPAIR_CPN"]; ?>" data-bs-rpstatus="<?php echo $value_perrp["AMS_REPAIR_RSTNM"]; ?>" data-bs-pdatast="<?php echo $value_perrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?>" data-bs-pfdate="<?php echo $value_perrp["AMS_REPAIR_FDATE"]; ?>">
                                                                    <h5><span class="badge rounded-pill bg-<?php echo $value_perrp['AMS_REPAIR_ST'] == '10' ? 'info' : 'danger'; ?> text-dark"><i class="mdi mdi-tag"></i> <?php echo $value_perrp['AMS_REPAIR_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?></h5></span>
                                                                </td> -->
                                                                <td>

                                                                    <?php if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202') { ?>

                                                                        <form action="?Page=rp-edit" method="POST">
                                                                            <input type="hidden" value="<?php echo $value_perrp['AMS_REPAIR_ID']; ?>" name="editIdValue">
                                                                            <button class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</button>
                                                                        </form>
                                                                        <button class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 remove-item-btn" data-bs-toggle="modal" data-bs-target="#DeletebudgetModal" data-bs-idbd="<?php echo $value_perrp['AMS_REPAIR_ID']; ?>" data-bs-delnm="<?php echo $value_perrp["AMS_REPAIR_ID"]; ?>">
                                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                                        </button>

                                                                    <?php } else { ?>

                                                                        <form action="?Page=rp-edit" method="POST">
                                                                            <input type="hidden" value="<?php echo $value_perrp['AMS_REPAIR_ID']; ?>" name="editIdValue">
                                                                            <button class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</button>
                                                                        </form>

                                                                    <?php } ?>


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
                    </div><!-- end card-body -->
                </div>
            </div>
            <!--end col-->

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
                <form action="?Page=rp-result" method="POST">
                    <div class="iddel"><input type="hidden" name="txtiddel" class="form-control"></div>
                    <input type="hidden" name="Actionrepair" value="Del" class="form-control">
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

<div class="modal fade" id="RepaircontentModal" tabindex="-1" aria-labelledby="RepaircontentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="RepaircontentModalLabel">รายละเอียดข้อมูล</h5>
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