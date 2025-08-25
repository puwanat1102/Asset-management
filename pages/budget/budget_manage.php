<?php
$_SESSION['chkDup'] = '0';
include 'budget_function.php';
$budgetList = new BudgetResult();

$Yearresult = isset($_POST['txtyear']) ? $_POST['txtyear'] : '';
$Sourceresult = isset($_POST['txtsource']) ? $_POST['txtsource'] : '';
$EDUresult = isset($_POST['txtedu']) ? $_POST['txtedu'] : '';
$Papedresult = isset($_POST['txtpaped']) ? $_POST['txtpaped'] : '';
$Statusresult = isset($_POST['txtbdst']) ? $_POST['txtbdst'] : '';

$ListBudgetAll = $budgetList->ListBudgetAll($db, $Yearresult, $Sourceresult, $EDUresult, $Papedresult, $Statusresult);



?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><i class="mdi mdi-cash-multiple"></i> จัดการข้อมูลงบประมาณ </h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-database-search"></i> ค้นหาข้อมูลงบประมาณ</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <form class="form-horizontal" id="f_budgetsr" name="f_budgetsr" action="?Page=budget-manage" method="post" autocomplete="off">
                            <div class="row gy-4">

                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <?php
                                        $firstYear = (2022-20);
                                        $lastYear = ((int) date('Y')) + 2;
                                        $Nowyear = ((int) date('Y'));
                                        ?>
                                        <label for="txtyear" class="form-label"><b>ปีงบประมาณ</b></label>

                                        <select class="form-select js-example-basic-single" id="txtyear" name="txtyear">
                                            <option value="">ทั้งหมด</option>
                                            <!-- <option name="txtyear" style="display:none;"><?= $Nowyear; ?></option> -->
                                            <?php
                                            for ($i = $firstYear; $i <= $lastYear; $i++) {

                                            ?>
                                                <option name="txtyear" value="<?= $i; ?>"><?= $i + 543; ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="txtsource" class="form-label"><b>ที่มาของงบประมาณ</b></label>
                                        <select class=" form-select" id="txtsource" name="txtsource">
                                            <option value="">ทั้งหมด</option>
                                            <option value="101">งบรายได้</option>
                                            <option value="102">งบรายจ่าย</option>
                                            <option value="103">งบอื่นๆ</option>
                                        </select>
                                        <div id="etcshow" style="display: none;">
                                            <input type="text" class="form-control" name="txtsourceetc" placeholder="งบอื่นๆระบุ(ถ้ามี)">
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="txtedu" class="form-label"><b>หลักสูตร</b></label>
                                        <select class=" form-select" id="txtedu" name="txtedu">
                                            <option value="">ทั้งหมด</option>
                                            <option value="201">ปริญญาตรี</option>
                                            <option value="202">ปริญญาโท</option>
                                            <option value="203">ปริญญาเอก</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="txtpaped" class="form-label"><b>ภาคการศึกษา</b></label>
                                        <select class=" form-select" id="txtpaped" name="txtpaped">
                                            <option value="">ทั้งหมด</option>
                                            <option value="301">ภาคปกติ</option>
                                            <option value="302">ภาคพิเศษ</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-xxl-2 col-md-6">
                                    <div>
                                        <label for="txtbdst" class="form-label"><b>สถานะข้อมูล</b></label>
                                        <select class=" form-select" id="txtbdst" name="txtbdst" style="width: 100%; height:36px;">
                                            <option name="txtbdst" value="">ทั้งหมด</option>
                                            <option name="txtbdst" value="10">ใช้งาน</option>
                                            <option name="txtbdst" value="20">แบบร่าง</option>
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
                                    <button type="button" class="btn btn-warning2 text-light" onClick="window.location.href = '?Page=budget-manage'"><i class="mdi mdi-backup-restore"></i> Reset</button>
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
                        <h4 class="card-title mb-0 flex-grow-1"><i class="mdi mdi-format-list-bulleted"></i> รายการงบประมาณ</h4>
                        <?php if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202') { ?>
                        <div class="text-right"><button class="btn btn-md btn-success3" onClick="location.href='?Page=budget-add'"><i class="mdi mdi-cash-plus"></i> เพิ่มรายการงบประมาณ</button></div>
                        <?php }else{ } ?>
                    </div><!-- end card header -->
                    <div class="card-body">

                        <table id="budgetmanage" class="table table-bordered dt-responsive nowrap table-striped align-middle table-hover" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th hidden></th>
                                    <th hidden>รหัสงบประมาณ</th>
                                    <th>ปีงบประมาณ</th>
                                    <th>ที่มางบประมาณ</th>
                                    <th>งบประมาณ</th>
                                    <th>สถานะข้อมูล</th>
                                    <th width="3%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ListBudgetAll as $key => $value_budget) { 
                                   $yeasThaibudjet = $value_budget['AMS_BUDGET_YEAR'] +543;
                                ?>
                                    <tr class="text-center">
                                        <td hidden><?php echo $value_budget['AMS_BUDGET_YEAR']; ?></td>
                                        <td hidden><?php echo $value_budget['AMS_BUDGET_ID']; ?></td>
                                        <td class="cursor-pointer btn-block" data-bs-toggle="modal" data-bs-target="#BudgetStatusModal" data-bs-idbd="<?php echo $value_budget['AMS_BUDGET_ID']; ?>" data-bs-detail="<?php echo $yeasThaibudjet.' '.$value_budget["AMS_BUDGET_SOURCENM"].' '.$value_budget["AMS_BUDGET_CLASSNM"].' '.$value_budget['AMS_BUDGET_TYPENM']; ?>" ><?php echo $value_budget['AMS_BUDGET_YEAR'] + 543; ?></td>
                                        <td class="cursor-pointer btn-block" data-bs-toggle="modal" data-bs-target="#BudgetStatusModal" data-bs-idbd="<?php echo $value_budget['AMS_BUDGET_ID']; ?>" data-bs-detail="<?php echo $yeasThaibudjet.' '.$value_budget["AMS_BUDGET_SOURCENM"].' '.$value_budget["AMS_BUDGET_CLASSNM"].' '.$value_budget['AMS_BUDGET_TYPENM']; ?>">
                                            <h5><span class="badge rounded-pill bg-light text-dark"><?php echo $value_budget['AMS_BUDGET_SOURCENM']; ?></span><span class="badge rounded-pill bg-light text-dark"><?php echo $value_budget['AMS_BUDGET_CLASSNM']; ?></span><span class="badge rounded-pill bg-<?php echo $value_budget['AMS_BUDGET_TYPE'] == '301' ? 'success' : 'warning'; ?> text-dark"><?php echo $value_budget['AMS_BUDGET_TYPENM']; ?></span></h5>
                                        </td>
                                        <td class="cursor-pointer btn-block" data-bs-toggle="modal" data-bs-target="#BudgetStatusModal" data-bs-idbd="<?php echo $value_budget['AMS_BUDGET_ID']; ?>" data-bs-detail="<?php echo $yeasThaibudjet.' '.$value_budget["AMS_BUDGET_SOURCENM"].' '.$value_budget["AMS_BUDGET_CLASSNM"].' '.$value_budget['AMS_BUDGET_TYPENM']; ?>"><?php echo number_format($value_budget['AMS_BUDGET_AMOUNT'], 2); ?></td>
                                        <td class="cursor-pointer btn-block" data-bs-toggle="modal" data-bs-target="#BudgetStatusModal" data-bs-idbd="<?php echo $value_budget['AMS_BUDGET_ID']; ?>" data-bs-detail="<?php echo $yeasThaibudjet.' '.$value_budget["AMS_BUDGET_SOURCENM"].' '.$value_budget["AMS_BUDGET_CLASSNM"].' '.$value_budget['AMS_BUDGET_TYPENM']; ?>">
                                            <h5><span class="badge rounded-pill bg-<?php echo $value_budget['AMS_BUDGET_ST'] == '10' ? 'info' : 'danger'; ?> text-dark"><i class="mdi mdi-tag"></i> <?php echo $value_budget['AMS_BUDGET_ST'] == '10' ? 'ใช้งาน' : 'แบบร่าง'; ?></h5></span>
                                        </td>
                                        <td>
                                            <?php if ($_SESSION["grp"] == '204' || $_SESSION["grp"] == '202') { ?>
                                            <form action="?Page=budget-add" method="POST">
                                                <input type="hidden" value="<?php echo $value_budget['AMS_BUDGET_ID']; ?>" name="editIdValue">
                                                <button class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</button>
                                            </form>
                                            <button class="btn btn-sm btn-outline-dark dropdown-item dropdown-item2 remove-item-btn" data-bs-toggle="modal" data-bs-target="#DeletebudgetModal" data-bs-idbd="<?php echo $value_budget['AMS_BUDGET_ID']; ?>" data-bs-delnm="<?php echo $yeasThaibudjet.' '.$value_budget["AMS_BUDGET_SOURCENM"].' '.$value_budget["AMS_BUDGET_CLASSNM"].' '.$value_budget['AMS_BUDGET_TYPENM']; ?>">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </button>
                                            <?php }else{ } ?>
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
                <form action="?Page=budget-result" method="POST">
                    <div class="iddel"><input type="hidden" name="txtiddel" class="form-control"></div>
                    <input type="hidden" name="Actionbudget" value="Del" class="form-control">
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

<!-- Modal -->
<div class="modal fade zoomIn" id="BudgetStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="BudgetStatusModalLabel">รายละเอียดข้อมูล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <div class="modal-body">
                <!-- <form action="" method="POST">
                    <div class="idpro"><input type="hidden" name="txtidpro" class="form-control"></div>
                </form> -->
            </div>
        </div>
    </div>
</div>
<!--end modal -->